@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span class="m-0 text-muted"><i class="fas fa-h-square"></i>
                        ระบบบริหารจัดการผู้ป่วย Covid-19 ศูนย์พักคอยอำเภอกัลยาณิวัฒนา
                    </span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="/visit">ทะเบียนผู้ป่วย</a></li>
                      <li class="breadcrumb-item active">{{ $list->visit_an }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if($message = Session::get('success'))
            <div id="alert" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($list->visit_status == 2)
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>ผู้ป่วยรายนี้รักษาหายแล้ว</strong><hr>
                <p><i class="fa fa-calendar-check"></i> วันที่ Discharge :  {{ DateThai($list->visit_dc) }}</p>
                <p><i class="fa fa-clipboard"></i> รายละเอียด Discharge : {{ $list->visit_dc_note }}</p>
            </div>
            @endif
            @if ($list->visit_status == 3)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>ผู้ป่วยรายนี้ถูกส่งต่อการรักษาแล้ว</strong><hr>
                <p><i class="fa fa-hospital"></i> สถานพยาบาลที่ส่งต่อ :  {{ $list->visit_refer_out }}</p>
                <p><i class="fa fa-clipboard"></i> รายละเอียดการส่งต่อ : {{ $list->visit_refer_note }}</p>
                <p><i class="fa fa-calendar-check"></i> วันที่ส่งต่อ : {{ DateThai($list->visit_refer_date) }}</p>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="m-0">
                                        <i class="fas fa-user-circle"></i> {{ $list->visit_patient }}
                                        <span class="badge badge-{{ $list->vst_color }}"><i class="fa fa-{{ $list->vst_icon }}"></i> {{ $list->vst_name }}</span>
                                    </h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('visit.show',$list->visit_id-1) }}" class="btn btn-sm btn-light"
                                        {{ ($list->visit_id <= $min) ? 'hidden' : '' }}>
                                        <i class="fa fa-chevron-circle-left"></i> ย้อนกลับ
                                    </a>
                                    <a href="{{ route('visit.show',$list->visit_id+1) }}" class="btn btn-sm btn-light"
                                        {{ ($list->visit_id >= $max) ? 'hidden' : '' }}>
                                        ถัดไป <i class="fa fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-pills" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-patient-tab" data-toggle="tab"
                                    href="#nav-patient" role="tab" aria-controls="nav-patient" aria-selected="true">
                                        <i class="far fa-address-card"></i> ข้อมูลผู้ป่วย
                                    </a>
                                    <a class="nav-link" id="nav-extra-tab" data-toggle="tab" 
                                    href="#nav-extra" role="tab" aria-controls="nav-extra" aria-selected="false">
                                        <i class="fa fa-tasks"></i> รายการ Order
                                    </a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-patient" role="tabpanel" aria-labelledby="nav-patient-tab">
                                    <form action="{{ route('visit.edit',$list->visit_id) }}">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12" style="margin-bottom: -0.2rem;">
                                                    <h5 class="text-muted">ข้อมูลพื้นฐาน</h5>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""><i class="fa fa-user-circle"></i> ชื่อ-สกุล</label>
                                                    <input type="text" name="visit_patient" class="form-control" value="{{ $list->visit_patient }}" required>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label for=""><i class="fa fa-venus-mars"></i> เพศ</label>
                                                    <select name="visit_gender" class="custom-select" required>
                                                        <option>เลือก</option>
                                                        <option value="me" {{ ($list->visit_gender == 'me') ? 'SELECTED' : '' }}>ชาย</option>
                                                        <option value="fe" {{ ($list->visit_gender == 'fe') ? 'SELECTED' : '' }}>หญิง</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label for="">อายุ</label>
                                                    <input type="text" name="visit_age" class="form-control" value="{{ $list->visit_age }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""><i class="fa fa-address-card"></i> หมายเลขบัตรประชาชน</label>
                                                    <input type="text" name="visit_cid" class="form-control" value="{{ $list->visit_cid }}" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for=""><i class="far fa-calendar"></i> วันที่คัดกรอง</label>
                                                    <input type="text" name="visit_swab" class="form-control basicDate" value="{{ $list->visit_swab }}" readonly required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for=""><i class="fas fa-phone-square"></i> เบอร์โทร</label>
                                                    <input type="text" name="visit_tel" class="form-control" value="{{ $list->visit_tel }}" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for=""><i class="far fa-calendar"></i> วันที่ตรวจ</label>
                                                    <input type="text" name="visit_exam" class="form-control basicDate" value="{{ $list->visit_exam }}" readonly required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for=""><i class="far fa-calendar"></i> วันที่ทราบผล</label>
                                                    <input type="text" name="visit_result" class="form-control basicDate" value="{{ $list->visit_result }}" readonly required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for=""><i class="fa fa-file-prescription"></i> ปัจจัยเสี่ยง</label>
                                                    @php $rx_select = explode(',',$list->visit_rx); @endphp                                                
                                                    <select class="form-control" id="visit_risk" name="visit_risk[]" multiple="multiple">
                                                        <option></option>
                                                        @foreach ($risk as $rks)
                                                        @foreach ($rx_select as $rx_show)
                                                        <option value="{{ $rks->rx_id }}" 
                                                        {{ ($rks->rx_id == $rx_show) ? 'SELECTED' : '' }}>
                                                            {{ $rks->rx_name }}
                                                        </option>
                                                        @endforeach
                                                        @endforeach                                                    
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">CC & PI</label>
                                                    <textarea name="visit_ccpi" class="form-control" rows="3">{{ $list->visit_ccpi }}</textarea>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-bottom: -0.2rem;">
                                                    <h5 class="text-muted">ตรวจร่างกาย</h5>
                                                </div>
                                                <div class="col-md-12">
                                                    @if ($list->visit_vital_sign == '')
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="">Temp</label>
                                                            <input type="text" name="temp" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">BP</label>
                                                            <input type="text" name="bp" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">RR</label>
                                                            <input type="text" name="rr" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">HR</label>
                                                            <input type="text" name="hr" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">น้ำหนัก</label>
                                                            <input type="text" name="wg" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">ส่วนสูง</label>
                                                            <input type="text" name="hg" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">BMI</label>
                                                            <input type="text" name="bmi" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="">O2 sat <= 94% ขณะนั่งพัก</label>
                                                            <input type="text" name="osat" class="form-control" placeholder="ระบุ Sat%" required>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <table class="table table-borderless table-bordered table-sm text-center">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Temp</th>
                                                                <th>BP</th>
                                                                <th>RR</th>
                                                                <th>HR</th>
                                                                <th>น้ำหนัก</th>
                                                                <th>ส่วนสูง</th>
                                                                <th>BMI</th>
                                                                <th>O2 sat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $vital = explode(',',$list->visit_vital_sign); @endphp
                                                            @foreach ($vital as $vt)
                                                            <td>
                                                                <span style="font-weight: bold;">{{ $vt }}</span>
                                                            </td>
                                                            @endforeach
                                                            <input type="text" name="checkVital" value="N" hidden>
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">อาการ (แรกรับ)</label>
                                                    @php $symtoms = explode(',',$list->visit_symtom); @endphp
                                                    @foreach ($symtoms as $sms)
                                                    <li class="" style="font-weight: normal;">{{ $sms }}</li>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">VISIT_AN</label>
                                                    <input type="text" name="visit_an" class="form-control" value="{{ $list->visit_an }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">VISIT_HN</label>
                                                    <input type="text" name="visit_hn" class="form-control" value="{{ $list->visit_hn }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">CM_NO</label>
                                                    <input type="text" name="visit_cm" class="form-control" value="{{ $list->visit_cm }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""><i class="fa fa-comment-medical"></i> โรคประจำตัว</label>
                                                        @php $underlying = explode(',',$list->visit_underlying); @endphp
                                                        @foreach ($underlying as $udl)
                                                        <li class="" style="font-weight: normal;">{{ $udl }}</li>
                                                        @endforeach
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""><i class="fa fa-exclamation-circle"></i> ประวัติแพ้ยา</label>
                                                        @php $drug_ag = explode(',',$list->visit_drug_allergy); @endphp
                                                        @foreach ($drug_ag as $dgs)
                                                        <li class="" style="font-weight: normal;">{{ $dgs }}</li>
                                                        @endforeach
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""><i class="fa fa-notes-medical"></i> ยาประจำ</label>
                                                        @php $drug = explode(',',$list->visit_drug); @endphp
                                                        @foreach ($drug as $dg)
                                                        <li class="" style="font-weight: normal;">{{ $dg }}</li>
                                                        @endforeach
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""><i class="fa fa-file-medical"></i> สิทธิ์การรักษา</label>
                                                    <li class="text-bold" style="font-weight: normal;">{{ $list->visit_uc }}</li>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""><i class="far fa-calendar-plus"></i> วันที่ Admit</label>
                                                    <input type="text" name="visit_admit" class="form-control basicDate" value="{{ $list->visit_admit }}" readonly required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""><i class="fa fa-user-md"></i> แพทย์ผู้ดูแล</label>
                                                    <select name="visit_doctor" class="custom-select" required>
                                                        <option>เลือก</option>
                                                        <option value="2" {{ ($list->visit_doctor == '2') ? 'SELECTED' : '' }}>• วริยดา เบี้ยวบรรจง</option>
                                                        <option value="3" {{ ($list->visit_doctor == '3') ? 'SELECTED' : '' }}>• ศิริประภา สมถา</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""><i class="fa fa-clinic-medical"></i> สถานที่ Admit</label>
                                                    <select name="visit_hos" class="custom-select" required>
                                                        <option value="">เลือก</option>
                                                        @foreach ($hname as $hos)
                                                        <option value="{{ $hos->hos_id }}" {{ ($hos->hos_id == $list->visit_hos) ? 'SELECTED' : '' }}>• {{ $hos->hos_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($list->visit_status == 1)                                            
                                        <div class="card-body text-right" style="margin-bottom: -1.3rem;">
                                            @if (Auth::user()->permission == 'admin' || Auth::user()->permission == 'user')
                                            <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#refer">
                                                <i class="fa fa-ambulance"></i> ส่งต่อผู้ป่วย
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dc">
                                                <i class="fa fa-file-import"></i> Discharge ผู้ป่วย
                                            </button>
                                            @endif
                                            <button type="button" class="btn btn-success"
                                            onclick=
                                            "Swal.fire({
                                                title: 'ยืนยันการแก้ไขทะเบียนผู้ป่วย ?',
                                                text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง ครบถ้วนก่อนกดบันทึก',
                                                showCancelButton: true,
                                                confirmButtonText: `บันทึกข้อมูล`,
                                                cancelButtonText: `ยกเลิก`,
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit();
                                                    } else if (result.isDenied) {
                                                        form.reset();
                                                    }
                                                })">
                                                <i class="fa fa-check-circle"></i> บันทึกการแก้ไข
                                            </button>
                                        </div>
                                        @endif
                                    </form>
                                    @if ($list->visit_status == 2)                                            
                                    <div class="card-body text-right" style="margin-bottom: -1.3rem;">
                                        <a href="{{ route('visit.cert',$list->visit_id) }}" target="_blank"  class="btn btn-success">
                                            <i class="fa fa-file-contract"></i> พิมพ์ใบรับรองแพทย์
                                        </a>
                                    </div>
                                    
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-extra" role="tabpanel" aria-labelledby="nav-extra-tab">
                                    @if ($list->visit_status == 1)
                                    @php $btn = ''; @endphp
                                    @else
                                    @php $btn = 'disabled'; @endphp
                                    @endif
                                    @if (Auth::user()->permission == 'user')
                                    @php $btnUser = 'disabled'; @endphp
                                    @else
                                    @php $btnUser = ''; @endphp
                                    @endif
                                    <div class="card-body text-right" style="margin-bottom: -1.3rem;">
                                        @if (Auth::user()->permission == 'admin' || Auth::user()->permission == 'doctor')
                                        <button class="btn btn-info" data-toggle="modal" data-target="#order" {{ $btn }}>
                                            <i class="fa fa-folder-plus"></i> เพิ่มรายการ Order
                                        </button>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#order" {{ $btn }} hidden>
                                            <i class="fa fa-tablets"></i> เพิ่มรายการ Favipiravir
                                        </button>
                                        @endif
                                        @if (Auth::user()->permission == 'admin' || Auth::user()->permission == 'pharmar' || Auth::user()->permission == 'user')
                                        <button class="btn btn-info" data-toggle="modal" data-target="#note" {{ $btn }}>
                                            <i class="fa fa-edit"></i> เขียน Progress Note
                                        </button>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"><i class="far fa-calendar-check"></i> วันที่</th>
                                                    <th>Progress Note</th>
                                                    <th class="text-center">One day</th>
                                                    <th class="text-center">Continuous</th>
                                                    <th class="text-center">แพทย์</th>
                                                    <th class="text-center">ห้องยา</th>
                                                    <th class="text-center">ศูนย์พักคอย</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 13px;">
                                                @foreach ($order as $ods)
                                                <tr>
                                                    <td class="text-center">{{ DateTimeThai($ods->order_date) }}</td>
                                                    <td>{{ $ods->order_note }}</td>
                                                    <td>
                                                        @if (isset($ods->order_once))
                                                        @php $oneday = explode(',',$ods->order_once); @endphp
                                                        @foreach ($oneday as $one)
                                                        <li class="" style="font-weight: normal;">{{ $one }}</li>
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($ods->order_continue))
                                                        @php $conday = explode(',',$ods->order_continue); @endphp
                                                        @foreach ($conday as $con)
                                                        <li class="" style="font-weight: normal;">{{ $con }}</li>
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $ods->name }}</td>
                                                    <td class="text-center">
                                                        @if ($ods->order_status == '')
                                                        <form  action="{{ route('visit.orderConfirm',$ods->order_id) }}">
                                                            <input type="text" name="pharmar" value="Y" hidden>
                                                            <input type="text" name="visit_an" value="{{ $ods->visit_an }}" hidden>
                                                            <button href="#" type="button" class="btn btn-xs btn-success"
                                                            onclick=
                                                            "Swal.fire({
                                                                title: 'ยืนยันห้องยาดำเนินการ ?',
                                                                text: 'หากกดยืนยันแล้ว จะไม่สามารถแก้ไขได้',
                                                                showCancelButton: true,
                                                                confirmButtonText: `ยืนยัน`,
                                                                cancelButtonText: `ยกเลิก`,
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        form.submit();
                                                                    } else if (result.isDenied) {
                                                                        form.reset();
                                                                    }
                                                                })"
                                                                {{ $btnUser }}>
                                                                <i class="fa fa-check-square"></i> ดำเนินการ
                                                            </button>
                                                            @else
                                                            <i class="fas fa-check text-success"></i> 
                                                            <span class="text-muted">ดำเนินการแล้ว</span>
                                                            @endif
                                                        </form>
                                                    </td>
                                                    @if ($ods->order_status == 'Y')
                                                    <td class="text-center">
                                                        @if ($ods->order_recheck == '')
                                                        <form  action="{{ route('visit.orderRecheck',$ods->order_id) }}">
                                                            <input type="text" name="ci" value="Y" hidden>
                                                            <input type="text" name="visit_an" value="{{ $ods->visit_an }}" hidden>
                                                            <button href="#" type="button" class="btn btn-xs btn-success"
                                                            onclick=
                                                            "Swal.fire({
                                                                title: 'ยืนยันศูนย์พักคอยดำเนินการ ?',
                                                                text: 'หากกดยืนยันแล้ว จะไม่สามารถแก้ไขได้',
                                                                showCancelButton: true,
                                                                confirmButtonText: `ยืนยัน`,
                                                                cancelButtonText: `ยกเลิก`,
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        form.submit();
                                                                    } else if (result.isDenied) {
                                                                        form.reset();
                                                                    }
                                                                })">
                                                                <i class="fa fa-check-square"></i> ดำเนินการ
                                                            </button>
                                                        </form>
                                                        @else
                                                        <i class="fas fa-check-double text-success"></i> 
                                                        <span class="text-muted">ตรวจสอบแล้ว</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refer" tabindex="-1" aria-labelledby="referModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('visit.refer',$list->visit_id) }}">
                <input type="text" name="visit_cm" value="{{ $ods->visit_cm }}" hidden>
                <input type="text" name="visit_patient" value="{{ $ods->visit_patient }}" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="referModalLabel"><i class="fa fa-ambulance"></i> ส่งต่อผู้ป่วย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>AN</th>
                                <th>HN</th>
                                <th>CM</th>
                                <th>ผู้ป่วย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $list->visit_an }}</td>
                                <td>{{ $list->visit_hn }}</td>
                                <td>{{ $list->visit_cm }}</td>
                                <td>{{ $list->visit_patient }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <input type="text" name="refer_out" class="form-control" placeholder="ระบุสถานที่ส่งต่อ (ex. รพ.สนาม)">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea name="refer_note" class="form-control" rows="5" placeholder="ระบุหมายเหตุที่ส่งต่อ (ผู้ป่วยมีอาการ....)"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <input name="refer_date" type="text" class="form-control basicDate" placeholder="วันที่ส่งต่อ">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info"
                        onclick=
                        "Swal.fire({
                            title: 'ยืนยันการส่งต่อผู้ป่วย\n{{ 'CM:'.$list->visit_cm.' '.$list->visit_patient }} ?',
                            text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง ครบถ้วนก่อนกดยืนยัน',
                            showCancelButton: true,
                            confirmButtonText: `ยืนยัน`,
                            cancelButtonText: `ยกเลิก`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                } else if (result.isDenied) {
                                    form.reset();
                                }
                            })">
                            <i class="fa fa-check-circle"></i> ส่งต่อผู้ป่วย
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dc" tabindex="-1" aria-labelledby="dcModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('visit.discharge',$list->visit_id) }}">
                <input type="text" name="visit_cm" value="{{ $list->visit_cm }}" hidden>
                <input type="text" name="visit_patient" value="{{ $list->visit_patient }}" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="dcModalLabel"><i class="fa fa-file-import"></i> Discharge ผู้ป่วย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php 
                    $date = date('Y-m-d');
                    $cout_date = DateDiff($list->visit_exam,$date);
                    $disc = date ('Y-m-d', strtotime('+14 day', strtotime($list->visit_exam))); 
                    @endphp
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>AN</th>
                                <th>HN</th>
                                <th>ผู้ป่วย</th>
                                <th>วันที่ตรวจ</th>
                                <th>วันที่ครบกำหนด</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $list->visit_an }}</td>
                                <td>{{ $list->visit_hn }}</td>
                                <td>{{ $list->visit_patient }}</td>
                                <td>{{ DateThai($list->visit_exam) }}</td>
                                <td>{{ DateThai($disc) }}</td>
                                <td>
                                    @if ($cout_date <= 10)
                                    <span class="badge badge-danger"><i class="fa fa-times-circle"></i> ยังไม่ครบกำหนด</span>
                                    @php $dc = 'disabled' @endphp
                                    @else
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> ครบกำหนด</span>
                                    @php $dc = '' @endphp
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <textarea name="visit_dc_note" class="form-control" rows="3" placeholder="ระบุหมายเหตุ (ถ้ามี)"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <input name="visit_dc" type="text" class="form-control basicDate" placeholder="วันที่ Discharge" readonly>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info" {{ $dc }}
                        onclick=
                        "Swal.fire({
                            title: 'ยืนยันการ Discharge ผู้ป่วย ?',
                            text: '{{ 'CM'.$list->visit_cm.' '.$list->visit_patient }}',
                            showCancelButton: true,
                            confirmButtonText: `บันทึกข้อมูล`,
                            cancelButtonText: `ยกเลิก`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                } else if (result.isDenied) {
                                    form.reset();
                                }
                            })">
                            <i class="fa fa-check-circle"></i> Discharge
                        </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderLabel"><i class="fa fa-plus-circle"></i> เพิ่มรายการ Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('visit.addExtra',$list->visit_id) }}">
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="">Progress Note</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Once Day Order 
                        <small class="text-danger">(ระบุชื่อยา_ขนาดยา_วิธีใช้ ex.Amlodipine_10mg_1x1_po_pc)</small></label>
                        <select class="multiple-tag" name="oneday[]" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Continuous Order 
                        <small class="text-danger">(ระบุชื่อยา_ขนาดยา_วิธีใช้ ex.Amlodipine_10mg_1x1_po_pc)</small></label>
                        <select class="multiple-tag" name="continuous[]" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">แพทย์ผู้สั่ง Order</label>
                        <input name="doctor" class="form-control" value="{{ Auth::user()->id }}" hidden>
                        <input name="" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info"
                    onclick=
                    "Swal.fire({
                        title: 'ยืนยันการเพิ่ม Order ?',
                        text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง ครบถ้วนก่อนกดบันทึก',
                        showCancelButton: true,
                        confirmButtonText: `บันทึกข้อมูล`,
                        cancelButtonText: `ยกเลิก`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa fa-check-circle"></i> เพิ่มรายการ Order
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="note" tabindex="-1" aria-labelledby="noteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteLabel"><i class="fa fa-edit"></i> เขียน Progress Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('visit.addNote',$list->visit_id) }}">
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="">Progress Note</label>
                        <textarea class="form-control" name="note" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">ผู้บันทึก</label>
                        <input name="writer" class="form-control" value="{{ Auth::user()->id }}" hidden>
                        <input name="" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info"
                    onclick=
                    "Swal.fire({
                        title: 'ยืนยันการเพิ่ม Order ?',
                        text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง ครบถ้วนก่อนกดบันทึก',
                        showCancelButton: true,
                        confirmButtonText: `บันทึกข้อมูล`,
                        cancelButtonText: `ยกเลิก`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa fa-check-circle"></i> บันทึก Progress Note
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#visit_risk').select2({
        width: '100%',
        createTag: function(params) {
            if (params.term.indexOf('@') === -1) {
                return null;
            }
            return {
                id: params.term,
                text: params.term
            }
        },
        placeholder: "ระบุปัจจัยเสี่ยง (ถ้ามี)",
    });
</script>
@endsection
