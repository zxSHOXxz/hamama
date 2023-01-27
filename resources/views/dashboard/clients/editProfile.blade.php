@extends('dashboard.master')

@section('title', 'تعديل الملف الشخصي')

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
                            <h3 class="card-title">تعديل الملف الشخصي</h3>
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
                                            placeholder=" أدخل اسمك  " value="{{ $clients->user->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوانك" value="{{ $clients->user->address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ $clients->email }}" placeholder="أدخل ايميلك" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mobile"> رقم الجوال </label>
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="أدخل رقم جوالك" value="{{ $clients->user->mobile }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="gender"> الجنس</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                                            aria-label=".form-select-sm example">
                                            <option selected
                                                value="{{ $clients->user->gender == 'male' ? 'male' : 'female' }}">
                                                {{ $clients->user->gender == 'male' ? 'ذكر' : 'انثى' }} </option>
                                            <option value="{{ $clients->user->gender == 'male' ? 'female' : 'male' }}">
                                                {{ $clients->user->gender == 'male' ? 'انثى' : 'ذكر' }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">الصورة</label>
                                        <div class="input-group">
                                            <input type="file" class="file-input" id="exampleInputFile">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" onclick="performUpdate()"
                                            class="btn btn-lg btn-success">حفظ</button>

                                        <a href="{{ route('parent') }}" type="submit"
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
        function performUpdate() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('image', document.getElementById('exampleInputFile').files[0]);
            storeRoute('/cms/admin/update_profile', formData);
        }
    </script>
@endsection
