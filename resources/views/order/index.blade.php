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
                            <h5 class="m-0"><i class="fas fa-notes-medical"></i> Order ผู้ป่วยทั้งหมด</h5>
                        </div>
                        <div class="card-body text-right" style="margin-bottom: -1.3rem;">
                            <a href="#" data-toggle="modal" data-target="#std" class="btn btn-info">
                                <i class="fa fa-prescription-bottle-alt"></i> StandingOrder
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tableBasic2" class="table table-hover compact nowrap"
                                style="width:100%;font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">สถานะ</th>
                                        <th>วันที่</th>
                                        <th class="text-center">VISIT_HN</th>
                                        <th>ผู้ป่วย</th>
                                        <th>Progress Note</th>
                                        <th class="text-center">One day</th>
                                        <th class="text-center">Continuous</th>
                                        <th class="text-center">แพทย์</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px;">
                                    @foreach ($list as $lists)
                                    <tr>
                                        <td class="text-center" style="vertical-align: top;">
                                            @if ($lists->order_status == '')
                                            <form  action="{{ route('visit.orderConfirm',$lists->order_id) }}">
                                                <input type="text" name="pharmar" value="Y" hidden>
                                                <input type="text" name="visit_an" value="{{ $lists->visit_an }}" hidden>
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
                                                    })">
                                                    <i class="fa fa-check-square"></i> ดำเนินการ
                                                </button>
                                                @else
                                                <i class="fas fa-check text-success"></i> 
                                                <span class="text-muted">ดำเนินการแล้ว</span>
                                                @endif
                                            </form>
                                        </td>
                                        <td style="vertical-align: top;">{{ DateThai($lists->order_date) }}</td>
                                        <td class="text-center" style="vertical-align: top;">{{ $lists->visit_hn }}</td>
                                        <td style="vertical-align: top;">
                                            <span>
                                                <i class="fa fa-{{ $lists->hos_icon }} text-{{ $lists->hos_color }}"></i>
                                            </span>
                                            {{ $lists->visit_patient }}
                                        </td>
                                        <td style="vertical-align: top;">{{ $lists->order_note }}</td>
                                        <td style="vertical-align: top;">
                                            @if (isset($lists->order_once))
                                            @php $oneday = explode(',',$lists->order_once); @endphp
                                            @foreach ($oneday as $one)
                                            <li class="" style="font-weight: normal;">{{ $one }}</li>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td style="vertical-align: top;">
                                            @if (isset($lists->order_continue))
                                            @php $conday = explode(',',$lists->order_continue); @endphp
                                            @foreach ($conday as $con)
                                            <li class="" style="font-weight: normal;">{{ $con }}</li>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align: top;">{{ $lists->name }}</td>
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

<!-- Modal STD_Order -->
<div class="modal fade" id="std" tabindex="-1" aria-labelledby="std" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="std"><i class="fa fa-prescription-bottle-alt"></i> StandingOrder</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>รายการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($std as $sd)
                        <tr>
                            <td class="text-center">{{ $sd->sd_id }}</td>
                            <td>{{ $sd->sd_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
               </table>
               <form action="{{ route('order.addStd') }}">
                   <div class="form-group">
                       <label for="">ชื่อยา</label>
                       <input name="sd_name" type="text" class="form-control" placeholder="ระบุชื่อยา" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-sm btn-info"
                        onclick=
                        "Swal.fire({
                            title: 'ยืนยันการเพิ่มรายการ StandingOrder ?',
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
                            <i class="fa fa-check-circle"></i> เพิ่มยา
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
        // DATATABLES
        $(document).ready(function () {
            $('#tableBasic2').dataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                scrollX: true,
                order: [[ 0, "asc" ]],
                oLanguage: {
                    oPaginate: {
                        sFirst: '<small>หน้าแรก</small>',
                        sLast: '<small>หน้าสุดท้าย</small>',
                        sNext: '<small>ถัดไป</small>',
                        sPrevious: '<small>กลับ</small>'
                    },
                    sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
                    sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                    sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                    sInfoEmpty: '<small>ไม่มีข้อมูล</small>'
                },
            });
        });
</script>
@endsection
