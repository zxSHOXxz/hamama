@extends('dashboard.master')
@section('title', 'الزبون')

@section('main-title', 'عرض الزبون')
@section('sub-title', 'عرض الزبون')

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
                            <a href="{{ route('clients.create') }}" type="submit" class="btn btn-lg btn-success">إضافة كابتن
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
                                        <th>رقم الزبون</th>
                                        <th> الصورة </th>
                                        <th>الأسم </th>
                                        <th>الايميل </th>
                                        <th> رقم الجوال</th>
                                        <th> الجنس </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('storage/images/admin/' . $client->user->image) }}"
                                                    width="50" height="50" alt="User Image">
                                            </td>
                                            <td>{{ $client->user ? $client->user->name : '' }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->user ? $client->user->mobile : '' }}</td>
                                            <td>{{ $client->user->gender == 'male' ? 'ذكر' : 'انثى' }}</td>
                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('clients.edit', $client->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>

                                                    <a href="#" onclick="performDestroy({{ $client->id }} , this)"
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
                            {{ $clients->links() }}
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
            let url = '/cms/admin/clients/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
