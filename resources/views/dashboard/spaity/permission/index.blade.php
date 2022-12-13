@extends('dashboard.master')
@section('title', ' الصلاحيات')

@section('main-title', 'عرض الصلاحيات')
@section('sub-title', 'عرض الصلاحيات')

@section('styles')
    <style>

    </style>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">المدينة</h3> --}}
                            <a href="{{ route('permissions.create') }}" type="submit" class="btn btn-lg btn-success">اضافة
                                صلاحية جديدة</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم الصلاحية </th>
                                        <th>اسم الصلاحية </th>
                                        <th> المسمى الوظيفي </th>

                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->guard_name }}</td>

                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>

                                                    <a href="#" onclick="performDestroy({{ $permission->id }} , this)"
                                                        class="btn btn-danger" title="Delete">
                                                        حذف
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                {{ $permissions->links() }}
            </div>
    </section>


@endsection

@section('scripts')

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/permissions/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
