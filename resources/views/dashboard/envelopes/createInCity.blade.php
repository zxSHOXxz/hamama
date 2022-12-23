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
                            <h3>انشاء بونص</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">اسم البونص </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="أدخل اسم البونص  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">وصف البونص </label>
                                        <textarea type="text" name="details" class="form-control" id="details" placeholder="أدخل وصف البونص  "></textarea>
                                        <input type="text" name="city_id" id="city_id" value="{{ $id }}"
                                            class="form-control form-control-solid" hidden />
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
            formData.append('name', document.getElementById('name').value);
            formData.append('details', document.getElementById('details').value);
            formData.append('city_id', document.getElementById('city_id').value);
            store('/cms/admin/streets', formData);
        }
    </script>
@endsection
