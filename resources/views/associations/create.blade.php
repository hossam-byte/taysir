@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white p-4">
                <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-plus-circle me-2"></i> إضافة جمعية جديدة</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('associations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label class="form-label"><i class="fa-solid fa-building text-info me-1"></i> اسم الجمعية</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label"><i class="fa-solid fa-image text-info me-1"></i> شعار الجمعية (اختياري)</label>
                            <input type="file" name="logo" class="form-control form-control-lg @error('logo') is-invalid @enderror" accept="image/*">
                            @error('logo') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-location-dot text-info me-1"></i> عنوان مقر الجمعية</label>
                            <input type="text" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="أدخل العنوان بالتفصيل">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-phone text-info me-1"></i> رقم هاتف الجمعية</label>
                            <input type="text" dir="ltr" name="contact_number" class="form-control form-control-lg text-end @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" placeholder="مثال: 01000000000">
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('associations.index') }}" class="btn btn-outline-secondary btn-lg px-4">إلغاء</a>
                        <button type="submit" class="btn btn-info text-white btn-lg px-5 shadow-sm fw-bold">حفظ الجمعية</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
