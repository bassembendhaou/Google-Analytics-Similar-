<?php


namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Trait PaginationParams
 * @package App\Traits
 */
trait PaginationParams
{

    /**
     * @param $request
     * @return array
     */
    public function getPaginationParams($request)
    {
        $start = $request->input('start');
        $index = intval($request->input('order')[0]['column']);
        $orderColumn = $request->input('columns')[$index]['data'];
        $orderType = $request->input('order')[0]['dir'];
        $length = $request->input('length');
        $draw = $request->input('draw');
        $page = $start / $length + 1;
        return [
            "PAGE" => $page,
            "PER_PAGE" => $length,
            "ORDER_BY" => $orderColumn,
            "DIRECTION" => $orderType,
            "DRAW" => $draw
        ];
    }
}
