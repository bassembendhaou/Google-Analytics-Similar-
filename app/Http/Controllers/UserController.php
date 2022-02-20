<?php


namespace App\Http\Controllers;


use App\Classes\QueryConfig;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
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
                'filter_by_keyword' => $request->input('search')['value'],
                'filter_by_delete_status' => false
            ];
            $config->setColumns(['*'])
                ->setFilters($filters)
                ->setOrderBy($paginationParams['ORDER_BY'])
                ->setDirection($paginationParams['DIRECTION'])
                ->setPage($paginationParams['PAGE'])
                ->setPerPage($paginationParams['PER_PAGE'])
                ->setPagination(true);
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


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $userRepository = new UserRepository($user);
        if ($userRepository->delete())
            return response()->json(['status' => 'success', 'message' =>  __('messages.user_deleted')], 200);
        return response()->json(['status' => 'error', 'message' => __('messages.error_has_occured')], 400);
    }
}
