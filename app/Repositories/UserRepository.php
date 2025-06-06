<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'ILIKE', "%{$filters['search']}%")
                    ->orWhere('email', 'ILIKE', "%{$filters['search']}%")
                    ->orWhere('role', 'ILIKE', "%{$filters['search']}%");
            });
        }

        return $query;
    }
}
