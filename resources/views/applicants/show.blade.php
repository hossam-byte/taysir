@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="text-primary fw-bold"><i class="fa-solid fa-id-card-clip"></i> ملف الحالة: {{ $applicant->name }}</h2>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('applicants.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill"><i class="fa-solid fa-arrow-right me-1"></i> عودة للحالات</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow border-0">
            <div class="card-header bg-light">
                <h4 class="mb-0 text-dark fw-bold"><i class="fa-solid fa-circle-info text-primary me-2"></i> البيانات الأساسية</h4>
            </div>
            <div class="card-body fs-5">
                <p><strong>الرقم القومي:</strong> <span class="badge bg-secondary fs-5 ms-2">{{ $applicant->national_id }}</span></p>
                <p><strong>السن:</strong> {{ $applicant->age }} سنة</p>
                <p><strong>النوع:</strong> {{ $applicant->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                <p><strong>العنوان:</strong> {{ $applicant->address }}</p>
                <hr>
                <p><strong>الحالة الاجتماعية:</strong></p>
                <p class="text-muted">{{ $applicant->social_status ?: 'لا يوجد' }}</p>
                
                <hr>
                <h5 class="fw-bold mt-3"><i class="fa-solid fa-file-contract text-primary me-2"></i> المستندات</h5>
                <div class="mb-3">
                    <strong>صورة البطاقة:</strong>
                    @if($applicant->id_photo)
                        <div class="mt-2">
                            <a href="{{ Storage::url($applicant->id_photo) }}" target="_blank" class="d-block text-center">
                                <img src="{{ Storage::url($applicant->id_photo) }}" class="img-fluid rounded border shadow-sm object-fit-cover" style="max-height: 200px; width: 100%;" alt="صورة البطاقة">
                            </a>
                        </div>
                    @else
                        <span class="text-danger">غير متوفرة</span>
                    @endif
                </div>

                @if($applicant->proof_photos && count($applicant->proof_photos) > 0)
                <div class="mb-3">
                    <strong>إثباتات أخرى:</strong>
                    <div class="row g-2 mt-2">
                        @foreach($applicant->proof_photos as $photo)
                            <div class="col-6">
                                <a href="{{ Storage::url($photo) }}" target="_blank" class="d-block">
                                    <img src="{{ Storage::url($photo) }}" class="img-fluid rounded border shadow-sm object-fit-cover" style="height: 120px; width: 100%;" alt="إثبات">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="mt-4 p-3 bg-light rounded text-center">
                    <small class="text-muted">تم التسجيل بواسطة:</small><br>
                    <strong>{{ $applicant->association ? $applicant->association->name : 'تسجيل ذاتي' }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card shadow border-0 h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h4 class="mb-0 text-success fw-bold"><i class="fa-solid fa-timeline me-2"></i> سجل المساعدات</h4>
                <a href="{{ route('assistances.create', $applicant) }}" class="btn btn-success rounded-pill fw-bold">
                    <i class="fa-solid fa-plus me-1"></i> إضافة مساعدة جديدة
                </a>
            </div>
            <div class="card-body p-4">
                @if($applicant->assistances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">التاريخ</th>
                                    <th class="py-3">الجمعية المانحة</th>
                                    <th class="py-3">نوع / قيمة المساعدة</th>
                                    <th class="py-3">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicant->assistances->sortByDesc('date') as $assistance)
                                <tr>
                                    <td class="fw-bold text-nowrap" dir="ltr">{{ \Carbon\Carbon::parse($assistance->date)->format('Y-m-d') }}</td>
                                    <td><span class="badge bg-primary fs-6">{{ $assistance->association->name ?? 'غير معروف' }}</span></td>
                                    <td class="fs-5 text-success fw-bold">{{ $assistance->type_or_value }}</td>
                                    <td class="text-muted">{{ $assistance->notes ?: '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa-solid fa-box-open text-muted mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-muted">لم يتم تسجيل أي مساعدات لهذه الحالة حتى الآن.</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
