<?php

use App\Models\Horse;
use App\Models\User;
use App\Models\VetVisit;
use App\Models\Race;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('creación de caballo funciona correctamente', function () {
    $horseData = [
        'name' => 'Spirit',
        'breed' => 'Arabian',
        'date_of_birth' => '2020-01-01',
        'color' => 'Bay',
        'gender' => 'Male',
    ];

    $response = $this->post('/horses', $horseData);

    $response->assertRedirect();
    $this->assertDatabaseHas('horses', $horseData);
});

test('actualización de caballo funciona correctamente', function () {
    $horse = Horse::factory()->create();
    
    $updatedData = [
        'name' => 'Updated Name',
        'breed' => $horse->breed,
        'date_of_birth' => $horse->date_of_birth,
    ];

    $response = $this->put("/horses/{$horse->id}", $updatedData);

    $response->assertRedirect();
    $this->assertDatabaseHas('horses', $updatedData);
});

test('eliminación de caballo funciona correctamente', function () {
    $horse = Horse::factory()->create();

    $response = $this->delete("/horses/{$horse->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('horses', ['id' => $horse->id]);
});

test('relaciones entre modelos funcionan correctamente', function () {
    $horse = Horse::factory()->create();
    
    // Crear visitas veterinarias asociadas
    VetVisit::factory()->count(3)->create([
        'horse_id' => $horse->id
    ]);

    // Crear carreras asociadas
    Race::factory()->count(2)->create([
        'horse_id' => $horse->id
    ]);

    // Crear entrenamientos asociados
    Training::factory()->count(4)->create([
        'horse_id' => $horse->id
    ]);

    $this->assertEquals(3, $horse->vetVisits()->count());
    $this->assertEquals(2, $horse->races()->count());
    $this->assertEquals(4, $horse->trainings()->count());
});

test('soft deletes funcionan correctamente', function () {
    $horse = Horse::factory()->create();
    
    $horse->delete();

    // Verificar que el registro sigue en la base de datos pero está marcado como eliminado
    $this->assertSoftDeleted($horse);

    // Verificar que no aparece en las consultas normales
    $this->assertDatabaseMissing('horses', [
        'id' => $horse->id,
        'deleted_at' => null
    ]);
});