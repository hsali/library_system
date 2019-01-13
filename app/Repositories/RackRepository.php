<?php

namespace App\Repositories;

use App\Book;
use App\Exceptions\RackNotFoundErrorException;
use App\Exceptions\CreateRackErrorException;
use App\Exceptions\UpdateRackErrorException;
use App\Rack;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepository;

class RackRepository extends BaseRepository implements RackRepositoryInterface
{
    /**
     * RackRepository constructor.
     *
     * @param Rack $rack
     */
    public function __construct(Rack $rack)
    {
        parent::__construct($rack);
        $this->model = $rack;
    }

    /**
     * @param array $data
     *
     * @return Rack
     * @throws CreateRackErrorException
     */
    public function createRack(array $data) : Rack
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new CreateRackErrorException($e);
        }
    }

    /**
     * @param int $id
     *
     * @return Rack
     * @throws RackNotFoundErrorException
     */
    public function findRackById(int $id) : Rack
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new RackNotFoundErrorException($e);
        }
    }

    /**
     * @param array $data
     * @param int $id
     *
     * @return bool
     * @throws UpdateRackErrorException
     */
    public function updateRack(array $data) : bool
    {
        try {
            return $this->update($data);
        } catch (QueryException $e) {
            throw new UpdateRackErrorException($e);
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteRack() : bool
    {
        return $this->delete();
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return Collection
     */
    public function listRacks($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection
    {
        return $this->model->withCount('books')->orderBy($orderBy, $sortBy)->get($columns);
    }




}
