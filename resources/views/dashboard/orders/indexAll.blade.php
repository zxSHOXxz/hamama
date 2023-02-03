@extends('dashboard.master')
@section('title', 'الطلب')

@section('main-title', 'عرض الطلب')
@section('sub-title', 'عرض الطلب')

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
                            <h3 class="card-title">الطلب</h3>
                            <div class="card-tools">
                                <a href="{{ route('orders.create') }}" type="submit"
                                    class="btn btn-md btn-success mx-1">إضافة طلب
                                    جديد</a>
                                <a href="{{ route('exportSearched', request()->query()) }}"
                                    class="btn btn-md btn-outline-dark">
                                    <i class="fa-solid fa-file-excel"></i>
                                    تصدير اكسل
                                </a>
                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th> Qr Code </th>
                                        <th> اسم العميل </th>
                                        <th> سعر الطلب </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th> السعر شامل التوصيل </th>
                                        @canany(['update-order', 'delete-order'])
                                            <th>الاعدادات</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
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
                                            <td>{{ $order->client->user->name ?? null }}</td>
                                            <td>{{ $order->price }}</td>
                                            @php
                                                $total = $order->city->bonuses->price + $order->price;
                                            @endphp
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
                                            <td>{{ $order->captain->user->name ?? null }}</td>
                                            <td class="text-wrap" widt='15%'>{{ $order->details }}</td>
                                            <td>{{ $order->city->bonuses->price . '+' . $order->price . '=' . $total }}</td>
                                            @canany(['update-order', 'delete-order'])
                                                <td>
                                                    <div class="btn group">
                                                        @can('update-order')
                                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                                class="btn btn-primary" title="Edit">
                                                                تعديل
                                                            </a>
                                                        @endcan
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                            class="btn btn-success" title="show">
                                                            عرض
                                                        </a>
                                                        <a href="{{ route('order_print', $order->id) }}" class="btn btn-dark"
                                                            title="print">
                                                            <i class="fa-solid fa-print"></i>
                                                        </a>
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
