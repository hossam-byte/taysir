@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-pen me-2"></i> تعديل بيانات الجمعية</h3>
                    <form action="{{ route('associations.destroy', $association->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الجمعية؟ هذا الإجراء لا يمكن التراجع عنه وسيحذف جميع الموظفين والحالات المرتبطة.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm fw-bold"><i class="fa-solid fa-trash me-1"></i> حذف الجمعية</button>
                    </form>
                </div>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('associations.update', $association->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label class="form-label"><i class="fa-solid fa-building text-info me-1"></i> اسم الجمعية</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', $association->name) }}" required>
                            @error('name') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label"><i class="fa-solid fa-image text-info me-1"></i> شعار الجمعية (اختياري)</label>
                            <input type="file" name="logo" class="form-control form-control-lg @error('logo') is-invalid @enderror" accept="image/*">
                            @if($association->logo)
                                <div class="mt-2 text-center">
                                    <img src="{{ Storage::url($association->logo) }}" alt="شعار" class="rounded shadow-sm border" style="max-height: 50px;">
                                </div>
                            @endif
                            @error('logo') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label"><i class="fa-solid fa-location-dot text-info me-1"></i> عنوان مقر الجمعية</label>
                            <input type="text" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" value="{{ old('address', $association->address) }}" placeholder="أدخل العنوان بالتفصيل">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><i class="fa-solid fa-phone text-info me-1"></i> رقم هاتف الجمعية</label>
                            <input type="text" dir="ltr" name="contact_number" class="form-control form-control-lg text-end @error('contact_number') is-invalid @enderror" value="{{ old('contact_number', $association->contact_number) }}" placeholder="مثال: 01000000000">
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('associations.index') }}" class="btn btn-outline-secondary btn-lg px-4">إلغاء</a>
                        <button type="submit" class="btn btn-info text-white btn-lg px-5 shadow-sm fw-bold">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
