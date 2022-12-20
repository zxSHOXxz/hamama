@extends('dashboard.print')
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
            <div class="row d-flex justify-content-center align-items-md-start">
                <div class="col-12 mx-auto">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-dark">
                                        <th> اسم العميل </th>
                                        <th> السعر </th>
                                        <th> اسم المحافظة </th>
                                        <th> رقم الزبون</th>
                                        <th> تفاصيل الطلب </th>
                                        <th> QrCode </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->client->user->name }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $order->city->name . '(' . $order->sub_city->name . ')' }}</td>
                                        <td>{{ $order->customer }}</td>
                                        <td>{{ $order->details }}</td>
                                        <td>{{ QrCode::size(50)->generate(url('cms/admin/orders/' . $order->id)) }}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <!-- /.card-body -->
                            <div class="d-flex justify-content-center">

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
        window.print();

        function performDestroy(id, referance) {
            let url = '/cms/admin/orders/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
