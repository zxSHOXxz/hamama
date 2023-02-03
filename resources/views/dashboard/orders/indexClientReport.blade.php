@extends('dashboard.master')
@section('title', 'تقرير طلبات امس')

@section('main-title', 'تقرير امس')
@section('sub-title', 'تقرير امس')

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
                            <h3 class="card-title">الطلبات</h3>
                            <a href="{{ route('createOrder', $id) }}" type="submit"
                                class="btn btn-md btn-outline-success">إضافة
                                طلب
                                جديد</a>

                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th> تاريخ الطلب </th>
                                        <th> سعر الطلب </th>
                                        <th> التوصيل </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th> Qr Code </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->price }}</td>
                                            @php
                                                $total = $order->city->bonuses->price + $order->price;
                                            @endphp
                                            <td>{{ $order->city->bonuses->price . '+' . $order->price . '=' . $total }}</td>
                                            <td>{{ '(' . $order->sub_city->name . ')' }}</td>
                                            <td>{{ $order->customer }}</td>
                                            <td>
                                                @if ($order->status == 'waiting')
                                                    جار الارسال
                                                @elseif ($order->status == 'done')
                                                    تمت عملية الارسال
                                                @else
                                                    فشلت عملية الارسال
                                                @endif
                                            </td>
                                            <td>{{ $order->captain->user->name }}</td>
                                            <td>{{ $order->details }}</td>
                                            <td>{{ QrCode::size('75')->encoding('UTF-8')->generate(
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

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="span text-center" style="margin-top: 20px; margin-bottom:10px">

                                </span>

                            </div>
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

@endsection
