<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseService
{
    protected BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(array $filters = []): Collection | LengthAwarePaginator
    {
        return $this->repository->all($filters);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }

    public function findWhere(string $column, mixed $value): Builder
    {
        return $this->repository->findWhere($column, $value);
    }

    public function findWhereIn(string $column, array $values): Builder
    {
        return $this->repository->findWhereIn($column, $values);
    }

}
