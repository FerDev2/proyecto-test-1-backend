<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direccionGeneral = Department::create([
            'name' => 'Direccion General',
            'level' => 1,
            'employees' => 10,
            'ambassador' => 'Juan Perez',
            'parent_id' => null,
        ]);

        $marketing = Department::create([
            'name' => 'Marketing',
            'level' => 2,
            'employees' => 5,
            'ambassador' => 'Pedro Caceres',
            'parent_id' => $direccionGeneral->id,
        ]);

        $desarrollo = Department::create([
            'name' => 'Desarrollo',
            'level' => 2,
            'employees' => 5,
            'ambassador' => 'Maria Lopez',
            'parent_id' => $direccionGeneral->id,
        ]);

        $recursosHumanos = Department::create([
            'name' => 'Recursos Humanos',
            'level' => 2,
            'employees' => 4,
            'ambassador' => 'Carlos Sanchez',
            'parent_id' => $direccionGeneral->id,
        ]);

        Department::create([
            'name' => 'Area de IT Soporte',
            'level' => 3,
            'employees' => 3,
            'ambassador' => 'Maria Torres',
            'parent_id' => $desarrollo->id,
        ]);

        Department::create([
            'name' => 'Selección de Personal',
            'level' => 3,
            'employees' => 2,
            'ambassador' => 'Ana Gomez',
            'parent_id' => $recursosHumanos->id,
        ]);

        Department::create([
            'name' => 'Filmakers',
            'level' => 3,
            'employees' => 2,
            'ambassador' => 'Maria Sandoval',
            'parent_id' => $marketing->id,
        ]);
    }
}
