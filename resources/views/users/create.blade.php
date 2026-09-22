@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white p-4">
                <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-user-plus me-2"></i> إضافة موظف جمعية جديد</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-building text-dark me-1"></i> الجمعية التابع لها</label>
                            <select name="association_id" class="form-select form-select-lg @error('association_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- اختر الجمعية --</option>
                                @foreach($associations as $association)
                                    <option value="{{ $association->id }}" {{ old('association_id') == $association->id ? 'selected' : '' }}>{{ $association->name }}</option>
                                @endforeach
                            </select>
                            @error('association_id') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-user text-dark me-1"></i> اسم الموظف</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-phone text-dark me-1"></i> رقم الهاتف (اسم الدخول)</label>
                            <input type="tel" dir="ltr" name="phone" placeholder="مثال: 01000000000" class="form-control form-control-lg text-end @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-lock text-dark me-1"></i> كلمة المرور</label>
                            <input type="password" dir="ltr" name="password" class="form-control form-control-lg text-end @error('password') is-invalid @enderror" required>
                            @error('password') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4">إلغاء</a>
                        <button type="submit" class="btn btn-dark btn-lg px-5 shadow-sm fw-bold">حفظ الموظف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
