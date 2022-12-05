@extends('dashboard.master')
@section('title', 'البونص')

@section('main-title', 'عرض البونص')
@section('sub-title', 'عرض البونص')

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
                            <a href="{{ route('bonuses.create') }}" type="submit" class="btn btn-lg btn-success">إضافة بونص
                                جديد</a>
                            {{-- <a href="{{ route('createbonus' , $id) }}" type="submit" class="btn btn-lg btn-success">إضافة بونص
                                جديد</a> --}}
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم البونص</th>
                                        <th>قيمة البونص </th>
                                        <th>اسم المدينة</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bonuses as $bonus)
                                        <tr>
                                            <td>{{ $bonus->id }}</td>
                                            <td>{{ $bonus->price }}</td>
                                            <td>{{ $bonus->city->name }}</td>
                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('bonuses.edit', $bonus->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>
                                                    <a href="#" onclick="performDestroy({{ $bonus->id }} , this)"
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
                            @if ($bonuses)
                                {{ $bonuses->links() }}
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
            let url = '/cms/admin/bonuses/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
