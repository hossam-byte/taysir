@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white p-4 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-hand-holding-heart me-2"></i> إضافة مساعدة جديدة</h3>
            </div>
            <div class="card-body p-5">
                <div class="alert alert-light border shadow-sm mb-4">
                    <h5 class="mb-0 text-dark"><i class="fa-solid fa-user text-primary me-2"></i> <strong>اسم الحالة:</strong> {{ $applicant->name }}</h5>
                    <p class="mb-0 mt-2 text-muted fs-6"><i class="fa-solid fa-id-card me-2"></i> الرقم القومي: {{ $applicant->national_id }}</p>
                </div>

                <form action="{{ route('assistances.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                    
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-money-bill-wave text-success me-1"></i> نوع أو قيمة المساعدة</label>
                            <input type="text" name="type_or_value" class="form-control form-control-lg @error('type_or_value') is-invalid @enderror" placeholder="مثال: 5000 جنيه، ثلاجة، أثاث..." value="{{ old('type_or_value') }}" required>
                            @error('type_or_value') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-calendar-day text-success me-1"></i> تاريخ المساعدة</label>
                            <input type="date" name="date" class="form-control form-control-lg text-end @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-comment-dots text-success me-1"></i> ملاحظات إضافية (اختياري)</label>
                            <textarea name="notes" class="form-control form-control-lg @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-outline-secondary btn-lg px-4">إلغاء</a>
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm fw-bold">حفظ المساعدة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
