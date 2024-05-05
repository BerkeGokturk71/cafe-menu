<?php
session_start();

// Kullanıcı giriş bilgilerini kontrol etmek için bir fonksiyon
function checkLogin($username, $password) {
    // Gerçekleştirilecek işlem, örneğin bir veritabanı sorgusu
    // Örnek olarak sadece sabit kullanıcı adı ve şifre kullanıyoruz
    $validUsername = "admin";
    $validPassword = "123456";

    // Kullanıcı adı ve şifre doğru ise oturum başlat
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['username'] = $username;
        return true;
    } else {
        return false;
    }
}

// Form gönderildiğinde işlemleri gerçekleştir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifreyi kontrol et
    if (checkLogin($username, $password)) {
        // Giriş başarılıysa, yönlendir
        header("Location: admin.php");
        exit;
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .login-form {
            width: 300px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="login-form">
                <h2 class="text-center">Kullanıcı Girişi</h2>
                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Kullanıcı Adı:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Şifre:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
