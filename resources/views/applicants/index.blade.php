@extends('layouts.app')

@section('content')
<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="text-primary font-weight-bold mb-0"><i class="fa-solid fa-users"></i> الحالات المسجلة</h3>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('applicants.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> تسجيل حالة جديدة
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('applicants.search') }}" method="POST" class="mb-5 bg-light p-4 rounded-3 border">
            @csrf
            <h5 class="mb-3 text-dark"><i class="fa-solid fa-magnifying-glass text-primary"></i> ابحث عن حالة بالرقم القومي (للتحقق من التسجيل المسبق)</h5>
            <div class="input-group input-group-lg" dir="ltr">
                <button class="btn btn-primary px-4" type="submit" id="button-addon1">بحث</button>
                <input type="text" name="national_id" class="form-control text-end border-primary" placeholder="أدخل الرقم القومي المكون من 14 رقم" aria-label="National ID" required>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="py-3">الاسم</th>
                        <th class="py-3">الرقم القومي</th>
                        <th class="py-3">السن</th>
                        <th class="py-3">المكان</th>
                        <th class="py-3 text-center">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applicants as $applicant)
                    <tr>
                        <td class="fw-bold">{{ $applicant->name }}</td>
                        <td><span class="badge bg-secondary fs-6">{{ $applicant->national_id }}</span></td>
                        <td>{{ $applicant->age }} سنة</td>
                        <td>{{ $applicant->address }}</td>
                        <td class="text-center">
                            <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-bold">
                                التفاصيل والسجل
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fs-5">لا توجد حالات مسجلة حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $applicants->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
