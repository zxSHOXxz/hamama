@extends('dashboard.master')
@section('title', 'المظروف')

@section('main-title', 'عرض المظروف')
@section('sub-title', 'عرض المظروف')

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
                            <h3 class="card-title">المظروف</h3>
                            <a href="{{ route('envelopes.create') }}" type="submit" class="btn btn-lg btn-success">إضافة مظروف
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
                                        <th>رقم المظروف</th>
                                        <th>تفاصيل المظروف </th>
                                        <th>اسم العميل</th>
                                        <th>التاريخ</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($envelopes as $envelop)
                                        <tr>
                                            <td>{{ $envelop->id }}</td>
                                            <td class="text-wrap" width="25%">{{ $envelop->details }}</td>
                                            <td>{{ $envelop->client->user->name }}</td>
                                            <td>{{ $envelop->created_at }}</td>
                                            </td>
                                            <td>
                                                <div class="btn group">
                                                    <a href="{{ route('envelopes.edit', $envelop->id) }}"
                                                        class="btn btn-primary" title="Edit">
                                                        تعديل
                                                    </a>
                                                    <a href="#" onclick="performDestroy({{ $envelop->id }} , this)"
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
                            @if ($envelopes)
                                {{ $envelopes->links() }}
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
            let url = '/cms/admin/envelopes/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
