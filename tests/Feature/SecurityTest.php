<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);
});

test('usuarios no autenticados son redirigidos al login', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('usuarios pueden autenticarse con credenciales correctas', function () {
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/dashboard');
});

test('usuarios no pueden autenticarse con contraseña incorrecta', function () {
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'wrong_password',
    ]);

    $this->assertGuest();
});

test('usuarios no pueden acceder a rutas protegidas sin autenticación', function () {
    $routes = [
        '/horses',
        '/expenses',
        '/calendar',
        '/races',
        '/vetvisit',
    ];

    foreach ($routes as $route) {
        $response = $this->get($route);
        $response->assertRedirect('/login');
    }
});

test('usuarios no pueden acceder a rutas con roles incorrectos', function () {
    $this->actingAs($this->user);
    
    // Intentar acceder a una ruta que requiere rol de admin sin tenerlo
    $response = $this->get('/admin/users');
    $response->assertStatus(403);
});