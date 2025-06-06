<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

trait HasRepository
{
    protected function paginate(Builder $query, array $filters): LengthAwarePaginator
    {
        $perPage = $filters['per_page'] ?? 10;
        return $query->paginate($perPage);
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'ILIKE', '%' . $filters['search'] . '%');
            });
        }

        return $query;
    }

    protected function applySorting(Builder $query, array $filters): Builder
    {
        $sortField = $filters['sort_field'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';

        return $query->orderBy($sortField, $sortDirection);
    }

    protected function applyRelations(Builder $query, array $filters): Builder
    {
        return $query;
    }
}
