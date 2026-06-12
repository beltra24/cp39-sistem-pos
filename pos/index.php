<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Kasir System - Login</title>
    <meta name="description" content="POS Seniman Koding adalah Software Kasir dengan fitur lengkap dan support Multi cabang.">
    <meta name="keyword" content="aplikasi kasir, software retail, software minimarket, aplikasi retail, aplikasi kasir online">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0056b3;
            --accent-color: #007bff;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Container Utama Split Screen */
        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        /* Sisi Kiri: Form Login */
        .login-side {
            flex: 1;
            max-width: 480px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.05);
            z-index: 2;
        }

        .login-form-container {
            width: 100%;
            max-width: 360px;
        }

        /* Sisi Kanan: Image Background */
        .image-side {
            flex: 2;
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('assets-login/images/bg-05.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Styling Input Group */
        .input-group-text {
            background-color: #f1f3f5;
            border-right: none;
            color: #6c757d;
            border-radius: 10px 0 0 10px;
        }

        .form-control {
            border-left: none;
            padding: 12px;
            background-color: #f1f3f5;
            border-radius: 0 10px 10px 0;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
            background-color: #ffffff;
        }

        .input-group:focus-within .input-group-text {
            border-color: #ced4da;
            color: var(--primary-color);
        }

        /* Tombol Login */
        .btn-login {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            background: linear-gradient(135deg, var(--primary-color), #004085);
        }

        /* Link Cookie */
        .clear-cookie-link {
            text-decoration: none;
            color: #dc3545;
            font-size: 0.85rem;
            font-weight: 600;
            transition: color 0.2s;
        }

        .clear-cookie-link:hover {
            color: #bd2130;
        }

        .footer-text {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Responsive: Jika dibuka di HP, Sisi Gambar akan disembunyikan */
        @media (max-width: 768px) {
            .image-side {
                display: none;
            }
            .login-side {
                max-width: 100%;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <?php  
        $emailSession = isset($_COOKIE['emailPos']) ? base64_decode($_COOKIE['emailPos']) : "";
        $passSession = isset($_COOKIE['passPos']) ? base64_decode($_COOKIE['passPos']) : "";
    ?>

    <div class="login-wrapper">
        
        <!-- SEKSI KIRI: FORM LOGIN -->
        <div class="login-side">
            <div class="login-form-container">
                
                <!-- Header Brand (Nama Aplikasi dirubah menjadi UT POS) -->
                <div class="text-center mb-4">
                    <div class="mb-2">
                        <span class="fa-stack fa-2x text-primary">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-cash-register fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h4 class="fw-bold mb-1 text-dark">POS Kasir System</h4>
                    <p class="text-muted small">Sistem Kasir Cepat & Andal</p>
                </div>

                <!-- Form Login -->
                <form action="aksi/login" method="post">
                    
                    <!-- Input Email -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="user_email" value="<?= htmlspecialchars($emailSession); ?>" placeholder="Masukkan email anda" required>
                        </div>
                    </div>
                    
                    <!-- Input Password -->
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="user_password" value="<?= htmlspecialchars($passSession); ?>" placeholder="Masukkan kata sandi" required>
                        </div>
                    </div>
                    
                    <!-- Bersihkan Sesi -->
                    <div class="d-flex justify-content-end mb-4">
                        <a href="aksi/clear-cookie" class="clear-cookie-link">
                            <i class="fas fa-trash-alt me-1"></i> Bersihkan Sesi
                        </a>
                    </div>

                    <!-- Tombol Masuk -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-login text-white" name="submit">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
                        </button>
                    </div>
                    
                    <!-- Footer Kredit -->
                    <div class="text-center footer-text mt-2">
                        <span>Website by <a href="http://ut.ac.id/" target="_blank">CP 39 Kelompok C</a></span>
                    </div>
                </form>

            </div>
        </div>

        <!-- SEKSI KANAN: BACKGROUND IMAGE UT KASIR -->
        <div class="image-side"></div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>