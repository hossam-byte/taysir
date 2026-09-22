@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white p-4">
                <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-user-circle me-2"></i> الملف الشخصي</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="text-center mb-4">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="rounded-circle img-thumbnail shadow-sm mb-3 object-fit-cover" style="width: 150px; height: 150px;">
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center text-white shadow-sm mb-3" style="width: 150px; height: 150px; font-size: 4rem;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                        <div class="mt-2">
                            <label for="avatar" class="form-label fw-bold">تغيير الصورة الشخصية (اختياري)</label>
                            <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar" accept="image/*">
                            @error('avatar') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-user text-primary me-1"></i> الاسم</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-phone text-primary me-1"></i> رقم الهاتف</label>
                            <input type="text" dir="ltr" name="phone" class="form-control form-control-lg text-end @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-secondary"><i class="fa-solid fa-lock me-1"></i> تغيير كلمة المرور (اتركها فارغة إذا لم ترد تغييرها)</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">كلمة المرور الجديدة</label>
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" dir="ltr">
                            @error('password') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" dir="ltr">
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg px-4">إلغاء</a>
                        <button type="submit" class="btn btn-primary text-white btn-lg px-5 shadow-sm fw-bold">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
