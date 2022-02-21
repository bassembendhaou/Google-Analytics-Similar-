<?php


namespace App\Http\Controllers;


use App\Models\Visit;
use App\Repositories\QueryConfig;
use App\Repositories\UserRepository;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;


/**
 * Class VisitController
 * @package App\Http\Controllers
 */
class VisitController extends Controller
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
            $config = new \App\Classes\QueryConfig();
            $filters = [
                'filter_by_keyword' => $request->input('search')['value'],
                'filter_by_device_type' =>  $request->input('device_type')
            ];
            $config->setColumns(['*'])
                ->setFilters($filters)
                ->setOrderBy($paginationParams['ORDER_BY'])
                ->setDirection($paginationParams['DIRECTION'])
                ->setPage($paginationParams['PAGE'])
                ->setPerPage($paginationParams['PER_PAGE'])
                ->setPagination(true);
            $data = VisitRepository::search($config);
            $response = [
                'draw' => $paginationParams['DRAW'],
                'recordsTotal' => $data->total(),
                'recordsFiltered' => $data->total(),
                'data' => $data->items()
            ];
            return response()->json($response);
        }
        return view('visits.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $visit = Visit::findOrFail($id);
        $visitRepository = new VisitRepository($visit);
        if ($visitRepository->delete())
            return response()->json(['status' => 'success', 'message' =>  __('messages.visit_deleted')], 200);
        return response()->json(['status' => 'error', 'message' => __('messages.error_has_occured')], 400);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request)
    {
        $config = new \App\Classes\QueryConfig();
        $filters = [
            'filter_by_keyword' => $request->input('search'),
        ];
        $columns = ['id as id', 'name as text'];
        $orderDirection = 'asc';
        $orderColumn = 'created_at';
        $config->setFilters($filters)
            ->setDirection($orderDirection)
            ->setOrderBy($orderColumn)
            ->setColumns($columns)
            ->setPagination(false);
        $data = UserRepository::search($config);
        return response()->json(['items' => $data]);
    }
}
