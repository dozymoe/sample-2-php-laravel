<?php

namespace App\Contracts;

use App\Models\Sale;

interface SaleRepository
{
    public function findAll(array $query);

    public function findById(int $id);

    public function getStatistics(array $query);

    public function create(array $values);

    public function update(Sale $object);

    public function destroy(Sale $object);
}
