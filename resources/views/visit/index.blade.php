@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <span class="m-0 text-muted"><i class="fas fa-h-square"></i>
                        ระบบบริหารจัดการผู้ป่วย Covid-19 ศูนย์พักคอยอำเภอกัลยาณิวัฒนา
                    </span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0"><i class="far fa-file-alt"></i> ทะเบียนรายชื่อผู้ป่วยทั้งหมด</h5>
                        </div>
                        <div class="card-body text-right" style="margin-bottom: -1.3rem;">
                            <a href="{{ url('visit/form') }}" class="btn btn-info">
                                <i class="fa fa-user-plus"></i> ลงทะเบียนผู้ป่วย
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tableBasic" class="table table-striped compact nowrap"
                                style="width:100%;font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">VISIT_AN</th>
                                        <th class="text-center">VISIT_HN</th>
                                        <th class="text-center">CM_NO</th>
                                        <th><i class="fa fa-user"></i> ผู้ป่วย</th>
                                        <th class="text-center"><i class="far fa-calendar"></i> วันที่รักษา</th>
                                        <th class="text-center"><i class="fa fa-user-md"></i>  แพทย์</th>
                                        <th width="1%" class="text-center">สถานะ</th>
                                        <th class="text-center">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px;">
                                    @foreach($list as $lists)
                                        <tr>
                                            <td class="text-center">{{ $lists->visit_an }}</td>
                                            <td class="text-center">{{ $lists->visit_hn }}</td>
                                            <td class="text-center">{{ $lists->visit_cm }}</td>
                                            <td>
                                                <span>
                                                    <i class="fa fa-{{ $lists->hos_icon }} text-{{ $lists->hos_color }}"></i>
                                                </span>
                                                {{ $lists->visit_patient }}
                                            </td>
                                            <td class="text-center">{{ DateThai($lists->visit_admit) }}</td>
                                            <td class="text-center">{{ $lists->name }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-{{ $lists->vst_color }} btn-block"><i class="fa fa-{{ $lists->vst_icon }}"></i> {{ $lists->vst_name }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('visit.show',$lists->visit_id) }}" class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            @foreach ($hos as $h)
                                                <small class="text-muted">
                                                    <i class="fa fa-{{ $h->hos_icon }} text-{{ $h->hos_color }}"></i> {{ $h->hos_name }}
                                                </small>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
