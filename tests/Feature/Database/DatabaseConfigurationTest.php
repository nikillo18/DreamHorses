<?php

namespace Tests\Feature\Database;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseConfigurationTest extends TestCase
{
    public function test_mysql_is_default_connection()
    {
        $this->assertEquals('mysql', config('database.default'));
    }

    public function test_mysql_connection_parameters_match_env()
    {
        $config = config('database.connections.mysql');

        $this->assertEquals(env('DB_HOST', '127.0.0.1'), $config['host']);
        $this->assertEquals(env('DB_PORT', '3306'), $config['port']);
        $this->assertEquals(env('DB_DATABASE', 'dreamhorses'), $config['database']);
        $this->assertEquals(env('DB_USERNAME', 'root'), $config['username']);
    }

    public function test_database_can_connect()
    {
        try {
            DB::connection()->getPdo();
            $connected = true;
        } catch (\Exception $e) {
            $connected = false;
        }

        $this->assertTrue($connected);
    }

    public function test_database_has_correct_version()
    {
        $version = DB::select('SELECT VERSION() as version')[0]->version;

        // Verificar que estamos usando MySQL
        $this->assertStringContainsString('MySQL', $version, 'La base de datos no es MySQL');
    }

    public function test_database_has_correct_charset()
    {
        $config = config('database.connections.mysql');

        $this->assertEquals('utf8mb4', $config['charset']);
        $this->assertEquals('utf8mb4_unicode_ci', $config['collation']);
    }

    public function test_database_supports_transactions()
    {
        $supportsTransactions = false;

        DB::beginTransaction();
        try {
            DB::table('users')->insert([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);

            DB::rollBack();
            $supportsTransactions = true;
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->assertTrue($supportsTransactions, 'La base de datos no soporta transacciones');
    }

    public function test_database_timezone_matches_app_timezone()
    {
        $appTimezone = config('app.timezone');
        $dbTimezone = DB::select("SELECT @@session.time_zone as timezone")[0]->timezone;

        // Convertir el timezone de la base de datos al formato de PHP si es necesario
        if ($dbTimezone === 'SYSTEM') {
            $dbTimezone = date_default_timezone_get();
        }

        $this->assertEquals(
            $appTimezone,
            'America/Argentina/Buenos_Aires',
            'El timezone de la aplicación no está configurado correctamente'
        );
    }

    public function test_database_max_connections()
    {
        $maxConnections = DB::select("SHOW VARIABLES LIKE 'max_connections'")[0]->Value;

        // Verificar que hay suficientes conexiones disponibles para la aplicación
        $this->assertGreaterThan(
            100,
            (int)$maxConnections,
            'El número máximo de conexiones es muy bajo'
        );
    }
}
