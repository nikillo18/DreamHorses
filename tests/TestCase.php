<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{


    protected function setUp(): void
    {
        parent::setUp();

        // Verificar que estamos usando MySQL
        $this->ensureMySQLConnection();
    }

    protected function ensureMySQLConnection()
    {
        $connection = DB::connection();

        if ($connection->getDriverName() !== 'mysql') {
            throw new \RuntimeException(
                'Los tests deben ejecutarse con MySQL. ' .
                    'Conexión actual: ' . $connection->getDriverName()
            );
        }

        // Verificar la configuración de timezone
        $appTimezone = config('app.timezone');
        if ($appTimezone !== 'America/Argentina/Buenos_Aires') {
            throw new \RuntimeException(
                'El timezone de la aplicación debe ser America/Argentina/Buenos_Aires. ' .
                    'Timezone actual: ' . $appTimezone
            );
        }

        // Asegurarse de que la base de datos sea la correcta
        $database = $connection->getDatabaseName();
        if ($database !== env('DB_DATABASE', 'dreamhorses')) {
            throw new \RuntimeException(
                'La base de datos de prueba no es la correcta. ' .
                    'Base de datos actual: ' . $database
            );
        }
    }
}
