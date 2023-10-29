<?php

namespace App\Utils;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

// From tuto  : https://www.laravelia.com/post/laravel-create-pagination-from-array-tutorial
class Paginate
{
    public static function paginate($items, $perPage = 5, $page = null)
    {
        $items = new Collection($items); // Convertir le tableau en collection

        $page = $page ?: Paginator::resolveCurrentPage() ?: 1;
        $total = $items->count();

        $offset = ($page - 1) * $perPage;
        $items = new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return $items;
    }
}
