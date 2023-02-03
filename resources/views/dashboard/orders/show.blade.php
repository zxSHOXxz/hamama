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
                            <div class="card-tools">
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
                                        <th>#</th>
                                        <th> اسم العميل </th>
                                        <th> السعر شامل التوصيل </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> الحالة </th>
                                        <th> تفاصيل الحالة </th>
                                        <th> اسم الكابتن </th>
                                        <th> تفاصيل الطلب </th>
                                        <th>تاريخ التعديل</th>
                                        <th>تاريخ الانشاء</th>
                                        <th> QrCode </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->client->user->name }}</td>
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
                                        <td>{{ $order->statusDetails }}</td>
                                        <td>{{ $order->captain->user->name ?? null }}</td>
                                        <td>{{ $order->details }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ QrCode::size('55')->encoding('UTF-8')->generate(
                                                ' : اسم العميل ' .
                                                    $order->client->user->name  .
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
                                </tbody>
                            </table>
                            <!-- /.card-body -->
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
