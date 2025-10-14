<?php

namespace Tests\Feature\Performance;

use App\Models\Horse;
use App\Models\User;
use App\Models\VetVisit;
use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseOptimizationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_consultas_optimizadas_en_listado_de_caballos()
    {
        // Crear datos de prueba
        $horses = Horse::factory()
            ->count(5)
            ->create();

        foreach ($horses as $horse) {
            VetVisit::factory()->count(2)->create(['horse_id' => $horse->id]);
            Race::factory()->count(2)->create(['horse_id' => $horse->id]);
        }

        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $this->get('/horses');

        $queries = DB::getQueryLog();

        // Verificar que no hay consultas N+1 (máximo 5 queries)
        $this->assertLessThan(6, count($queries));
        $response->assertStatus(200);
    }

    public function test_busqueda_de_caballos_usa_indices()
    {
        Horse::factory()->count(20)->create();

        DB::enableQueryLog();

        $response = $this->get('/horses/search?q=Arabian');

        $queries = DB::getQueryLog();

        // Verificar que la búsqueda usa índices
        $explainQuery = DB::select('EXPLAIN ' . str_replace('?', "'Arabian'", $queries[0]['query']));
        $this->assertNotEquals('ALL', $explainQuery[0]->type);

        $response->assertStatus(200);
    }

    public function test_paginacion_eficiente_en_gastos()
    {
        \App\Models\Expense::factory()->count(50)->create();

        DB::enableQueryLog();

        $response = $this->get('/expenses?page=2');

        $queries = DB::getQueryLog();

        // Solo debería haber 2 queries: count total y select paginado
        $this->assertEquals(2, count($queries));
        $response->assertStatus(200);
    }
}
