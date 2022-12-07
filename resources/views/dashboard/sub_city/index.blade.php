@extends('dashboard.master')
@section('title', 'المحافظة الفرعية')

@section('main-title', 'عرض المحافظة الفرعية')
@section('sub-title', 'عرض المحافظة الفرعية')

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
                            <h3 class="card-title">المحافظة الفرعية</h3>
                            {{-- <a href="{{ route('sub_cities.create') }}" type="submit" class="btn btn-lg btn-success"> إضافة
                                محافظة
                                فرعية
                                جديدة </a> --}}
                            <a href="{{ route('createSub_city', $id) }}" type="submit" class="btn btn-lg btn-success">إضافة
                                محافظة فرعية جديدة</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم محافظة فرعية</th>
                                        <th>اسم محافظة فرعية</th>
                                        <th> المدينة الام </th>
                                        {{-- <th> الشوارع </th> --}}
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub_cities as $sub_city)
                                        <tr>
                                            <td>{{ $sub_city->id }}</td>
                                            <td>{{ $sub_city->name }}</td>
                                            <td>{{ $sub_city->city->name }}</td>
                                            <td>

                                                <div class="btn group">
                                                    <a href="{{ route('sub_cities.edit', $sub_city->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>

                                                    <a href="#" onclick="performDestroy({{ $sub_city->id }},this)"
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
                            {{ $sub_cities->links() }}
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
            let url = '/cms/admin/sub_cities/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
