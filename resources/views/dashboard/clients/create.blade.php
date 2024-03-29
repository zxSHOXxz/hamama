@extends('dashboard.master')

@section('title', 'الزبون')





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
                            <h3 class="card-title">انشاء الزبون</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">الاسم </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم الزبون  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="role_id"> المسمى الوظيفي </label>
                                        <select class="form-control select22" name="role_id" style="width: 100%;"
                                            id="role_id" aria-label=".form-select-sm example">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="أدخل ايميل الزبون  ">
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
                                            placeholder="أدخل رقم الزبون  ">
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
                                            placeholder="أدخل عنوان الزبون  ">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('clients.index') }}" type="submit"
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
            formData.append('name', document.getElementById('name').value);
            formData.append('role_id', document.getElementById('role_id').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('image', document.getElementById('image').files[0]);
            store('/cms/admin/clients', formData);
        }
    </script>
@endsection
