<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a252f, #1a252f);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #1a252f;
        }

        .btn-primary {
            display: inline-block;
            padding: 6px 16px;
            /* lebih kecil dari sebelumnya */
            font-size: 0.9rem;
            /* sedikit lebih kecil */
            background-color: #1a252f;
            color: #fff;
            text-decoration: none;
            border-color: #000000;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center mb-4">Login Admin</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username"
                    required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Masuk</button>
        </form><br>
            <p class="text-center text-dark" >© <span>Copyright</span> <strong>Riyadhul Bahri Reka Cipta</strong> <span>2024</span></p>
    </div>

    <script src="bootstrap-5.0.0-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>