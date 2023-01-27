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
                                <a href="{{ route('orders.create') }}" type="submit" class="btn btn-md btn-success">إضافة طلب
                                    جديد</a>
                                <a href="{{ route('exportSearched', request()->query()) }}"
                                    class="btn btn-md btn-outline-dark">
                                    <i class="fa-solid fa-file-excel"></i>
                                    تصدير اكسل
                                </a>
                                <form action="" method="get" class="m-3">

                                    <div class="row">

                                        <div class="input-icon col-md-3 col-12">
                                            <label for="start_date"> اسم المحافظة </label>
                                            <input type="text" class="form-control"
                                                placeholder="ابحث من خلال اسم المحافظة" name='sub_city' id="sub_city"
                                                @if (request()->sub_city) value={{ request()->sub_city }} @endif />
                                        </div>

                                        <div class="input-icon col-md-3 col-12">
                                            <label for="client_name">اسم العميل</label>
                                            <input type="text" class="form-control" placeholder="ادخل اسم العميل"
                                                name='client_name' id="client_name"
                                                @if (request()->client_name) value={{ request()->client_name }} @endif />
                                        </div>

                                        <div class="input-icon col-md-3 col-12">
                                            <label for="captain_name">اسم الكابتن</label>
                                            <input type="text" class="form-control" placeholder="ادخل اسم الكابتن"
                                                name='captain_name' id="captain_name"
                                                @if (request()->captain_name) value={{ request()->captain_name }} @endif />
                                        </div>

                                        <div class="input-icon col-md-3 col-12">
                                            <label for="start_date">تاريخ </label>
                                            <input type="date" class="form-control"
                                                placeholder="ابحث من خلال تاريخ الانشاء " name='created_at' id="created_at"
                                                @if (request()->created_at) value={{ request()->created_at }} @endif />
                                        </div>

                                        <div class="col mt-4">
                                            <button class="btn btn-danger btn-md submit" type="submit">Filter</button>
                                            <a href="{{ route('orders_archive') }}" type="button"
                                                class="btn btn-info">إنهاء
                                                البحث </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th> اسم العميل </th>
                                        <th> سعر الطلب </th>
                                        <th> التوصيل </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th> Qr Code </th>
                                        @canany(['update-order', 'delete-order'])
                                            <th>الاعدادات</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->user->name }}</td>
                                            <td>{{ $order->price }}</td>
                                            @php
                                                $total = $order->city->bonuses->price ?? 0 + $order->price;
                                            @endphp
                                            <td>{{ $order->city->bonuses->price ?? 'null' . '+' . $order->price . '=' . $total }}
                                            </td>
                                            <td>{{ $order->city->name ?? null . '(' . $order->sub_city->name ?? null . ')' }}</td>
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
