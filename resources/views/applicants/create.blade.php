@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-10">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white p-4">
                <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-user-plus me-2"></i> تسجيل حالة جديدة</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('applicants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-user text-primary me-1"></i> الاسم الرباعي</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-id-card text-primary me-1"></i> الرقم القومي</label>
                            <input type="text" dir="ltr" name="national_id" class="form-control form-control-lg text-end @error('national_id') is-invalid @enderror" value="{{ old('national_id') }}" required>
                            @error('national_id') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-calendar text-primary me-1"></i> السن</label>
                            <input type="number" dir="ltr" name="age" class="form-control form-control-lg text-end @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-venus-mars text-primary me-1"></i> النوع</label>
                            <select name="gender" class="form-select form-select-lg @error('gender') is-invalid @enderror" required>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            </select>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-location-dot text-primary me-1"></i> العنوان ومكان السكن بالتفصيل</label>
                            <input type="text" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-clipboard-list text-primary me-1"></i> الحالة الاجتماعية ووصف الحالة العامة</label>
                            <textarea name="social_status" class="form-control form-control-lg @error('social_status') is-invalid @enderror" rows="4">{{ old('social_status') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-id-card-clip text-primary me-1"></i> صورة البطاقة أو شهادة الميلاد (إجباري)</label>
                            <input type="file" name="id_photo" class="form-control form-control-lg @error('id_photo') is-invalid @enderror" accept="image/*" capture="environment" required>
                            @error('id_photo') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-images text-primary me-1"></i> إثباتات أخرى (صور، اختياري، يمكنك رفع أكثر من صورة)</label>
                            <input type="file" name="proof_photos[]" class="form-control form-control-lg @error('proof_photos.*') is-invalid @enderror" accept="image/*" capture="environment" multiple>
                            @error('proof_photos.*') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('applicants.index') }}" class="btn btn-outline-secondary btn-lg px-4">رجوع</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">حفظ الحالة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
