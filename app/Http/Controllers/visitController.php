<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class visitController extends Controller
{
    public function index()
    {
        $list = DB::table('visits')
                ->leftJoin('users', 'users.id', '=', 'visits.visit_doctor')
                ->leftJoin('hospitals', 'hospitals.hos_id', '=', 'visits.visit_hos')
                ->leftJoin('visit_status', 'visit_status.vst_id', '=', 'visits.visit_status')
                ->get();
        $hos =  DB::table('hospitals')->get();
        return view('visit.index',['list'=>$list,'hos'=>$hos]);
    }

    public function form()
    {
        $risk = DB::table('risks')->get();
        $hname = DB::table('hospitals')->get();
        $stdorder = DB::table('std_orders')->get();
        return view('visit.form',['risk'=>$risk,'hname'=>$hname,'stdorder'=>$stdorder]);
    }

    public function regis(Request $request)
    {
        if($request->get('visit_underlying')){
            $arr_select = array();
            foreach($request->get('visit_underlying') as $list){
                $arr_select[] = $list;
            }
            $visit_underlying = implode(",", $arr_select);
        }else{
            $visit_underlying = "";
        }

        if($request->get('visit_drug_allergy')){
            $arr_select = array();
            foreach($request->get('visit_drug_allergy') as $list){
                $arr_select[] = $list;
            }
            $visit_drug_allergy = implode(",", $arr_select);
        }else{
            $visit_drug_allergy = "";
        }

        if($request->get('visit_drug')){
            $arr_select = array();
            foreach($request->get('visit_drug') as $list){
                $arr_select[] = $list;
            }
            $visit_drug = implode(",", $arr_select);
        }else{
            $visit_drug = "";
        }
        if($request->get('visit_risk')){
            $arr_select = array();
            foreach($request->get('visit_risk') as $risk){
                $arr_select[] = $risk;
            }
            $risks = implode(",", $arr_select);
        }else{
            $risks = "";
        }

        $arr_drug = array();
        foreach($request->get('drug') as $drug){ 
            $arr_drug[] = "$drug";
        }
        $std_drug = implode(" ,", $arr_drug);
        
        $vital = $request->get('temp').",".$request->get('bp').",".$request->get('rr').",".
        $request->get('hr').",".$request->get('wg').",".$request->get('hg').",".$request->get('bmi').",".
        $request->get('osat');
        
        $breath_check = $request->get('breath1').",".$request->get('breath2').",".$request->get('breath3');
        $breath = substr(str_replace(",,","",$breath_check),0,-1);
  
        DB::table('visits')->insert(
            [
            'visit_an' => $request->get('visit_an'),
            'visit_hn' => $request->get('visit_hn'),
            'visit_cm' => $request->get('visit_cm'),
            'visit_cid' => $request->get('visit_cid'),
            'visit_gender' => $request->get('visit_gender'),
            'visit_patient' => $request->get('visit_patient'),
            'visit_age' => $request->get('visit_age'),
            'visit_swab' => $request->get('visit_swab'),
            'visit_exam' => $request->get('visit_exam'),
            'visit_result' => $request->get('visit_result'),
            'visit_rx' => $risks,
            'visit_ccpi' => $request->get('visit_ccpi'),
            'visit_vital_sign' => $vital,
            'visit_symtom' => $breath,
            'visit_tel' => $request->get('visit_tel'),
            'visit_underlying' => $visit_underlying,
            'visit_drug_allergy' => $visit_drug_allergy,
            'visit_drug' => $visit_drug,
            'visit_uc' => $request->get('visit_uc'),
            'visit_doctor' => $request->get('visit_doctor'),
            'visit_hos' => $request->get('visit_hos'),
            'visit_admit' => $request->get('visit_admit'),
            'visit_uc' => $request->get('visit_uc')
            ]
        );
        $visit_id = DB::getPdo()->lastInsertId();
        DB::table('orders')->insert(
            [
            'visit_id' => $visit_id,
            'order_note' => 'Standing Order (เพิ่มจากการลงทะเบียนผู้ป่วย)',
            'order_continue' => $std_drug,
            'order_once' => 'N/A',
            'order_by' => $request->get('visit_doctor'),
            ]
        );
        return back()->with('success','ลงทะเบียนผู้ป่วยสำเร็จ');
        // return dd($std_drug);
    }

    public function edit(Request $request,$id)
    {
        if($request->get('visit_underlying')){
            $arr_select = array();
            foreach($request->get('visit_underlying') as $list){
                $arr_select[] = $list;
            }
            $visit_underlying = implode(",", $arr_select);
        }else{
            $visit_underlying = "";
        }

        if($request->get('visit_drug_allergy')){
            $arr_select = array();
            foreach($request->get('visit_drug_allergy') as $list){
                $arr_select[] = $list;
            }
            $visit_drug_allergy = implode(",", $arr_select);
        }else{
            $visit_drug_allergy = "";
        }

        if($request->get('visit_drug')){
            $arr_select = array();
            foreach($request->get('visit_drug') as $list){
                $arr_select[] = $list;
            }
            $visit_drug = implode(",", $arr_select);
        }else{
            $visit_drug = "";
        }
        if($request->get('visit_risk')){
            $arr_select = array();
            foreach($request->get('visit_risk') as $risk){
                $arr_select[] = $risk;
            }
            $risks = implode(",", $arr_select);
        }else{
            $risks = "";
        }

        if($request->get('checkVital') == 'N'){
            $ckv = DB::table('visits')->where('visits.visit_id', $id)->first();
            $vital = $ckv->visit_vital_sign;
        }else{
            $vital = $request->get('temp').",".$request->get('bp').",".$request->get('rr').",".
            $request->get('hr').",".$request->get('wg').",".$request->get('hg').",".$request->get('bmi').",".
            $request->get('osat');
        }
            
            $breath_check = $request->get('breath1').",".$request->get('breath2').",".$request->get('breath3');
            $breath = substr(str_replace(",,","",$breath_check),0,-1);
  
        DB::table('visits')->where('visit_id', $id)->update(
            [
            'visit_an' => $request->get('visit_an'),
            'visit_hn' => $request->get('visit_hn'),
            'visit_cm' => $request->get('visit_cm'),
            'visit_cid' => $request->get('visit_cid'),
            'visit_gender' => $request->get('visit_gender'),
            'visit_patient' => $request->get('visit_patient'),
            'visit_age' => $request->get('visit_age'),
            'visit_swab' => $request->get('visit_swab'),
            'visit_exam' => $request->get('visit_exam'),
            'visit_result' => $request->get('visit_result'),
            'visit_rx' => $risks,
            'visit_ccpi' => $request->get('visit_ccpi'),
            'visit_vital_sign' => $vital,
            // 'visit_symtom' => $breath,
            'visit_tel' => $request->get('visit_tel'),
            'visit_underlying' => $visit_underlying,
            'visit_drug_allergy' => $visit_drug_allergy,
            'visit_drug' => $visit_drug,
            'visit_uc' => $request->get('visit_uc'),
            'visit_doctor' => $request->get('visit_doctor'),
            'visit_hos' => $request->get('visit_hos'),
            'visit_admit' => $request->get('visit_admit'),
            'visit_uc' => $request->get('visit_uc')
            ]
        );
        return back()->with('success','แก้ไขทะเบียนผู้ป่วย : AN'.$request->get('visit_an').' สำเร็จ');
    }

    public function show($id)
    {
        $list = DB::table('visits')
                ->leftJoin('users', 'users.id', '=', 'visits.visit_doctor')
                ->leftJoin('risks', 'risks.rx_id', '=', 'visits.visit_rx')
                ->leftJoin('hospitals', 'hospitals.hos_id', '=', 'visits.visit_hos')
                ->leftJoin('visit_status', 'visit_status.vst_id', '=', 'visits.visit_status')
                ->where('visits.visit_id', $id)
                ->first();
        $order = DB::table('orders')
                ->leftJoin('users', 'users.id', '=', 'orders.order_by')
                ->leftJoin('visits', 'visits.visit_id', '=', 'orders.visit_id')
                ->where('orders.visit_id', $id)
                ->get();
        $max = DB::table('visits')->max('visit_id');
        $min = DB::table('visits')->min('visit_id');
        $risk = DB::table('risks')->get();
        $hname = DB::table('hospitals')->get();
        return view('visit.show', ['list'=>$list,'order'=>$order,'max'=>$max,'min'=>$min,'risk'=>$risk,'hname'=>$hname]);
    }

    public function addExtra(Request $request,$id)
    {
        if($request->get('oneday')){
            $arr_select = array();
            foreach($request->get('oneday') as $list){
                $arr_select[] = $list;
            }
            $oneday = implode(",", $arr_select);
        }else{
            $oneday = "";
        }

        if($request->get('continuous')){
            $arr_select = array();
            foreach($request->get('continuous') as $list){
                $arr_select[] = $list;
            }
            $continuous = implode(",", $arr_select);
        }else{
            $continuous = "";
        }

        DB::table('orders')->insert(
            [
            'visit_id' => $id,
            'order_note' => $request->get('note'),
            'order_once' => $oneday,
            'order_continue' => $continuous,
            'order_by' => $request->get('doctor'),
            ]
        );

        $list = DB::table('visits')
                ->where('visits.visit_id', $id)
                ->first();

        $Token = "6UTdo1OJF6WRHLiTJxsN90vGz2eXewUHI7xZ3SSw1dR";
        $message = "มีรายการ ExtraOrder\nหมายเลข HN: ".$list->visit_hn."\nหมายเลข AN: ".$list->visit_an."\nผู้ป่วย : ".$list->visit_patient."\nตรวจสอบได้ที่ https://ci.wc-hospital.go.th";
        line_notify($Token, $message);

        return back()->with('success','เพิ่มรายการ Order : AN'.$request->get('visit_an').' สำเร็จ');

    }

    public function addNote(Request $request,$id)
    {
        DB::table('orders')->insert(
            [
            'visit_id' => $id,
            'order_note' => $request->get('note'),
            'order_by' => $request->get('writer'),
            'order_status' => 'Y',
            'order_recheck' => 'Y',
            ]
        );

        return back()->with('success','บันทึก Progress Note สำเร็จ');
    }

    public function orderConfirm(Request $request,$id)
    {
        DB::table('orders')->where('order_id', $id)->update(
            [
                'order_status' => $request->get('pharmar')
            ]
        );
        return back()->with('success','ห้องยายืนยัน Order : AN'.$request->get('visit_an').' แล้ว');
    }

    public function orderRecheck(Request $request,$id)
    {
        DB::table('orders')->where('order_id', $id)->update(
            [
                'order_recheck' => $request->get('ci')
            ]
        );
        return back()->with('success','ศูนย์พักคอยยืนยัน Order : AN'.$request->get('visit_an').' แล้ว');
    }

    public function refer(Request $request,$id)
    {
        DB::table('visits')->where('visit_id', $id)->update(
            [
                'visit_refer_out' => $request->get('refer_out'),
                'visit_refer_note' => $request->get('refer_note'),
                'visit_refer_date' => $request->get('refer_date'),
                'visit_status' => 3,
            ]
        );
        return back()->with('success','บันทึกการ REFER CM:'.$request->get('visit_cm').' : '.$request->get('visit_patient').' แล้ว');
    }

    public function discharge(Request $request,$id)
    {
        DB::table('visits')->where('visit_id', $id)->update(
            [
                'visit_dc' => $request->get('visit_dc'),
                'visit_dc_note' => $request->get('visit_dc_note'),
                'visit_status' => 2,
            ]
        );
        return back()->with('success','บันทึกการ Discharge CM:'.$request->get('visit_cm').' : '.$request->get('visit_patient').' แล้ว');
    }

    public function cert($id)
    {
        $list = DB::table('visits')
                ->leftJoin('users', 'users.id', '=', 'visits.visit_doctor')
                ->where('visits.visit_id', $id)
                ->first();
        return view('visit.cert', ['list'=>$list]);
    }

}
