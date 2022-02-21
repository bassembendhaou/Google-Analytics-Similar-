<?php


namespace App\Http\Controllers;

use App\Models\Visit;
use App\Repositories\VisitRepository;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['nbVisits'] =  VisitRepository::getVisitsCount();
        $data['nbVisitsUnique'] = VisitRepository::getUniqueVisitsCount();
        $data['deviceTypeStats'] = VisitRepository::getUniqueVisitsPerDevice();
        $data['nbVisitsUniquePerBrowser'] = VisitRepository::getUniqueVisitsPerBrowser();
        $visitsCount = VisitRepository::getVisitsCountEvolutionsLastSevenDays();
        $uniqueVisitsCount = VisitRepository::getUniqueVisitsCountEvolutionsLastSevenDays();
        return view('dashboard.index', ['data' => $data,'uniqueVisitsCount' => $uniqueVisitsCount, 'visitsCount' => $visitsCount,'labels' => array_reverse(getLastSevenDays(false))]);
    }
}
