@extends('dashboard.master')

@section('title', ' الطلب')

@section('main-title', 'تعديل الطلب')
@section('sub-title', 'تعديل الطلب')

@section('styles')

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">انشاء الطلب</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="customer"> رقم هاتف صاحب الطلب </label>
                                        <input type="text" name="customer" class="form-control" id="customer"
                                            placeholder=" رقم هاتف صاحب الطلب " value="{{ $order->customer }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city_id"> العنوان </label>
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected value="{{ $order->sub_city->id }}">
                                                -- {{ $order->sub_city->name }}
                                            </option> --}}
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $city->sub_cities ? 'disabled' : 'null' }}> {{ $city->name }}
                                                </option>
                                                @foreach ($city->sub_cities as $sub_cities)
                                                    <option value="{{ $sub_cities->id }}"
                                                        @if ($sub_cities->id == $order->sub_city->id) selected @endif> --
                                                        {{ $sub_cities->name }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="price"> السعر </label>
                                        <input type="number" name="price" class="form-control" id="price"
                                            placeholder=" السعر" value="{{ $order->price }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="captain_id"> الكابتن </label>
                                        <select class="form-control" name="captain_id" style="width: 100%;" id="captain_id"
                                            aria-label=".form-select-sm example">

                                            @foreach ($captains as $captain)
                                                <option value="{{ $captain->id }}"
                                                    {{ $captain->id == $order->captain_id ? 'selected' : null }}>
                                                    {{ $captain->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="status"> الحالة </label>
                                        <select class="form-control" name="status" style="width: 100%;" id="status"
                                            aria-label=".form-select-sm example">
                                            <option value="waiting" {{ $order->status == 'waiting' ? 'selected' : null }}>
                                                قيد التسليم </option>
                                            <option value="done" {{ $order->status == 'done' ? 'selected' : null }}> تم
                                                التسليم </option>
                                            <option value="fail" {{ $order->status == 'fail' ? 'selected' : null }}> فشل
                                                التسليم </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="statusDetails"> تفاصيل الحالة </label>
                                        <input type="text" name="statusDetails" class="form-control" id="statusDetails"
                                            placeholder=" تفاصيل الحالة " value="{{ $order->statusDetails }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="details"> تفاصيل الطلب </label>
                                        <input type="text" name="details" class="form-control" id="details"
                                            placeholder=" يرجي ادخال تفاصيل الطلب مثل اسم صاحب الطلب "
                                            value="{{ $order->details }}" disabled>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate({{ $order->id }})"
                                        class="btn btn-lg btn-success"> تعديل </button>
                                    @if (auth('client')->check())
                                        <a href="{{ route('indexOrders', ['id' => Auth::id()]) }}" type="submit"
                                            class="btn btn-lg btn-secondary">إلغاء</a>
                                    @else
                                        <a href="{{ route('orders.index') }}" type="submit"
                                            class="btn btn-lg btn-secondary">إلغاء</a>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    </section>
    <!-- /.content -->

@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('customer', document.getElementById('customer').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('details', document.getElementById('details').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('statusDetails', document.getElementById('statusDetails').value);
            formData.append('sub_city_id', document.getElementById('city_id').value);
            formData.append('captain_id', document.getElementById('captain_id').value);
            storeRoute('/cms/admin/orders_update/' + id, formData);
        }
    </script>
@endsection
c
