@extends('dashboard.master')

@section('title', 'البونص')

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
                            <h3 class="card-title">انشاء البونص</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="price"> قيمة البونص </label>
                                        <input type="number" name="price" class="form-control" id="price"
                                            placeholder="أدخل قيمة البونص ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city_id"> المدينة </label>
                                        {{-- <input type="text" name="city_id" id="city_id" value="{{ $id }}"
                                            class="form-control form-control-solid" hidden /> --}}
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $streets->city->name }} </option> --}}
                                            @foreach ($cities as $city)
                                                {{-- @if ($city->id == $streets->city->id)
                                                    @continue
                                                @endif --}}
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

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
        function performStore() {
            let formData = new FormData();
            formData.append('price', document.getElementById('price').value);
            formData.append('city_id', document.getElementById('city_id').value);
            store('/cms/admin/bonuses', formData);

        }
    </script>
@endsection
