<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $bossRole = Role::create(['name' => 'boss']);
        $caretakersRole = Role::create(['name' => 'caretaker']);
        $adminRole = Role::create(['name' => 'admin']);

        // Create admin user
        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        $adminUser->assignRole($adminRole);
        

        // horse permissions
       /* $createHorsePermission = Permission::create(['name' => 'create horse']);
        $editHorsePermission = Permission::create(['name' => 'edit horse']);
        $deleteHorsePermission = Permission::create(['name' => 'delete horse']);
        $viewHorsePermission = Permission::create(['name' => 'view horse']);
        
        //Race permissions
        $createRacePermission = Permission::create(['name' => 'create race']);
        $editRacePermission = Permission::create(['name' => 'edit race']);
        $deleteRacePermission = Permission::create(['name' => 'delete race']);
        $viewRacePermission = Permission::create(['name' => 'view race']);

        // VetVisit permissions

        $createVetVisitPermission = Permission::create(['name' => 'create vetvisit']);
        $editVetVisitPermission = Permission::create(['name' => 'edit vetvisit']);
        $deleteVetVisitPermission = Permission::create(['name' => 'delete vetvisit']);
        $viewVetVisitPermission = Permission::create(['name' => 'view vetvisit']);

        // Calendar permissions

        $createCalendarPermission = Permission::create(['name' => 'create calendar']);
        $editCalendarPermission = Permission::create(['name' => 'edit calendar']);
        $deleteCalendarPermission = Permission::create(['name' => 'delete calendar']);
        $viewCalendarPermission = Permission::create(['name' => 'view calendar']);

        // expense permissions

        $createExpensePermission = Permission::create(['name' => 'create expense']);
        $editExpensePermission = Permission::create(['name' => 'edit expense']);
        $deleteExpensePermission = Permission::create(['name' => 'delete expense']);
        $viewExpensePermission = Permission::create(['name' => 'view expense']);

        // training permissions

        $createTrainingPermission = Permission::create(['name' => 'create training']);
        $editTrainingPermission = Permission::create(['name' => 'edit training']);
        $deleteTrainingPermission = Permission::create(['name' => 'delete training']);
        $viewTrainingPermission = Permission::create(['name' => 'view training']);

        // Assign permissions to roles
        $bossRole->givePermissionTo([ 
            $createHorsePermission, 
            $viewHorsePermission,
            $viewRacePermission,
            $viewVetVisitPermission,
            $viewCalendarPermission,
            $viewTrainingPermission,
            

        ]);


        $caretakersRole->givePermissionTo([ 
            $createHorsePermission, 
            $editHorsePermission, 
            $deleteHorsePermission, 
            $viewHorsePermission,
            $createTrainingPermission,
            $viewTrainingPermission,
            $editTrainingPermission,
            $deleteTrainingPermission,
            $createCalendarPermission,
            $viewCalendarPermission,
            $editCalendarPermission,
            $deleteCalendarPermission,
            $createExpensePermission,
            $viewExpensePermission,
            $editExpensePermission,
            $deleteExpensePermission,
            $viewVetVisitPermission,
            $createRacePermission,
            $editRacePermission,
            $deleteRacePermission,
            $viewRacePermission
        ]);


        $veterinariansRole->givePermissionTo([ 
            $viewHorsePermission,
            $createVetVisitPermission,
            $viewVetVisitPermission,
            $editVetVisitPermission,
            $deleteVetVisitPermission,
            $viewCalendarPermission,
            $viewTrainingPermission,

        ]);*/

    }
}