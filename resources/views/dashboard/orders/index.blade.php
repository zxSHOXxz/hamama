@extends('dashboard.master')
@section('title', 'الشارع')

@section('main-title', 'عرض الشارع')
@section('sub-title', 'عرض الشارع')

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
                            <h3 class="card-title">المدينة</h3>
                            {{-- <a href="{{ route('streets.create') }}" type="submit" class="btn btn-lg btn-success">إضافة شارع
                                جديد</a> --}}
                            <a href="{{ route('createStreet' , $id) }}" type="submit" class="btn btn-lg btn-success">إضافة شارع
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
                                        <th>رقم الشارع</th>
                                        <th>اسم الشارع </th>
                                        <th>اسم المدينة</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($streets as $street)
                                        <tr>
                                            <td>{{ $street->id }}</td>
                                            <td>{{ $street->name }}</td>
                                            <td>{{ $street->city->name }}</td>
                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('streets.edit', $street->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>
                                                    <a href="#" onclick="performDestroy({{$street->id}} , this)"
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
                            @if ($streets)
                                {{ $streets->links() }}
                            @endif
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
            let url = '/cms/admin/streets/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
