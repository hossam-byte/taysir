@extends('layouts.app')

@section('content')
<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-dark text-white p-4">
        <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-list-check me-2"></i> سجل الأنشطة (Activity Logs)</h3>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="py-3">التاريخ والوقت</th>
                        <th class="py-3">الموظف</th>
                        <th class="py-3">الإجراء</th>
                        <th class="py-3">البيان</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                    <tr>
                        <td dir="ltr" class="text-end text-muted">{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            @if($activity->causer)
                                <span class="fw-bold"><i class="fa-solid fa-user text-primary me-1"></i> {{ $activity->causer->name }}</span>
                                <br><small class="text-muted">{{ $activity->causer->association->name ?? 'مدير النظام' }}</small>
                            @else
                                <span class="text-muted">النظام / تسجيل ذاتي</span>
                            @endif
                        </td>
                        <td>
                            @if($activity->description === 'created')
                                <span class="badge bg-success">إضافة جديدة</span>
                            @elseif($activity->description === 'updated')
                                <span class="badge bg-warning text-dark">تعديل</span>
                            @elseif($activity->description === 'deleted')
                                <span class="badge bg-danger">حذف</span>
                            @else
                                <span class="badge bg-secondary">{{ $activity->description }}</span>
                            @endif
                        </td>
                        <td>
                            @if(str_contains($activity->subject_type, 'Applicant'))
                                تسجيل بيانات حالة
                            @elseif(str_contains($activity->subject_type, 'Assistance'))
                                تسجيل مساعدة لحالة
                            @else
                                {{ class_basename($activity->subject_type) }}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted fs-5">لا توجد أنشطة مسجلة حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $activities->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
