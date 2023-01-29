<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('front/stayle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=neckar-bold" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <title> حمامة ديلفري </title>
</head>

<body>
    <div class="hero vh-100 overflow-hidden">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img class="img-circle img-bordered-sm"
                        src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}" alt="">
                    حمامة ديلفري</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">خدماتنا</a>
                        </li>
                        <li class="nav-item d-flex">
                            <a href="https://www.facebook.com/hamama.delivery" class="nav-link m-1 m-md-0"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.facebook.com/hamama.delivery" class="nav-link m-1 m-md-0"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="https://wa.link/d4mwjk" class="nav-link m-1 m-md-0"><i
                                    class="fa-brands fa-whatsapp"></i></a>
                            <a href="tel:0592881213" class="nav-link phone_one m-1 m-md-0"><i
                                    class="fa-solid fa-phone"></i></a>
                            <a href="tel:0599690190" class="nav-link phone_two m-1 m-md-0"><i
                                    class="fa-solid fa-phone"></i></a>
                            <a href="tel:082881213" class="nav-link m-1 m-md-0"><i
                                    class="fa-solid fa-phone-rotary"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="hero-main d-flex align-items-stretch h-100">
            <div class="container">
                <div class="text h-100 d-flex flex-column justify-content-center">
                    <h1>
                        حمامة ديلفري
                    </h1>
                    <h3>
                        للخدمات اللوجيستية
                    </h3>
                    <h5>
                        ليست مجرد خدمة
                    </h5>
                    <div class="buttons">
                        <a class="btn btn-warning px-4" href="{{ route('login') }}">تسجيل دخول /
                            تسجيل</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
