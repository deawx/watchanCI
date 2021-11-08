<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WATCHAN | CI</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('toggle/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datepicker/jquery.datetimepicker.css') }}">
    <link rel="stylesheet"href="{{ asset('select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.nav')
        @include('layouts.side')
        {{-- CONTENT --}}
        @yield('content')
        {{-- END --}}
        @include('layouts.foot')
    </div>
</body>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('toggle/bootstrap-toggle.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('datepicker') }}/jquery.datetimepicker.full.js"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
<script>
        // DATATABLES
        $(document).ready(function () {
            $('#tableBasic').dataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                scrollX: true,
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
        
        // DATATIME_PICKER 
        $(function() {
        $.datetimepicker.setLocale('th');
            $(".basicDate").datetimepicker({
                format: 'Y-m-d',
                timepicker: false,
                lang: 'th',
            });
        });

        // SELECT2
        $(document).ready(function() {
            $('.basicSelect2').select2({
                width: '100%',
                placeholder: 'กรุณาเลือก',
            });
        });

        $(document).ready(function () {
            $('.multiple-tag').select2({
                width: '100%',
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: 'เพิ่มได้หลายรายการ'
            });
        });

        window.setTimeout(function() {
            $("#alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);

    </script>
@section('script')
@show

</html>
