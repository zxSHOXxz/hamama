@extends('dashboard.master')

@section('title',' الشارع')

@section('main-title','تعديل الشارع')
@section('sub-title','تعديل الشارع')

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
                                    <input type="text" name="name" class="form-control"
                                        id="name" value="{{$streets->name}}"
                                        placeholder="أدخل اسم الشارع  ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">تعديل وصف الشارع </label>
                                    <textarea type="text" name="details" class="form-control"
                                        id="details">{{$streets->details}}</textarea>
                                </div>
                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="performUpdate({{$streets->id}})"
                                    class="btn btn-lg btn-success">تعديل {{ $streets->id }}</button>


                                    <a href="{{route('streets.index')}}" type="submit"
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

        function performUpdate(id){
            let formData = new FormData();
            formData.append('name',document.getElementById('name').value);
            // formData.append('details',document.getElementById('details').value);
            storeRoute('/cms/admin/street_update/'+id , formData);

        }
        </script>
@endsection
