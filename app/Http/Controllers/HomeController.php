<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
        $count = DB::select(DB::raw("SELECT
            (SELECT COUNT(*) FROM visits WHERE visit_status = '1') AS admit,
            (SELECT COUNT(*) FROM visits WHERE visit_status = '2') AS well,
            (SELECT COUNT(*) FROM visits WHERE visit_status = '3') AS refer"));
        
        $month = DB::select(DB::raw('
                SELECT
                YEAR(`visit_admit`) AS `year`,
                COUNT(IF(MONTH(`visit_admit`)=1,`visit_id`,NULL)) AS `m1`,
                COUNT(IF(MONTH(`visit_admit`)=2,`visit_id`,NULL)) AS `m2`,
                COUNT(IF(MONTH(`visit_admit`)=3,`visit_id`,NULL)) AS `m3`,
                COUNT(IF(MONTH(`visit_admit`)=4,`visit_id`,NULL)) AS `m4`,
                COUNT(IF(MONTH(`visit_admit`)=5,`visit_id`,NULL)) AS `m5`,
                COUNT(IF(MONTH(`visit_admit`)=6,`visit_id`,NULL)) AS `m6`,
                COUNT(IF(MONTH(`visit_admit`)=7,`visit_id`,NULL)) AS `m7`,
                COUNT(IF(MONTH(`visit_admit`)=8,`visit_id`,NULL)) AS `m8`,
                COUNT(IF(MONTH(`visit_admit`)=9,`visit_id`,NULL)) AS `m9`,
                COUNT(IF(MONTH(`visit_admit`)=10,`visit_id`,NULL)) AS `m10`,
                COUNT(IF(MONTH(`visit_admit`)=11,`visit_id`,NULL)) AS `m11`,
                COUNT(IF(MONTH(`visit_admit`)=12,`visit_id`,NULL)) AS `m12`
                FROM `visits`
                WHERE YEAR(visit_admit) = 2021
                GROUP BY `year`'));
        
        $male = DB::table('visits')
                ->where('visit_gender', 'me')
                ->count();

        $female = DB::table('visits')
                ->where('visit_gender', 'fe')
                ->count();

        return view('welcome', ['count'=>$count,'month'=>$month,'male'=>$male,'female'=>$female]);
    }
}
