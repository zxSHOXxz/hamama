@extends('dashboard.master')
@section('title', 'محافظة')

@section('main-title', 'عرض مدينة')
@section('sub-title', 'عرض مدينة')

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
                            <h3 class="card-title">محافظة</h3>
                            <a href="{{ route('cities.create') }}" type="submit" class="btn btn-lg btn-success">إضافة محافظة
                                جديدة</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم محافظة</th>
                                        <th>اسم محافظة </th>
                                        <th> المحافظات الفرعية </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->name }}</td>
                                            <td><a href="{{ route('indexSubCities', ['id' => $city->id]) }}"
                                                    class="btn btn-info">({{ $city->sub_cities_count }})
                                                    محافظات فرعية</a> </td>
                                            <td>

                                                <div class="btn group">
                                                    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary"
                                                        title="Edit">
                                                        تعديل
                                                    </a>

                                                    <a href="#" onclick="performDestroy({{ $city->id }},this)"
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
                            {{-- {{ $cities->links() }} --}}
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
            let url = '/cms/admin/cities/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
