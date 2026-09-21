<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="public/css/register1.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Register Admin Baru</div>
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form action="index.php?act=register-process" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="username" name="username" class="form-group" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-group" required>
                </div>
                 <button type="submit" class="btn";>Daftar</button>

            </form>
            <a href="index.php" class="text-center">Sudah punya akun? Login</a>
        </div>
    </div>



</body>
</html>