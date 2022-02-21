<?php


namespace App\Http\Controllers;

use App\Models\Visit;
use App\Repositories\VisitRepository;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pageOne()
    {
        return view('pages.page-one');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pageTow()
    {
        return view('pages.page-tow');
    }

}
