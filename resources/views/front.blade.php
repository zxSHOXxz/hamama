<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('front/stayle.css') }}">
    <title> حمامة ديلفري </title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="hero vh-100">
                <div class="container d-flex flex-column">
                    <div class="row">
                        <nav>
                            <div class="logos d-flex justify-content-center align-items-center">
                                <img src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}"
                                    class="img img-fluid" alt="">
                                <div class="text-light">
                                    حمامة
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="{{ route('list') }}" class=""><i class="fa-solid fa-user"></i>
                                    تسجيل دخول</a>
                                <a href="" class="">تسجيل</a>
                            </div>
                        </nav>
                    </div>
                    <div class="row text-hero">
                        <h1>
                            حمامة ديلفري<br> ليست مجرد خدمة
                        </h1>
                        <div class="bests d-flex justify-content-around">
                            <div class="one d-flex justify-content-between align-items-center">
                                <div class="img">
                                    <img src="{{ asset('front/1_53d821b1-0997-41f5-90cb-d36062376689.webp') }}"
                                        alt="">
                                </div>
                                <span> سرعة عالية </span>
                            </div>
                            <div class="one d-flex justify-content-between align-items-center">
                                <div class="img">
                                    <img src="{{ asset('front/2.png') }}" alt="">
                                </div>
                                <span> اسعار مميزة </span>
                            </div>
                            <div class="one d-flex justify-content-between align-items-center">
                                <div class="img">
                                    <img src="{{ asset('front/3.png') }}" alt="">
                                </div>
                                <span> دعم متواصل </span>
                            </div>
                        </div>
                    </div>
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
