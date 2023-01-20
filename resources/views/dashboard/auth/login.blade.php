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
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="hold-transition login-page d-md-flex justify-content-center align-items-center">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">تسجيل حساب</p>

                <form action="{{ route('sign_up') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="يرجى ادخال الاسم" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="mobile" name="mobile"
                            placeholder="يرجى ادخال رقم الهاتف">
                        <div class="input-group-append" required>
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="ادخل العنوان">
                        <div class="input-group-append" required>
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="ادخل الايميل">
                        <div class="input-group-append" required>
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="ادخل كلمة مرور" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                            aria-label=".form-select-sm example">
                            <option value="male">ذكر</option>
                            <option value="female">انثى</option>
                        </select>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <!-- /.col -->
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary btn-block" value="تسجيل">
                        </div>

                        <!-- /.col -->
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">سجل دخول</p>

                <form>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email_sign_in" name="email"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password_sign_in" name="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" onclick="login()" class="btn btn-primary btn-block">تسجيل
                                دخول</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <a href="#" class="btn btn-block btn-secondary">
                        <i class="fa-solid fa-phone mr-2"></i> لا تردد في الاتصال علينا
                    </a>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> تابعنا عبر الفيسبوك
                    </a>
                    <a href="#" class="btn btn-block btn-success">
                        <i class="fab fa-whatsapp mr-2"></i> تواصل معنا عبر الواتساب
                    </a>
                    <a href="#" class="btn btn-block btn-dark">
                        <i class="fab fa-instagram mr-2"></i> تابعنا على الانستجرام
                    </a>
                </div>
                <!-- /.social-auth-links -->
                @can('index-admin')
                    <p class="mb-1">
                        <a href="{{ route('list') }}"> قائمة كيف تريد تسجيل الدخول </a>
                    </p>
                @endcan
                {{-- <p class="mb-1">
                    <a href="forgot-password.html">نسيت كلمة المرور</a>
                </p> --}}
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
        function login() {

            var guard = '{{ request('guard') }}';
            axios.post('/cms/' + guard + '/login', {
                    email: document.getElementById('email_sign_in').value,
                    password: document.getElementById('password_sign_in').value,
                    guard: guard,
                })
                .then(function(response) {
                    window.location.href = '/cms/admin'

                })
                .catch(function(error) {
                    if (error.response.data.errors !== undefined) {
                        showErrorMessages(error.response.data.errors);

                    } else {
                        showMessage(error.response.data);
                    }
                });

        }
    </script>
</body>

</html>
