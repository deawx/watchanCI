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
        <div class="row">
            <div class="col-lg-12">
                <!-- Small boxes (Stat box) -->
                @foreach ($count as $cts)                    
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $cts->admit + $cts->well }} <small>ราย</small></h3>
                                <p>ยอดผู้ป่วยสะสม</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clipboard-list"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                รายละเอียดเพิ่มเติม <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $cts->well }} <small>ราย</small></h3>
                                <p>ยอดผู้ป่วยที่รักษาหายแล้ว</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-check-square"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                รายละเอียดเพิ่มเติม <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $cts->admit }} <small>ราย</small></h3>
                                <p>ยอดผู้ป่วยที่กำลังรักษา</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bed"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                รายละเอียดเพิ่มเติม <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $cts->refer }} <small>ราย</small></h3>
                                <p>ยอดผู้ป่วยที่ส่งต่อ</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-ambulance"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                รายละเอียดเพิ่มเติม <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0"><i class="fa fa-chart-bar"></i> สรุปยอดผู้ป่วย</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($month as $res)
                        @endforeach
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="myChart" width="480" height="250"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="myPolar" width="480" height="250"></canvas>
                            </div>
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
    Chart.defaults.font.family = 'Prompt';
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 
                'เมษายน', 'พฤษภาคม', 'มิถุนายน','กรกฎาคม', 'สิงหาคม', 'กันยายน', 
            ],
            datasets: [{
                label: 'ยอดจำนวนผู้ป่วยเข้ารับการรักษา',
                data: [
                    '{{ $res->m10 }}', '{{ $res->m11 }}', '{{ $res->m12 }}', '{{ $res->m1 }}',
                    '{{ $res->m2 }}', '{{ $res->m3 }}', '{{ $res->m4 }}', '{{ $res->m5 }}',
                    '{{ $res->m6 }}', '{{ $res->m7 }}', '{{ $res->m8 }}', '{{ $res->m9 }}'
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var pol = document.getElementById('myPolar');
    var myPolar = new Chart(pol, {
        type: 'bar',
        data: {
            labels: [
                'ชาย', 'หญิง'
            ],
            datasets: [{
                label: 'ยอดจำนวนผู้ป่วยเข้ารับการรักษา แยกตามเพศ',
                data: [{{ $male }}, {{ $female }}],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                ]
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
