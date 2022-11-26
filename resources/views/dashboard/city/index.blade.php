@extends('dashboard.master')
@section('title','المدينة')

@section('main-title','عرض مدينة')
@section('sub-title','عرض مدينة')

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
            <a href="{{route('cities.create')}}" type="submit"
            class="btn btn-lg btn-success">إضافة مدينة جديدة</a>
            <div class="card-tools">

              </div>
              <br>
            </div>

          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
              <thead>
                <tr class="bg-info">
                  <th>رقم المدينة</th>
                  <th>اسم المدينة </th>
                  <th> عدد المستخدمين </th>
                  <th>الاعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cities as $city)
                <tr>
                  <td>{{$city->id}}</td>
                  <td>{{$city->name}}</td>
                  <td><span class="badge bg-success"> {{$city->users_count}}  مستخدم __ {{$city->customers_count}}  زبون</span></td>

                  <td>
                    <div class="btn group">
                      <a href="{{route('cities.edit',$city->id)}}" class="btn btn-primary" title="Edit">
                        تعديل
                        </a>

                      <a href="#" onclick="performDestroy({{$city->id}} , this)"  class="btn btn-danger" title="Delete">
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
          {{$cities->links()}}
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>


@endsection

@section('scripts')

<script>
    function performDestroy(id , referance){
        let url = '/cms/admin/cities/'+id;
        confirmDestroy(url ,referance );
    }
  </script>

@endsection


