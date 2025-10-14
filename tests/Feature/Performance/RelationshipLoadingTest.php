<?php

namespace Tests\Feature\Performance;

use App\Models\Horse;
use App\Models\User;
use App\Models\VetVisit;
use App\Models\Race;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RelationshipLoadingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_eager_loading_relaciones_caballo()
    {
        $horse = Horse::factory()->create();

        VetVisit::factory()->count(3)->create(['horse_id' => $horse->id]);
        Training::factory()->count(3)->create(['horse_id' => $horse->id]);
        Race::factory()->count(3)->create(['horse_id' => $horse->id]);

        DB::enableQueryLog();

        // Cargar el caballo con sus relaciones
        $loadedHorse = Horse::with(['vetVisits', 'trainings', 'races'])->find($horse->id);

        $queries = DB::getQueryLog();

        // Debería ser solo 4 queries (1 para el caballo + 3 para las relaciones)
        $this->assertEquals(4, count($queries));

        // Verificar que las relaciones están cargadas
        $this->assertTrue($loadedHorse->relationLoaded('vetVisits'));
        $this->assertTrue($loadedHorse->relationLoaded('trainings'));
        $this->assertTrue($loadedHorse->relationLoaded('races'));
    }

    public function test_carga_eficiente_calendario()
    {
        $horse = Horse::factory()->create();

        // Crear varios eventos
        VetVisit::factory()->count(5)->create(['horse_id' => $horse->id]);
        Training::factory()->count(5)->create(['horse_id' => $horse->id]);
        Race::factory()->count(5)->create(['horse_id' => $horse->id]);

        DB::enableQueryLog();

        $response = $this->get('/calendar');

        $queries = DB::getQueryLog();

        // Verificar que se usan subconsultas eficientes
        $this->assertLessThan(5, count($queries));
        $response->assertStatus(200);
    }

    public function test_carga_eficiente_dashboard()
    {
        // Crear datos de prueba
        $horses = Horse::factory()->count(3)->create();
        foreach ($horses as $horse) {
            VetVisit::factory()->create(['horse_id' => $horse->id]);
            Training::factory()->create(['horse_id' => $horse->id]);
            Race::factory()->create(['horse_id' => $horse->id]);
        }

        DB::enableQueryLog();

        $response = $this->get('/dashboard');

        $queries = DB::getQueryLog();

        // Verificar que se usan consultas optimizadas
        $this->assertLessThan(5, count($queries));
        $response->assertStatus(200);
    }
}
