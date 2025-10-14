<?php

use App\Models\Horse;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('prevención de inyección SQL en búsqueda de caballos', function () {
    // Crear algunos caballos de prueba
    Horse::factory()->create(['name' => 'Spirit']);
    Horse::factory()->create(['name' => 'BlackBeauty']);

    // Intentar inyección SQL en parámetro de búsqueda
    $maliciousSearch = "' OR '1'='1";
    
    $response = $this->get("/horses/search?q={$maliciousSearch}");
    
    // Verificar que la búsqueda maliciosa no devuelve todos los caballos
    $response->assertDontSee('Spirit');
    $response->assertDontSee('BlackBeauty');
    $response->assertStatus(200);
});

test('sanitización de entradas en creación de gastos', function () {
    $maliciousInput = [
        'description' => '<script>alert("xss")</script>Gasto de prueba',
        'amount' => '100.00',
        'date' => '2023-01-01',
    ];

    $response = $this->post('/expenses', $maliciousInput);

    $expense = Expense::first();
    
    // Verificar que el script fue escapado
    $this->assertStringNotContainsString('<script>', $expense->description);
    $this->assertStringContainsString('&lt;script&gt;', $expense->description);
});

test('prevención de inyección SQL en parámetros de ordenamiento', function () {
    // Crear algunos gastos de prueba
    Expense::factory()->count(3)->create();

    // Intentar inyección SQL en parámetro de ordenamiento
    $maliciousOrderBy = "id DESC; DROP TABLE expenses; --";
    
    $response = $this->get("/expenses?sort={$maliciousOrderBy}");
    
    // Verificar que la tabla sigue existiendo
    $this->assertTrue(DB::getSchemaBuilder()->hasTable('expenses'));
    $response->assertStatus(200);
});

test('protección contra CSRF en formularios', function () {
    $response = $this->post('/horses', [
        'name' => 'Spirit',
        'breed' => 'Arabian',
        'date_of_birth' => '2020-01-01',
    ], ['X-CSRF-TOKEN' => 'invalid-token']);

    $response->assertStatus(419); // Token CSRF inválido
});

test('validación de tipos de archivo en carga de fotos', function () {
    $response = $this->post('/horse-photos', [
        'photo' => 'data:text/plain;base64,SGVsbG8sIFdvcmxkIQ==', // Archivo de texto disfrazado
    ]);

    $response->assertSessionHasErrors(['photo']);
});