<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل طلب مساعدة | تسهيل الزواج</title>
    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            min-height: 100vh;
            padding: 3rem 1rem;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
        }
        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .form-header i {
            font-size: 4rem;
            color: #198754;
            margin-bottom: 1rem;
        }
        .form-control, .form-select {
            font-size: 1.15rem;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            background-color: #f8f9fa;
        }
        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
            background-color: #ffffff;
        }
        .btn-success {
            padding: 1rem;
            font-size: 1.3rem;
            border-radius: 12px;
            font-weight: bold;
            background: linear-gradient(135deg, #198754 0%, #157347 100%);
            border: none;
            transition: all 0.3s;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.4);
        }
    </style>
</head>
<body>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow border-0 text-center fs-4 fw-bold" role="alert" style="max-width: 900px; margin: 0 auto 2rem auto;">
                <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="form-container">
            <div class="form-header">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <h2 class="fw-bold text-dark mt-2">تسجيل طلب مساعدة للزواج</h2>
                <p class="text-muted fs-5">هذا النموذج مخصص لتسجيل بياناتك وطلب مساعدة. سيتم مراجعة الطلب من قبل الجمعيات الخيرية المشتركة.</p>
            </div>

            <form action="{{ route('public.case.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-user text-success me-1"></i> الاسم الرباعي</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-id-card text-success me-1"></i> الرقم القومي</label>
                        <input type="text" dir="ltr" name="national_id" class="form-control text-end @error('national_id') is-invalid @enderror" value="{{ old('national_id') }}" required placeholder="14 رقم">
                        @error('national_id') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-calendar text-success me-1"></i> السن</label>
                        <input type="number" dir="ltr" name="age" class="form-control text-end @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-venus-mars text-success me-1"></i> النوع</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                        </select>
                    </div>
                    
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-location-dot text-success me-1"></i> العنوان بالتفصيل</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                    </div>
                    
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-clipboard-list text-success me-1"></i> الحالة الاجتماعية (أو نبذة عن ظروفك)</label>
                        <textarea name="social_status" class="form-control @error('social_status') is-invalid @enderror" rows="4">{{ old('social_status') }}</textarea>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-id-card-clip text-success me-1"></i> صورة البطاقة أو شهادة الميلاد (إجباري)</label>
                        <input type="file" name="id_photo" class="form-control @error('id_photo') is-invalid @enderror" accept="image/*" capture="environment" required>
                        @error('id_photo') <span class="text-danger fw-bold">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold text-secondary"><i class="fa-solid fa-images text-success me-1"></i> إثباتات أخرى (اختياري)</label>
                        <input type="file" name="proof_photos[]" class="form-control @error('proof_photos.*') is-invalid @enderror" accept="image/*" capture="environment" multiple>
                        <small class="text-muted">صور تقارير، بحث، إلخ - يمكنك رفع أكثر من صورة</small>
                        @error('proof_photos.*') <span class="text-danger fw-bold d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-success text-white">
                        <i class="fa-solid fa-paper-plane me-2"></i> إرسال الطلب للجمعيات
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-secondary text-decoration-none"><i class="fa-solid fa-right-to-bracket me-1"></i> هل أنت موظف جمعية؟ تسجيل الدخول</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
