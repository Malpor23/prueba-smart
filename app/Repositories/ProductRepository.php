<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    protected function applyFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'ILIKE', "%{$filters['search']}%")
                    ->orWhere('description', 'ILIKE', "%{$filters['search']}%")
                    ->orWhere('price', 'ILIKE', "%{$filters['search']}%")
                    ->orWhere('stock', 'ILIKE', "%{$filters['search']}%");
            });
        }

        return $query;
    }

    protected function applyRelations(Builder $query, array $filters): Builder
    {
        if (isset($filters['with_category'])) {
            $query->with(['category']);
        }

        return $query;
    }
}
