<?php


namespace App\Http\Controllers;


use App\Repositories\QueryConfig;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paginationParams = $this->getPaginationParams($request);
            $config = new QueryConfig();
            $filters = [
                'by_keyword' => $request->input('keyword'),
                'by_delete_status' => false
            ];
            $config->setColumns(['*'])
                ->setFilters($filters)
                ->setOrderBy($paginationParams['ORDER_BY'])
                ->setDirection($paginationParams['DIRECTION'])
                ->setPage($paginationParams['PAGE'])
                ->setPerPage($paginationParams['PER_PAGE']);
            $data = UserRepository::search($config);
            $response = [
                'draw' => $paginationParams['DRAW'],
                'recordsTotal' => $data->total(),
                'recordsFiltered' => $data->total(),
                'data' => $data->items()
            ];
            return response()->json($response);
        }
        return view('users.index');
    }

}
