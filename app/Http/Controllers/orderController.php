<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class orderController extends Controller
{
    public function index()
    {
        $list = DB::table('orders')
                ->leftJoin('visits', 'visits.visit_id', '=', 'orders.visit_id')
                ->leftJoin('users', 'users.id', '=', 'visits.visit_doctor')
                ->leftJoin('hospitals', 'hospitals.hos_id', '=', 'visits.visit_hos')
                ->get();
        $hos =  DB::table('hospitals')->get();
        $std =  DB::table('std_orders')->get();
        return view('order.index',['list'=>$list,'hos'=>$hos,'std'=>$std]);
    }

    public function addStd(Request $request)
    {
        DB::table('std_orders')->insert(
            [
            'sd_name' => $request->get('sd_name')
            ]
        );
        return back()->with('success','เพิ่มรายการ StandingOrder สำเร็จ');
    }
}
