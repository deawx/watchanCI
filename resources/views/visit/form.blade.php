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
                      <li class="breadcrumb-item active">ลงทะเบียนผู้ป่วย</li>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0"><i class="far fa-edit"></i> ลงทะเบียนผู้ป่วย</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('visit.regis') }}">
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12" style="margin-bottom: -0.2rem;">
                                            <h5 class="text-muted">ข้อมูลพื้นฐาน</h5>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for=""><i class="fa fa-user-circle"></i> ชื่อ-สกุล</label>
                                            <input type="text" name="visit_patient" class="form-control" placeholder="นายวัดจันทร์ กัลยา" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for=""><i class="fa fa-venus-mars"></i> เพศ</label>
                                            <select name="visit_gender" class="custom-select" required>
                                                <option value="">เลือก</option>
                                                <option value="me">• ชาย</option>
                                                <option value="fe">• หญิง</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">อายุ</label>
                                            <input type="text" name="visit_age" class="form-control" placeholder="ระบุอายุ" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for=""><i class="fa fa-address-card"></i> หมายเลขบัตรประชาชน</label>
                                            <input type="text" name="visit_cid" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="far fa-calendar"></i> วันที่คัดกรอง</label>
                                            <input type="text" name="visit_swab" class="form-control basicDate" readonly required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="fas fa-phone-square"></i> เบอร์โทร</label>
                                            <input type="text" name="visit_tel" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="far fa-calendar"></i> วันที่ตรวจ</label>
                                            <input type="text" name="visit_exam" class="form-control basicDate" readonly required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="far fa-calendar"></i> วันที่ทราบผล</label>
                                            <input type="text" name="visit_result" class="form-control basicDate" readonly required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for=""><i class="fa fa-file-prescription"></i> ปัจจัยเสี่ยง</label>
                                            <select class="form-control" id="visit_risk" name="visit_risk[]" multiple="multiple">
                                                <option></option>
                                                @foreach ($risk as $rks)
                                                <option value="{{ $rks->rx_id }}">{{ $rks->rx_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">CC & PI</label>
                                            <textarea name="visit_ccpi" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-12" style="margin-bottom: -0.2rem;">
                                            <h5 class="text-muted">ตรวจร่างกาย</h5>
                                        </div>
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
                                        <div class="form-group col-md-4">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="breath1" name="breath1" value="หายใจหอบเหนื่อย (dyspnea)">
                                                <label for="breath1">
                                                    หายใจหอบเหนื่อย (dyspnea)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="breath2" name="breath2" value="หายใจถี่ >= 22 ครั้ง/นาที ขณะพัก">
                                                <label for="breath2">
                                                    หายใจถี่ >= 22 ครั้ง/นาที ขณะพัก
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="breath3" name="breath3" value="ความดันน้อยกว่า 90/60 mmhg">
                                                <label for="breath3">
                                                    ความดันน้อยกว่า 90/60 mmhg
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">VISIT_AN</label>
                                            <input type="text" name="visit_an" class="form-control" placeholder="ระบุหมายเลข AN" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">VISIT_HN</label>
                                            <input type="text" name="visit_hn" class="form-control" placeholder="ระบุหมายเลข HN" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">CM_NO</label>
                                            <input type="text" name="visit_cm" class="form-control" placeholder="ระบุหมายเลข CM">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for=""><i class="fa fa-comment-medical"></i> โรคประจำตัว 
                                            <small class="text-danger">(ระบุชื่อโรค หากไม่มีให้ระบุว่า "ไม่มี")</small></label>
                                            <select class="multiple-tag" name="visit_underlying[]" multiple="multiple">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for=""><i class="fa fa-exclamation-circle"></i> ประวัติแพ้ยา 
                                            <small class="text-danger">(ระบุชื่อยา หากไม่มีให้ระบุว่า "ไม่มี")</small></label>
                                            <select class="multiple-tag" name="visit_drug_allergy[]" multiple="multiple">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for=""><i class="fa fa-notes-medical"></i> ยาประจำ 
                                            <small class="text-danger">(ระบุชื่อยา หากไม่มีให้ระบุว่า "ไม่มี")</small></label>
                                            <select class="multiple-tag" name="visit_drug[]" multiple="multiple">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="fa fa-file-medical"></i> สิทธิ์การรักษา</label>
                                            <input type="text" name="visit_uc" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="far fa-calendar-plus"></i> วันที่ Admit</label>
                                            <input type="text" name="visit_admit" class="form-control basicDate" readonly required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="fa fa-user-md"></i> แพทย์ผู้ดูแล</label>
                                            <select name="visit_doctor" class="custom-select" required>
                                                <option value="">เลือก</option>
                                                <option value="2">• วริยดา เบี้ยวบรรจง</option>
                                                <option value="3">• ศิริประภา สมถา</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for=""><i class="fa fa-clinic-medical"></i> สถานที่ Admit</label>
                                            <select name="visit_hos" class="custom-select" required>
                                                <option value="">เลือก</option>
                                                @foreach ($hname as $hos)
                                                <option value="{{ $hos->hos_id }}">• {{ $hos->hos_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">
                                                <i class="fa fa-pills"></i> ยา Standing
                                            </label>
                                            <!-- checkbox -->
                                            <div class="form-group clearfix col-md-12">
                                                @php $i=0; @endphp
                                                @foreach ($stdorder as $drug)
                                                @php $i++; @endphp
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="drug{{ $i }}" name="drug[]" value="{{ $drug->sd_name }}">
                                                    <label for="drug{{ $i }}">
                                                        {{ $drug->sd_name }}
                                                    </label>
                                                </div><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-info"
                                    onclick=
                                    "Swal.fire({
                                        title: 'ยืนยันการลงทะเบียนผู้ป่วย ?',
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
                                        <i class="fa fa-check-circle"></i> บันทึกข้อมูล
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
