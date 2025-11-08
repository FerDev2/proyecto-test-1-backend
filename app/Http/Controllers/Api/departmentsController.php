<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class departmentsController extends Controller
{

    // public function index()
    // {
    //     $departments = Department::with('children')->get();
    //     return response()->json($departments, 200);
    // }

    public function index()
    {
        $departments = Department::with('children')->get();
        if ($departments->isEmpty()) {
            return response()->json(['message' => 'No existen departementos'], 200);
        }
        return response()->json($departments, 200);
    }

    public function show($id)
    {
        $department = Department::with('parent', 'children')->find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json($department, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45|unique:departments,name',
            'employees' => 'nullable|integer|min:1',
            'ambassador' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:departments,id',
        ]);

        if (isset($validated['parent_id'])) {
            $parent = Department::find($validated['parent_id']);

            if (!$parent) {
                return response()->json([
                    'message' => 'El departamento padre no existe.'
                ], 422);
            }

            // Calcular nivel según el padre
            $validated['level'] = ($parent->level ?? 0) + 1;
        } else {
            $validated['level'] = 1;
        }
        $department = Department::create($validated);
        return response()->json([
            'message' => 'Departamento creado con éxito',
            'data' => $department
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:45|unique:departments,name,' . $id,
            'parent_id' => 'nullable|exists:departments,id|not_in:' . $id,
            'employees' => 'sometimes|integer|min:1',
            'ambassador' => 'nullable|string|max:255',

        ]);

        if (isset($validated['parent_id'])) {
            $parent = Department::find($validated['parent_id']);
            $validated['level'] = ($parent->level ?? 0) + 1;
        }

        $department->update($validated);

        return response()->json([
            'message' => 'Departamento actualizado con éxito',
            'data' => $department
        ], 200);
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $department->delete();
        return response()->json(['message' => 'Departamento eliminado con éxito'], 200);
    }

    public function subdepartments($id)
    {
        $department = Department::with('children')->find($id);
        if (!$department) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        return response()->json([
            'department' => $department->name,
            'subdepartments' => $department->children
        ], 200);
    }
}
