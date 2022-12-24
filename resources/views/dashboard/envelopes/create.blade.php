@extends('dashboard.master')

@section('title', 'المظروف')

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
                            <h3 class="card-title">انشاء مظروف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="details" class="form-label"> تفاصيل المظروف </label>
                                        <textarea class="form-control" id="details" rows="3" placeholder="أدخل تفاصيل المظروف"></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="client_id"> اسم العميل </label>
                                        <select class="form-control" name="client_id" style="width: 100%;" id="client_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($clients as $client)
                                                @if ($client->orders_count == null)
                                                    @continue
                                                @endif
                                                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('envelopes.index') }}" type="submit"
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
        function performStore() {
            let formData = new FormData();
            formData.append('details', document.getElementById('details').value);
            formData.append('client_id', document.getElementById('client_id').value);
            store('/cms/admin/envelopes', formData);

        }
    </script>
@endsection
