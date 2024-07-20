<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Models\User;

class UserRepositoryEloquent implements UserRepository
{
    public function findAll(array $query)
    {
        $sql = User::query();

        return $sql->orderBy('name')->get();
    }

    public function findById(int $id)
    {
        $query = User::query();

        return $query->where('id', $id)->first();
    }

    public function create(array $values)
    {
        return User::create($values);
    }

    public function update(User $object)
    {
        $object->save();

        return $object;
    }

    public function destroy(User $object)
    {
        $object->forceDelete();
    }
}
