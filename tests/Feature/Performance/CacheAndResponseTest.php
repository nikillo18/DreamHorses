<?php

namespace Tests\Feature\Performance;

use App\Models\Horse;
use App\Models\User;
use App\Models\VetVisit;
use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheAndResponseTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_dashboard_usa_cache_correctamente()
    {
        // Crear datos de prueba
        Horse::factory()->count(3)->create();
        Race::factory()->count(2)->create();
        VetVisit::factory()->count(2)->create();

        // Primera petición - debe generar el caché
        $this->get('/dashboard');

        $this->assertTrue(Cache::has('dashboard_stats'));

        // Segunda petición - debe usar el caché
        $response = $this->get('/dashboard');

        $this->assertTrue(Cache::has('dashboard_stats'));
        $response->assertStatus(200);
    }

    public function test_headers_de_cache_correctos()
    {
        $response = $this->get('/horses');

        $response->assertHeader('Cache-Control');
        $response->assertHeader('ETag');
    }

    public function test_compresion_gzip_habilitada()
    {
        $response = $this->get('/', ['Accept-Encoding' => 'gzip']);

        $response->assertHeader('Content-Encoding', 'gzip');
    }

    public function test_lazy_loading_imagenes()
    {
        $horse = Horse::factory()->create();

        $response = $this->get("/horses/{$horse->id}");

        $response->assertSee('loading="lazy"');
        $response->assertStatus(200);
    }

    public function test_tiempo_respuesta_calendario()
    {
        \App\Models\CalendarEvent::factory()->count(50)->create();

        $startTime = microtime(true);

        $response = $this->get('/calendar');

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(500, $executionTime);
        $response->assertStatus(200);
    }
}
