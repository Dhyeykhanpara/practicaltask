<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category'];

    public function scopeFilter($query, array $filters = [])
    {
        // search (LIKE)
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', "%{$search}%");
        }

        // category (exact)
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        // min price
        if (isset($filters['min_price']) && $filters['min_price'] !== '') {
            // cast to float or numeric guard
            $min = is_numeric($filters['min_price']) ? $filters['min_price'] : null;
            if ($min !== null) {
                $query->where('price', '>=', $min);
            }
        }

        // max price
        if (isset($filters['max_price']) && $filters['max_price'] !== '') {
            $max = is_numeric($filters['max_price']) ? $filters['max_price'] : null;
            if ($max !== null) {
                $query->where('price', '<=', $max);
            }
        }

        return $query;
    }
}
