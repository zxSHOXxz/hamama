@extends('dashboard.print')
@section('title', 'طلبات العميل')

@section('main-title', 'عرض طلبات العميل')
@section('sub-title', 'عرض طلبات العميل')

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');

        .logos {
            width: 100%;
            height: 75px;
        }

        .info {
            width: 100%;
            height: 75px;
        }

        .img {
            height: 100%;
        }

        .img img {
            height: 100%;
            object-fit: contain;
        }

        span {
            padding: 15px;
            font-family: 'Amiri', serif;
            font-size: 18px;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')


    <section class="content py-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="row logos">
                        <div class="img col-6">
                            <img src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}"
                                alt="Hamama Logo" class="img-circle">
                        </div>
                        <div class="qr-code col-6 text-right">
                            {{ QrCode::size('75')->encoding('UTF-8')->generate(
                                    ' : اسم العميل ' .
                                        $order->client->user->name .
                                        ' : السعر ' .
                                        $order->price .
                                        ' : رقم الزبون ' .
                                        $order->customer .
                                        ' : المحافظة ' .
                                        $order->city->name .
                                        '(' .
                                        $order->sub_city->name .
                                        ')' .
                                        ' : التفاصيل ' .
                                        $order->details,
                                ) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row row-col-2 info ">
                                <div class="client col-6  py-2">
                                    <span>اسم العميل
                                        : {{ $order->client->user->name }}</span>
                                </div>
                                <div class="customer col-6 py-2">
                                    <span> رقم الزبون : {{ $order->customer }}</span>
                                </div>

                                <div class="price col-6 py-2">
                                    <span> السعر : {{ $order->price }}</span>
                                </div>
                                <div class="sub_city col-6 py-2">
                                    <span> المحافظة الفرعية :
                                        {{ $order->city->name . '(' . $order->sub_city->name . ')' }}</span>
                                </div>
                                <div class="details col-12 py-2 text-center">
                                    <span class="text-center">
                                        التفاصيل : {{ $order->details }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

@section('scripts')

    <script>
        window.print();
    </script>

@endsection
