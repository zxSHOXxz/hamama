@extends('dashboard.master')
@section('title', 'تأكيد بريدك الإلكتروني')

@section('styles')
    <style>
        .user-panel {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        {{-- @if ($massege == 'done')
        <div class="alert alert-success alert-dismissible">
            <h5> تمت عملية الارسال بنجاح يرجى التحقق من بريدك الالكتروني </h5>
        </div>
        @else
           @return
        @endif --}}
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> تحذير ! </h5>
            <p>
                 يجب عليك تأكيد الايميل الشخصي , يرجى التحقق من البريد الوارد في ايميلك
                 <br>
                 <br>
                 اذا لم تصلك رسالة بإمكانك طلب رسالة اخرى

                <a href="{{ route('re_verify_email') }}" class="btn btn-warning"> من هنا </a>
            </p>

        </div>

    </div>

@endsection

@section('scripts')

    <script></script>

@endsection
