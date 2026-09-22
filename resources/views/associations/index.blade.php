@extends('layouts.app')

@section('content')
<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="text-info font-weight-bold mb-0"><i class="fa-solid fa-building-ngo"></i> الجمعيات المسجلة بالنظام</h3>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('associations.create') }}" class="btn btn-info text-white btn-lg shadow-sm fw-bold">
                    <i class="fa-solid fa-plus me-1"></i> إضافة جمعية جديدة
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="py-3 text-center">الشعار</th>
                        <th class="py-3 text-center">اسم الجمعية</th>
                        <th class="py-3 text-center">العنوان</th>
                        <th class="py-3 text-center">رقم التواصل</th>
                        <th class="py-3 text-center">عدد الحالات</th>
                        <th class="py-3 text-center">عدد الموظفين</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($associations as $association)
                    <tr>
                        <td class="text-center">
                            @if($association->logo)
                                <img src="{{ Storage::url($association->logo) }}" alt="شعار" class="rounded-circle object-fit-cover shadow-sm border" style="width: 50px; height: 50px;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold fs-5 text-dark text-center">{{ $association->name }}</td>
                        <td class="text-center">{{ $association->address ?: '-' }}</td>
                        <td class="text-center" dir="ltr">{{ $association->contact_number ?: '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-success fs-6 rounded-pill px-3">{{ $association->applicants_count }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary fs-6 rounded-pill px-3">{{ $association->users_count }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted fs-5">لا توجد جمعيات مسجلة حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $associations->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
