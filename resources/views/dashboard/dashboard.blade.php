@extends('dashboard.master')

@section('title', 'المحافظات الفرعية')

@section('styles')
    <style>
        .card-header>.card-tools {
            float: left;
        }

        .card-header>.card-title {
            float: right;
        }
    </style>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (Auth::guard('admin')->check())
                <div class="row">

                    <div class="col-lg-3 col-6 ">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($orders) }}</h3>
                                <p>عدد طلبات اليوم</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                @php
                                    $clientsHasOrder = $clients->where('orders_count', '!=', null);
                                @endphp
                                <h3>{{ count($clientsHasOrder) }}</h3>
                                <p>عدد عملاء اليوم</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                @php
                                    $success_order = $orders->where('status', 'done');
                                    $oo = count($orders) != 0 ? count($orders) : 1;
                                    $avg = (count($success_order) * 100) / $oo;
                                @endphp
                                <h3>{{ $avg }}<sup style="font-size: 20px">%</sup></h3>
                                <p>الطلبات الناجحة اليوم</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ count($newClients) }}</h3>
                                <p>العملاء الجدد</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                عرض المزيد<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">طلبات اليوم</h3>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>اسم العميل</th>
                                            <th>اسم المحافظة</th>
                                            <th style="width: 40px">السعر</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($orders as $order)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $order->id }}.</td>
                                                <td>{{ $order->client->user->name }}</td>
                                                <td>{{ $order->sub_city->name }}</td>
                                                <td><span
                                                        class="badge @if ($i == 1) {{ 'bg-danger' }}
                                                    @elseif($i == 2)
                                                        {{ 'bg-warning' }}
                                                    @elseif($i == 3)
                                                        {{ 'bg-primary' }}
                                                    @elseif($i == 4)
                                                        {{ 'bg-success' }}
                                                    @elseif($i == 5)
                                                        {{ 'bg-danger' }} @endif
                                                        ">{{ $order->price }}</span>
                                                </td>
                                                @if ($loop->iteration >= 5)
                                                @break
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">عملاء اليوم</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>اسم العميل</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($clientsHasOrder as $client)
                                        @php
                                            $avg = (count($client->orders->where('status', 'done')) * 100) / $client->orders_count;
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $client->id }}.</td>
                                            <td>{{ $client->user->name }}</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar @if ($i == 1) {{ 'bg-primary' }}
                                                    @elseif($i == 2)
                                                        {{ 'bg-warning' }}
                                                    @elseif($i == 3)
                                                        {{ 'bg-primary' }}
                                                    @elseif($i == 4)
                                                        {{ 'bg-success' }}
                                                    @elseif($i == 5)
                                                        {{ 'bg-danger' }} @endif
                                                        "
                                                        style="width: {{ $avg }}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge @if ($i == 1) {{ 'bg-danger' }}
                                                        @elseif($i == 2)
                                                            {{ 'bg-warning' }}
                                                        @elseif($i == 3)
                                                            {{ 'bg-primary' }}
                                                        @elseif($i == 4)
                                                            {{ 'bg-success' }}
                                                        @elseif($i == 5)
                                                            {{ 'bg-danger' }} @endif
                                                            ">{{ $avg }}%</span>
                                            </td>
                                        </tr>
                                        @if ($loop->iteration >= 5)
                                        @break
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">الطلبات الناجحة</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($success_order as $order)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $order->id }}.</td>
                                        <td>{{ $order->client->user->name }}</td>
                                        <td>
                                            {{ $order->sub_city->name }}
                                        </td>
                                        <td><span
                                                class="badge @if ($i == 1) {{ 'bg-danger' }}
                                                    @elseif($i == 2)
                                                        {{ 'bg-warning' }}
                                                    @elseif($i == 3)
                                                        {{ 'bg-primary' }}
                                                    @elseif($i == 4)
                                                        {{ 'bg-success' }}
                                                    @elseif($i == 5)
                                                        {{ 'bg-danger' }} @endif
                                                        ">{{ $order->price }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <iframe name="prayertimes"
                    src="https://www.prayertimes.org/embedprayertimes.php?city=Gaza&logo=true&showtitle=true&showlink=true&textcolor=%23ffffff&bgcolor=%23506a1b&bordercolor=%236e9226"
                    height="240" width="320" style="border:none;border-radius:13px;" scrolling="no"></iframe>
            </div>


        </div>
    @endif

    @if (Auth::guard('client')->check())
        <div class="row">

            <div class="col-lg-3 col-6 ">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count($orders->where('client_id', Auth::user()->id)) }}</h3>
                        <p>عدد طلبات اليوم</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('indexOrders', ['id' => Auth::id()]) }}" class="small-box-footer">
                        عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        @php
                            $success_order = $orders->where('client_id', Auth::user()->id)->where('status', 'done');
                        @endphp
                        <h3>{{ count($success_order) }}</h3>
                        <p>الطلبات الناجحة اليوم</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        @php
                            $success_order = $orders->where('client_id', Auth::user()->id)->where('status', 'fail');
                        @endphp
                        <h3>{{ count($success_order) }}</h3>
                        <p>الطلبات الفاشلة اليوم</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        @php
                            $success_order = $orders->where('client_id', Auth::user()->id)->whereBetween('created_at', [
                                \Carbon\Carbon::yesterday()->hour(14),
                                \Carbon\Carbon::today()
                                    ->hour(12)
                                    ->minute(10),
                            ]);
                        @endphp
                        <h3>{{ count($success_order) }}</h3>
                        <p>الطلبات المؤجلة للغد</p>
                    </div>
                    <div class="icon">

                    </div>
                    <a href="#" class="small-box-footer">
                        عرض المزيد <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 ">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="text-align: left">×</button>
                    <h5><i class="icon fas fa-warning"></i> تحذير</h5>
                    الطلبات التي يتم ارسالها بعد 12 ظهرا تترحل تلقائيا لليوم التالي
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 ">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="text-align: left">×</button>
                    <h5><i class="icon fas fa-warning"></i> تحذير</h5>
                    ضع العنوان كامل بساعد ع تسليم طلبك اسرع
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 ">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="text-align: left">×</button>
                    <h5><i class="icon fas fa-warning"></i> تحذير</h5>
                    ضع اسم الزبون في تفاصيل الطلب حتى نستطيع الوصول له في حالة عدم الرد
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 ">
                <div class="alert alert-dark alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="text-align: left">×</button>
                    <h5><i class="icon fas fa-warning"></i> تحذير</h5>
                    تأكد من معلومات الطلب قبل ارسالها لا يمكن تعديلها
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 ">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="text-align: left">×</button>
                    <h5><i class="icon fas fa-warning"></i> تنبيه</h5>
                    يمكنك معرفة سعر التوصيل بعد ادخال الطلب مباشرة
                </div>
            </div>
        </div>
    @endif
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

</section>
<!-- /.content -->

@endsection

@section('scripts')
<script></script>
@endsection
