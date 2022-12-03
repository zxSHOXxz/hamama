@extends('dashboard.master')

@section('title', 'الكابتن')





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
                            <h3 class="card-title">انشاء الكابتن</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">الاسم الأول </label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                            placeholder=" أدخل اسم المشرف الأول ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="last_name">الاسم الأخير </label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                            placeholder="أدخل اسم المشرف الأخير ">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="أدخل ايميل المشرف  ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password"> كلمة المرور </label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="أدخل كلمة المرور   ">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="mobile"> رقم الجوال </label>
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="أدخل ايميل المشرف  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender"> الجنس</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $admins->user->job_title }} </option> --}}
                                            <option value="male"> ذكر </option>
                                            <option value="female">أنثى</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="image"> Image </label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="Enter Image">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المشرف  ">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('admins.index') }}" type="submit"
                                        class="btn btn-lg btn-secondary">إلغاء</a>
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
        function performStore() {
            let formData = new FormData();
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('image', document.getElementById('image').files[0]);
            store('/cms/admin/captains', formData);
        }
    </script>
@endsection
