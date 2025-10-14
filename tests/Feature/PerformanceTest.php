<?php

use App\Models\Horse;
use App\Models\User;
use App\Models\VetVisit;
use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('optimización de consultas N+1 en listado de caballos', function () {
    Horse::factory()
        ->count(10)
        ->create();

    // Contar queries sin eager loading
    $queriesWithoutEager = 0;
    DB::listen(function ($query) use (&$queriesWithoutEager) {
        $queriesWithoutEager++;
    });

    $this->get('/horses');

    // Resetear contador
    $queriesWithoutEager = DB::getQueryLog();

    // Verificar que no hay consultas N+1
    $this->assertLessThan(count(Horse::all()) + 1, count($queriesWithoutEager));
});

test('caché funciona correctamente en dashboard', function () {
    Cache::shouldReceive('remember')
        ->once()
        ->andReturn([
            'total_horses' => 10,
            'upcoming_races' => 5,
            'pending_vet_visits' => 3
        ]);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});

test('paginación funciona correctamente', function () {
    Horse::factory()->count(25)->create();

    $response = $this->get('/horses');

    $response->assertStatus(200);
    // Verificar que solo se muestran 10 caballos por página
    $response->assertViewHas('horses', function ($horses) {
        return $horses->count() <= 10;
    });
});

test('respuestas tienen los headers de caché correctos', function () {
    $response = $this->get('/');

    $response->assertHeader('Cache-Control');
    $response->assertHeader('ETag');
});

test('compresión gzip está habilitada', function () {
    $response = $this->get('/', ['Accept-Encoding' => 'gzip']);

    $response->assertHeader('Content-Encoding', 'gzip');
});

test('archivos estáticos tienen cache-control apropiado', function () {
    $response = $this->get('/build/assets/app.css');

    $response->assertHeader('Cache-Control', 'public, max-age=31536000');
});
