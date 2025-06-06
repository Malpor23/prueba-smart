<?php

namespace App\Repositories;

use App\Traits\HasRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    use HasRepository;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $filters = []): Collection | LengthAwarePaginator
    {
        $query = $this->model->query();

        $query = $this->applyFilters($query, $filters);
        $query = $this->applySorting($query, $filters);
        $query = $this->applyRelations($query, $filters);

        if (isset($filters['page']) || isset($filters['per_page'])) {
            return $this->paginate($query, $filters);
        }

        return $query->get();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
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
        return $this->model->where($column, $value);
    }

    public function findWhereIn(string $column, array $values): Builder
    {
        return $this->model->whereIn($column, $values);
    }
}
