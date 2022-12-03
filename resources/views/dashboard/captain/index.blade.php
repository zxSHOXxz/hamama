@extends('dashboard.master')
@section('title', 'الكابتن')

@section('main-title', 'عرض الكابتن')
@section('sub-title', 'عرض الكابتن')

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
                            {{-- <h3 class="card-title">المشرف</h3> --}}
                            <a href="{{ route('captains.create') }}" type="submit" class="btn btn-lg btn-success">إضافة كابتن
                                جديد</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم الكابتن</th>
                                        <th> الصورة </th>
                                        <th>الأسم </th>
                                        <th>الايميل </th>
                                        <th> رقم الجوال</th>
                                        <th> الجنس </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($captains as $captain)
                                        <tr>
                                            <td>{{ $captain->id }}</td>
                                            <td>
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('storage/images/admin/' . $captain->user->image) }}"
                                                    width="50" height="50" alt="User Image">
                                            </td>
                                            <td>{{ $captain->user ? $captain->user->name : '' }}</td>
                                            <td>{{ $captain->email }}</td>
                                            <td>{{ $captain->user ? $captain->user->mobile : '' }}</td>
                                            <td>{{ $captain->user->gender == 'male' ? 'ذكر' : 'انثى' }}</td>
                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('captains.edit', $captain->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>

                                                    <a href="#" onclick="performDestroy({{ $captain->id }} , this)"
                                                        class="btn btn-danger" title="Delete">
                                                        حذف
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="span text-center" style="margin-top: 20px; margin-bottom:10px">

                                </span>

                            </div>
                            <!-- /.card-body -->
                            {{ $captains->links() }}
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>


@endsection

@section('scripts')

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/captains/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
