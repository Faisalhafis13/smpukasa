<?php

namespace App\Repositories\Admin;

use App\Models\Program;

class ProgramRepository
{
    public function getAll()
    {
        return Program::latest()->get();
    }

    public function findById(int $id): ?Program
    {
        return Program::find($id);
    }

    public function create(array $data): Program
    {
        return Program::create($data);
    }

    public function update(int $id, array $data): ?Program
    {
        $program = Program::find($id);

        if (!$program) {
            return null;
        }

        $program->update($data);

        return $program->fresh();
    }

    public function delete(int $id): bool
    {
        $program = Program::find($id);

        if (!$program) {
            return false;
        }

        return $program->delete();
    }
}