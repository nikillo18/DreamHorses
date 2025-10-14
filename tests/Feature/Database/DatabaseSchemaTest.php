<?php

namespace Tests\Feature\Database;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_required_tables_exist()
    {
        $requiredTables = [
            'users',
            'horses',
            'vet_visits',
            'races',
            'trainings',
            'expenses',
            'calendar_events',
            'blacksmiths',
            'caretakers',
            'horse_photos',
            'foods'
        ];

        foreach ($requiredTables as $table) {
            $this->assertTrue(
                Schema::hasTable($table),
                "La tabla '{$table}' no existe en la base de datos"
            );
        }
    }

    public function test_horses_table_has_required_columns()
    {
        $requiredColumns = [
            'id',
            'name',
            'breed',
            'date_of_birth',
            'color',
            'gender',
            'created_at',
            'updated_at'
        ];

        foreach ($requiredColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('horses', $column),
                "La columna '{$column}' no existe en la tabla horses"
            );
        }
    }

    public function test_foreign_key_constraints_exist()
    {
        // Verificar foreign key en vet_visits
        $this->assertTrue(
            $this->hasForeignKey('vet_visits', 'horse_id', 'horses'),
            'La foreign key horse_id no existe en vet_visits'
        );

        // Verificar foreign key en races
        $this->assertTrue(
            $this->hasForeignKey('races', 'horse_id', 'horses'),
            'La foreign key horse_id no existe en races'
        );

        // Verificar foreign key en trainings
        $this->assertTrue(
            $this->hasForeignKey('trainings', 'horse_id', 'horses'),
            'La foreign key horse_id no existe en trainings'
        );
    }

    public function test_soft_deletes_are_enabled()
    {
        $tablesWithSoftDeletes = [
            'horses',
            'vet_visits',
            'races',
            'trainings',
            'expenses'
        ];

        foreach ($tablesWithSoftDeletes as $table) {
            $this->assertTrue(
                Schema::hasColumn($table, 'deleted_at'),
                "La columna deleted_at no existe en la tabla '{$table}'"
            );
        }
    }

    public function test_indexes_exist()
    {
        // Verificar índices en horses
        $this->assertTrue(
            $this->hasIndex('horses', 'horses_name_index'),
            'El índice en el nombre del caballo no existe'
        );

        // Verificar índices en expenses
        $this->assertTrue(
            $this->hasIndex('expenses', 'expenses_date_index'),
            'El índice en la fecha de gastos no existe'
        );

        // Verificar índices en calendar_events
        $this->assertTrue(
            $this->hasIndex('calendar_events', 'calendar_events_start_date_index'),
            'El índice en la fecha de inicio de eventos no existe'
        );
    }

    private function hasForeignKey($table, $column, $referencedTable)
    {
        $foreignKeys = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableForeignKeys($table);

        foreach ($foreignKeys as $foreignKey) {
            if (
                $foreignKey->getLocalColumns()[0] === $column &&
                $foreignKey->getForeignTableName() === $referencedTable
            ) {
                return true;
            }
        }

        return false;
    }

    private function hasIndex($table, $indexName)
    {
        $indexes = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableIndexes($table);

        return array_key_exists($indexName, $indexes);
    }
}
