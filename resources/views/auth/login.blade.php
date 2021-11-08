<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WATCHAN | CI : กรุณาเข้าสู่ระบบ</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <small>WATCHAN CI</small>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">กรุณาเข้าสู่ระบบ</p>
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    @if($message = Session::get('valid'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ $message }}</span>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" name="code" class="form-control" placeholder="ชื่อผู้ใช้งาน">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                       <button type="submit" class="btn btn-info btn-block">
                           <i class="fa fa-check-circle"></i> ลงชื่อเข้าใช้งาน
                       </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
