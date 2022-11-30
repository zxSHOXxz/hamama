@extends('dashboard.master')

@section('title', ' الشارع')

@section('main-title', 'تعديل الشارع')
@section('sub-title', 'تعديل الشارع')

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
                            <h3 class="card-title">تعديل الشارع</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">تعديل اسم الشارع </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $streets->name }}" placeholder="أدخل اسم الشارع  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">تعديل وصف الشارع </label>
                                        <textarea type="text" name="details" class="form-control" id="details">{{ $streets->details }}</textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city_id"> المدينة </label>
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                                            aria-label=".form-select-sm example">
                                            <option selected> {{ $streets->city->name }} </option>
                                            @foreach ($cities as $city)
                                                @if ($city->id == $streets->city->id)
                                                    @continue
                                                @endif
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate({{ $streets->id }})"
                                        class="btn btn-lg btn-success">تعديل </button>


                                    <a href="{{ route('streets.index') }}" type="submit"
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
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('details', document.getElementById('details').value);
            formData.append('city_id', document.getElementById('city_id').value);
            storeRoute('/cms/admin/streets_update/{id}' + id, formData);
        }
    </script>
@endsection
