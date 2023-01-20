<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box m-auto pt-5">
        <div class="login-logo">
            <a href="cms/index2.html"><b>حمامة ديلفري</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg">كيف تريد تسجيل دخول ؟</p>
                <div class="button-group text-center">
                    <a href="{{ route('view.login', ['guard' => 'client']) }}" class="btn btn-danger"> عميل </a>
                    <a href="{{ route('view.login', ['guard' => 'admin  ']) }}" class="btn btn-danger"> مشرف </a>
                </div>

                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="{{ asset('crudjs/crud.js') }}"></script>

        <script>
            // function login(){

            //     var guard = '{{ request('guard') }}';
            //     axios.post('/cms/'+guard+'/login', {
            //         email : document.getElementById('email').value,
            //         password : document.getElementById('password').value,
            //         guard : guard,
            //     })
            //         .then(function (response) {
            //             window.location.href = '/cms/admin'

            //         })
            //         .catch(function (error) {
            //             if (error.response.data.errors !== undefined) {
            //               showErrorMessages(error.response.data.errors);

            //             } else {
            //                 showMessage(error.response.data);
            //             }
            //         });

            // }
        </script>
</body>

</html>
