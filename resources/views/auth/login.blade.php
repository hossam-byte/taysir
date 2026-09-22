<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | تسهيل الزواج</title>
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
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            padding: 3rem;
            backdrop-filter: blur(10px);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-header i {
            font-size: 3.5rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .form-control {
            font-size: 1.15rem;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            background-color: #f8f9fa;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            background-color: #ffffff;
        }
        .input-group-text {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            background-color: #f8f9fa;
        }
        .btn-primary {
            padding: 0.8rem;
            font-size: 1.25rem;
            border-radius: 12px;
            font-weight: bold;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <i class="fa-solid fa-ring"></i>
            <h2 class="fw-bold text-dark">نظام تسهيل الزواج</h2>
            <p class="text-muted">بوابة الموظفين والجمعيات</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="phone" class="form-label fw-bold text-secondary"><i class="fa-solid fa-phone me-1"></i> رقم الهاتف</label>
                <input type="tel" dir="ltr" placeholder="مثال: 01000000000" class="form-control text-end @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="tel">
                @error('phone')
                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label fw-bold text-secondary"><i class="fa-solid fa-lock me-1"></i> كلمة المرور</label>
                <div class="input-group" dir="ltr">
                    <input type="password" class="form-control text-end border-start-0 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                    <span class="input-group-text bg-transparent border-end-0" id="togglePassword" style="cursor: pointer;">
                        <i class="fa-solid fa-eye-slash text-secondary" id="toggleIcon"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback fw-bold text-end">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4 form-check d-flex justify-content-between align-items-center">
                <div>
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 text-secondary" for="remember">تذكرني على هذا الجهاز</label>
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-5">
                <button type="submit" class="btn btn-primary">
                    تسجيل الدخول <i class="fa-solid fa-arrow-left ms-2"></i>
                </button>
            </div>
        </form>
        
        <div class="text-center mt-5">
            <p class="text-muted mb-0">لست موظفاً؟ <br> <a href="{{ route('public.case.create') }}" class="text-primary fw-bold text-decoration-none mt-2 d-inline-block">تقديم طلب مساعدة (كحالة)</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>
</html>
