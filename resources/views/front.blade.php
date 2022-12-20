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
                        <nav class="mt-lg-4 bg-gradient-dark">
                            <div class="logos d-flex justify-content-between align-items-center">
                                <div class="image rounded-circle m-1">
                                    <img src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}"
                                        class="rounded-circle" alt="">
                                </div>
                                <div class="text-light">
                                    حـمـامـة
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="{{ route('list') }}" class=""><i class="fa-solid fa-user"></i>
                                    تسجيل دخول</a>
                                <a href="" class="">تسجيل</a>
                            </div>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col right">
                            <div class="">
                                <div class="one py-3">ديلفري</div>
                                <div class="one py-3">ليسـت</div>
                                <div class="one py-3">مـجـرد</div>
                                <div class="one py-3">خـدمة</div>
                            </div>
                            <div class="image rounded-circle m-1">
                                <img src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}"
                                    class="rounded-circle" alt="">
                            </div>
                        </div>
                        <div class="col left"></div>
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
