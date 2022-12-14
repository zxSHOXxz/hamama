@extends('dashboard.master')
@section('title', 'طلبات العميل')

@section('main-title', 'عرض طلبات العميل')
@section('sub-title', 'عرض طلبات العميل')

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
                            <a href="{{ route('createOrder', $id) }}" type="submit" class="btn btn-lg btn-success">إضافة
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
                                        <th> رقم الطلب </th>
                                        <th> اسم العميل </th>
                                        <th> سعر الطلب </th>
                                        <th> السعر شامل التوصيل </th>
                                        <th> اسم المدينة </th>
                                        <th> اسم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->client->user->name }}</td>
                                            <td>{{ $order->price }}</td>
                                            @php
                                                $total = $order->city->bonuses->price + $order->price;
                                            @endphp
                                            <td>{{ $order->city->bonuses->price . '+' . $order->price . '=' . $total }}</td>
                                            <td>{{ $order->city->name }}</td>
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

                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary"
                                                        title="Edit">
                                                        تعديل
                                                    </a>
                                                    <a href="#" onclick="performDestroy({{ $order->id }} , this)"
                                                        class="btn btn-danger" title="Delete">
                                                        حذف
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="span text-center" style="margin-top: 20px; margin-bottom:10px">

                                </span>

                            </div>
                            <!-- /.card-body -->
                            @if ($orders)
                                {{ $orders->links() }}
                            @endif
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>


@endsection

@section('scripts')

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/orders/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
