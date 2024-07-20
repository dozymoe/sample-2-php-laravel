<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepository
{
    public function findAll(array $query);

    public function findById(int $id);

    public function create(array $values);

    public function update(User $object);

    public function destroy(User $object);
}
