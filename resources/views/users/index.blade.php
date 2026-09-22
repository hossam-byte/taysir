@extends('layouts.app')

@section('content')
<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="text-dark font-weight-bold mb-0"><i class="fa-solid fa-users-gear text-primary"></i> مستخدمي الجمعيات (الموظفين)</h3>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('users.create') }}" class="btn btn-dark btn-lg shadow-sm fw-bold">
                    <i class="fa-solid fa-user-plus me-1"></i> إضافة موظف جديد
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="py-3">الاسم</th>
                        <th class="py-3">رقم الهاتف (الدخول)</th>
                        <th class="py-3">الجمعية التابع لها</th>
                        <th class="py-3 text-center">تاريخ الإضافة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="fw-bold fs-5 text-dark"><i class="fa-solid fa-user text-muted me-2"></i> {{ $user->name }}</td>
                        <td dir="ltr" class="text-end fw-bold">{{ $user->phone }}</td>
                        <td>
                            @if($user->association)
                                <span class="badge bg-info text-white fs-6"><i class="fa-solid fa-building me-1"></i> {{ $user->association->name }}</span>
                            @else
                                <span class="badge bg-secondary">غير محدد</span>
                            @endif
                        </td>
                        <td class="text-center text-muted" dir="ltr">
                            {{ $user->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted fs-5">لا يوجد موظفين مسجلين للجمعيات حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
