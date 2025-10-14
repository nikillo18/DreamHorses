<?php

use App\Models\Horse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('validación de campos requeridos al crear un caballo', function () {
    $response = $this->post('/horses', []);

    $response->assertSessionHasErrors([
        'name',
        'breed',
        'date_of_birth',
    ]);
});

test('validación de formato de fecha al crear un caballo', function () {
    $response = $this->post('/horses', [
        'name' => 'Spirit',
        'breed' => 'Arabian',
        'date_of_birth' => 'fecha-invalida',
    ]);

    $response->assertSessionHasErrors(['date_of_birth']);
});

test('validación de longitud máxima de campos', function () {
    $response = $this->post('/horses', [
        'name' => str_repeat('a', 300),
        'breed' => str_repeat('b', 300),
        'date_of_birth' => '2020-01-01',
    ]);

    $response->assertSessionHasErrors([
        'name',
        'breed',
    ]);
});

test('validación de campos numéricos en gastos', function () {
    $response = $this->post('/expenses', [
        'description' => 'Gasto de prueba',
        'amount' => 'no-es-numero',
        'date' => '2023-01-01',
    ]);

    $response->assertSessionHasErrors(['amount']);
});

test('validación de fechas futuras en eventos del calendario', function () {
    $response = $this->post('/calendar', [
        'title' => 'Evento de prueba',
        'start_date' => '2020-01-01',
        'end_date' => '2019-12-31',
    ]);

    $response->assertSessionHasErrors(['end_date']);
});