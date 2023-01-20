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
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> تحذير ! </h5>
            يجب عليك تأكيد الايميل الشخصي , يرجى التحقق من البريد الوارد في ايميلك
        </div>

    </div>

@endsection

@section('scripts')

    <script></script>

@endsection
