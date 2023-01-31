<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفعيل الايميل</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <!-- /.login-logo -->
    <div class="login-box" style="margin: 10% auto !important;">
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> تحذير ! </h5>
            <p>
                يجب عليك تأكيد الايميل الشخصي , يرجى التحقق من البريد الوارد في ايميلك
                <br>
                <br>
                اذا لم تصلك رسالة بإمكانك طلب رسالة اخرى

                <a href="{{ route('verification.send') }}" onclick="event.preventDefault(); document.getElementById('form').submit()" class="btn btn-warning"> من هنا </a>
                <form action="{{ route('verification.send') }}" id="form" method="post">
                @csrf
            </form>
            </p>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
