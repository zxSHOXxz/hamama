@extends('dashboard.master')

@section('title', 'تعديل الصلاحيات ')


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
                            <h3 class="card-title">تعديل صلاحية </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="guard_name"> الأدوار</label>
                                        <select class="form-control" name="guard_name" style="width: 100%;" id="guard_name"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $admins->user->job_title }} </option> --}}
                                            <option value="admin" @if ($permissions->guard_name == 'admin') selected @endif>مشرف
                                            </option>
                                            <option value="client" @if ($permissions->guard_name == 'client') selected @endif>عميل
                                            </option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name"> اسم الصلاحية </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $permissions->name }}" placeholder="أدخل اسم الدور الوظيفي  ">
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate({{ $permissions->id }})"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('permissions.index') }}" type="submit"
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
            formData.append('guard_name', document.getElementById('guard_name').value);

            storeRoute('/cms/admin/permissions_update/' + id, formData);

        }
    </script>
@endsection
