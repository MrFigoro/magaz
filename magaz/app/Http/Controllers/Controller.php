<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return json pagination
     *
     * @param $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonPagination($items)
    {
        return response()->json([
            'items' => $items->all(),
            'pagination' => $this->pagination($items),
        ]);
    }

    /**
     * Build pagination variables we require from the paginate result object
     *
     * @param $results
     * @param int $page
     * @return array
     */
    protected function pagination($results, $page = 1)
    {
        return [
            'count' => $results->count(),
            'current_page' => $results->currentPage(),
            'first_item' => $results->firstItem(),
            'has_more_pages' => $results->hasMorePages(),
            'last_item' => $results->lastItem(),
            'last_page' => $results->lastPage(),
            'next_page_url' => $results->nextPageUrl(),
            'per_page' => $results->perPage(),
            'previous_page_url' => $results->previousPageUrl(),
            'total' => $results->total(),
            'url' => $results->url($page),
        ];
    }
}
