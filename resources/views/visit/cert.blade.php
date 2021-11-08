<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>พิมพ์ใบรับรองแพทย์ {{ 'CM'.$list->visit_cm }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/font_sarabun.css">
    <style type="text/css">
        body {
            overflow: hidden;
        }
    </style>
</head>
    <body>
        <div class="container">
            <div class="card-body">
                <div class="text-right">
                    <h6>{{ 'CM'.$list->visit_cm  }}</h6>
                </div>
                <div class="text-center">
                    <img src="{{ asset('img') }}/moph.png" class="img img-fluid" width="20%;">
                    <h4 style="font-weight: bold;margin-top: 1rem;">ใบรับรองแพทย์ ศูนย์พักคอยอำเภอกัลยาณิวัฒนา จังหวัดเชียงใหม่</h4>
                </div>
                <div>
                    <span>ข้าพเจ้า</span>
                    <span style="font-weight: bold;">{{ 'แพทย์หญิง'.$list->name }}</span><br>
                    <span>ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่</span>
                    <span style="font-weight: bold;">{{ $list->dno }}</span><br>
                    <span>ขอรับรองว่า ผู้ป่วยชื่อ</span>
                    <span style="font-weight: bold;">{{ $list->visit_patient }}</span> อายุ 
                    <span style="font-weight: bold;">{{ $list->visit_age }}</span> ปี<br>
                    <span style="font-weight: bold;">วินิจฉัยว่าเป็นโรค : โรคโควิด-19 (COVID-19)</span><br>
                    <span style="font-weight: bold;">รักษาตัวเป็นผู้ป่วยในศูนย์พักคอย อำเภอกัลยาณิวัฒนา จังหวัดเชียงใหม่</span><br>
                    <span>ตั้งแต่วันที่
                        <span style="font-weight: bold;">{{ DateThaiFull($list->visit_admit) }}</span>
                        จนถึงวันที่ 
                        <span style="font-weight: bold;">{{ DateThaiFull($list->visit_dc) }}</span>
                    </span>
                </div>
                <div class="text-right">
                    <span>** ขอให้ผู้ป่วยกักตัวอยู่ที่บ้านต่ออีก 4 วัน ** <small class="text-muted">( Home Isolation : HI )</small></span><br>
                </div>
                <div style="margin-top: 5rem;">
                    <span style="font-weight: bold;">คำแนะนำ</span><br>
                    <span>ให้สวมหน้ากากอนามัย และระมัดระวังสุขอนามัยส่วนบุคคลต่อไป ตามมาตรฐานวิถีใหม่ ( New Normal )</span><br>
                </div>
                <div class="text-right" style="margin-top: 1.5rem;">
                    <span>ลงชื่อ .....................................................................................</span><br>
                    <span style="font-weight: bold;">( {{ 'แพทย์หญิง'.$list->name }} )</span><br>
                </div>
                <div style="margin-top: 5rem;">
                    <span style="font-weight: bold;">หมายเหตุ: </span>
                    <span>การนับ 14 วัน นับหลังจากวันที่เริ่มป่วย (วันที่มีอาการ) กรณีไม่มีอาการให้เริ่มนับจากวันที่เก็บตัวอย่าง (SWAB)</span><br>
                    <span>อ้างอิง: มาตรฐานการรักษาผู้ป่วยโควิด-19 กรมการแพทย์ กระทรวงสาธารณสุข ฉบับ 17 เมษายน 2564</span>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print();
    </script>
</html>