@extends('dashboard.master')

@section('title', 'الطلب')

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
                                        <label for="customer"> اسم الطلب </label>
                                        <input type="text" name="customer" class="form-control" id="customer"
                                            placeholder=" اسم الزبون صاحب الطلب ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city_id"> العنوان </label>
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $streets->city->name }} </option> --}}
                                            @foreach ($cities as $city)
                                                {{-- @if ($city->id == $streets->city->id)
                                                    @continue
                                                @endif --}}
                                                <option value="{{ $city->id }}"
                                                    {{ $city->sub_cities ? 'disabled' : 'null' }}> {{ $city->name }}
                                                </option>
                                                @foreach ($city->sub_cities as $sub_cities)
                                                    <option value="{{ $sub_cities->id }}"> -- {{ $sub_cities->name }}
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
                                            placeholder=" السعر">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="client_id"> العملاء </label>
                                        {{-- <input type="text" name="city_id" id="city_id" value="{{ $id }}"
                                            class="form-control form-control-solid" hidden /> --}}
                                        <select class="form-control" name="client_id" style="width: 100%;" id="client_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="details"> التفاصيل </label>
                                        <input type="text" name="details" class="form-control" id="details"
                                            placeholder=" التفاصيل">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="captain_id"> الكابتن </label>
                                        {{-- <input type="text" name="city_id" id="city_id" value="{{ $id }}"
                                            class="form-control form-control-solid" hidden /> --}}
                                        <select class="form-control" name="captain_id" style="width: 100%;" id="captain_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($captains as $captain)
                                                <option value="{{ $captain->id }}">{{ $captain->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('orders.index') }}" type="submit"
                                        class="btn btn-lg btn-secondary">إلغاء</a>
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
        function performStore() {
            let formData = new FormData();
            formData.append('customer', document.getElementById('customer').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('details', document.getElementById('details').value);
            formData.append('sub_city_id', document.getElementById('city_id').value);
            formData.append('captain_id', document.getElementById('captain_id').value);
            formData.append('client_id', document.getElementById('client_id').value);
            store('/cms/admin/orders', formData);

        }
    </script>
@endsection
