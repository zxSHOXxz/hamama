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
                            <a href="{{ route('createOrder', $id) }}" type="submit"
                                class="btn btn-md btn-outline-success">إضافة
                                طلب
                                جديد</a>
                            <a href="{{ route('exportSearched', request()->query()) }}" class="btn btn-md btn-outline-dark">
                                <i class="fa-solid fa-file-excel"></i>
                                تصدير اكسل
                            </a>
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
                                        <th> السعر شامل التوصيل </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        @canany(['update-order', 'delete-order'])
                                            <th>الاعدادات</th>
                                        @endcanany
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
                                            <td>{{ $order->city->name . '(' . $order->sub_city->name . ')' }}</td>
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
                                            @canany(['update-order', 'delete-order'])
                                                <td>
                                                    <div class="btn group">
                                                        @can('update-order')
                                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                        @endcan
                                                        @can('show-order')
                                                            <a href="{{ route('orders.show', $order->id) }}"
                                                                class="btn btn-success" title="show">
                                                                عرض
                                                            </a>
                                                        @endcan
                                                        @can('delete-order')
                                                            <a href="#" onclick="performDestroy({{ $order->id }} , this)"
                                                                class="btn btn-danger" title="Delete">
                                                                حذف
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany

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

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/orders/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
