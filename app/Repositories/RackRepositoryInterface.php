<?php

namespace App\Repositories;

use App\Rack;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepositoryInterface;

interface RackRepositoryInterface extends BaseRepositoryInterface
{
    public function createRack(array $data): Rack;

    public function findRackById(int $id) : Rack;

    public function updateRack(array $data) : bool;

    public function deleteRack() : bool;

    public function listRacks($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

}
