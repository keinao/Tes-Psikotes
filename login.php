<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Tes Psikologi BPS</title>
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <style>
        .auth-group { position: relative; margin-bottom: 20px; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 38px;
            cursor: pointer;
            color: #666;
            font-size: 1.1rem;
            z-index: 10;
        }
        .auth-group input { padding-right: 45px; }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png">
        <span>Tes Psikologi Pegawai</span>
    </div>
</header>

<div class="auth-container">
    <div class="auth-card">
        <h2>Login</h2>

        <?php if(isset($_GET['error'])): ?>
            <p style="color: red; font-size: 0.85em; margin-bottom: 10px; text-align: center;">
                <?php 
                    if($_GET['error'] == 'gagal') echo "NIP atau Password salah!";
                    if($_GET['error'] == 'akses_ditolak') echo "Akses ditolak!";
                ?>
            </p>
        <?php endif; ?>

        <form action="backend/login_process.php" method="POST">
            <div class="auth-group">
                <label>NIP / Username</label>
                <input type="text" name="nip" required autocomplete="username">
            </div>

            <div class="auth-group">
                <label>Password</label>
                <input type="password" name="password" id="pass_login" required autocomplete="current-password">
                <i class="fi fi-rr-eye toggle-password" id="btn_toggle_login"></i>
            </div>

            <div class="action">
                <button type="submit" class="btn-primary">Masuk</button>
            </div>
        </form>
        <p style="margin-top: 15px; font-size: 0.9em; text-align: center;">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</div>

<script>
    const btnToggle = document.querySelector('#btn_toggle_login');
    const inputPass = document.querySelector('#pass_login');

    btnToggle.addEventListener('click', function() {
        if (inputPass.type === 'password') {
            inputPass.type = 'text';
            this.classList.replace('fi-rr-eye', 'fi-rr-eye-crossed');
        } else {
            inputPass.type = 'password';
            this.classList.replace('fi-rr-eye-crossed', 'fi-rr-eye');
        }
    });
</script>
</body>
</html>