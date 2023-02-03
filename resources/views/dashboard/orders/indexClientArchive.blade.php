@extends('dashboard.master')
@section('title', 'ارشيف طلبات العميل')

@section('main-title', 'عرض ارشيف طلبات العميل')
@section('sub-title', 'عرض ارشيف طلبات العميل')

@section('styles')
    <style>

    </style>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> ارشيف الطلبات</h3>
                            <a href="{{ route('createOrder', Auth::guard('client')->user()->id ) }}" type="submit"
                                class="btn btn-md btn-outline-success">إضافة
                                طلب
                                جديد</a>
                            <br>
                        </div>
                        <div class="card-tools">
                            <form action="" method="get" class="m-3">

                                <div class="row">
                                    <div class="input-icon col-md-3 col-12">
                                        <label for="start_date"> اسم المحافظة </label>
                                        <input type="text" class="form-control"
                                            placeholder="ابحث من خلال اسم المحافظة الفرعية" name='sub_city' id="sub_city"
                                            @if (request()->sub_city) value={{ request()->sub_city }} @endif />
                                    </div>
                                    <div class="input-icon col-md-3 col-12">
                                        <label for="start_date">تاريخ </label>
                                        <input type="date" class="form-control"
                                            placeholder="ابحث من خلال تاريخ الانشاء " name='created_at' id="created_at"
                                            @if (request()->created_at) value={{ request()->created_at }} @endif />
                                    </div>
                                </div>
                                    <div class="row">

                                        <div class="col mt-4">
                                            <button class="btn btn-danger btn-md submit" type="submit">Filter</button>
                                            <a href="{{ route('clientArchive') }}" type="button"
                                                class="btn btn-info">إنهاء
                                                البحث </a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th> السعر شامل التوصيل </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th>موعد ارسال الطلب</th>
                                        <th> Qr Code </th>
                                        @canany(['show-order'])
                                            <th>الاعدادات</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            @php
                                                $total = $order->city->bonuses->price + $order->price;
                                            @endphp
                                            <td class="text-wrap" widt='10%'>
                                                {{ $order->city->bonuses->price . '+' . $order->price . '=' . $total }}</td>
                                            <td class="text-wrap" widt='10%'>
                                                {{ $order->city->name . '(' . $order->sub_city->name . ')' }}</td>
                                            <td class="text-wrap" widt='10%'>{{ $order->customer }}</td>
                                            <td class="text-wrap" widt='10%'>
                                                @if ($order->status == 'waiting')
                                                    جار الارسال
                                                @elseif ($order->status == 'done')
                                                    تمت عملية الارسال
                                                @else
                                                    فشلت عملية الارسال
                                                @endif
                                            </td>
                                            <td class="text-wrap" widt='10%'>{{ $order->captain->user->name ?? null}}</td>
                                            <td class="text-wrap" widt='15%'>{{ $order->details }}</td>
                                            <td class="text-wrap" widt='10%'>
                                                <div class="badge badge-danger">
                                                    @if (
                                                        $order->created_at >=
                                                            \Carbon\Carbon::today()->hour(12)->minute(10) && $order->created_at <= \Carbon\Carbon::today()->hour(14))
                                                        سيتم الترحيل للغد
                                                    @else
                                                        طبيعي
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-wrap" widt='15%'>
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
                                            </td>
                                            @can('show-order')
                                            <td widt='15%'>
                                                <div class="btn group">
                                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success"
                                                            title="عرض">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.card-body -->
                            <div class="d-flex justify-content-center">
                                @if ($orders)
                                    {{ $orders->links() }}
                                @endif
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>


@endsection

@section('scripts')

    <script>

    </script>

@endsection
