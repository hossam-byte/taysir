@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h2>مرحباً، {{ auth()->user()->name }}</h2>
        <p class="text-muted">مرحباً بك في لوحة تحكم نظام تسهيل الزواج.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow-lg h-100 border-0">
            <div class="card-body p-4 text-center">
                <i class="fa-solid fa-users mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title font-weight-bold">إجمالي الحالات</h4>
                <h1 class="display-3 fw-bold mt-2">{{ $totalCases }}</h1>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-center pb-4">
                <a href="{{ route('applicants.index') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary w-100">عرض الحالات <i class="fa-solid fa-arrow-left ms-1"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow-lg h-100 border-0">
            <div class="card-body p-4 text-center">
                <i class="fa-solid fa-hand-holding-heart mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title font-weight-bold">إجمالي المساعدات</h4>
                <h1 class="display-3 fw-bold mt-2">{{ $totalAssistances }}</h1>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-center pb-4">
                <a href="{{ route('applicants.index') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-success w-100">سجل المساعدات <i class="fa-solid fa-arrow-left ms-1"></i></a>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'super_admin')
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-info shadow-lg h-100 border-0">
            <div class="card-body p-4 text-center">
                <i class="fa-solid fa-building-ngo mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title font-weight-bold">إجمالي الجمعيات</h4>
                <h1 class="display-3 fw-bold mt-2">{{ $totalAssociations }}</h1>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-center pb-4">
                <a href="{{ route('associations.index') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-info w-100">إدارة الجمعيات <i class="fa-solid fa-arrow-left ms-1"></i></a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
