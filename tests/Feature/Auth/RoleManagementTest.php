<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class RoleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_select_role_after_registration()
    {
        $user = User::factory()->create(['role' => null]);

        $response = $this->actingAs($user)
            ->post('/select-role', ['role' => 'owner']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 'owner'
        ]);

        $response->assertRedirect('/dashboard');
    }

    public function test_user_cannot_access_dashboard_without_role()
    {
        $user = User::factory()->create(['role' => null]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/select-role');
    }

    public function test_user_can_only_select_valid_role()
    {
        $user = User::factory()->create(['role' => null]);

        $response = $this->actingAs($user)
            ->post('/select-role', ['role' => 'invalid_role']);

        $response->assertSessionHasErrors(['role']);
    }

    public function test_owner_can_access_horse_management()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        $response = $this->actingAs($owner)->get('/horses');

        $response->assertStatus(200);
    }

    public function test_caretaker_can_access_assigned_horses()
    {
        $caretaker = User::factory()->create(['role' => 'caretaker']);

        $response = $this->actingAs($caretaker)->get('/caretaker/horses');

        $response->assertStatus(200);
    }

    public function test_veterinarian_can_access_vet_visits()
    {
        $vet = User::factory()->create(['role' => 'veterinarian']);

        $response = $this->actingAs($vet)->get('/vetvisit');

        $response->assertStatus(200);
    }

    public function test_blacksmith_can_access_horse_shoes()
    {
        $blacksmith = User::factory()->create(['role' => 'blacksmith']);

        $response = $this->actingAs($blacksmith)->get('/blacksmiths');

        $response->assertStatus(200);
    }

    public function test_role_permissions_are_enforced()
    {
        $caretaker = User::factory()->create(['role' => 'caretaker']);

        // Un cuidador no debería poder acceder a la gestión de gastos
        $response = $this->actingAs($caretaker)->get('/expenses');

        $response->assertStatus(403);
    }
}
