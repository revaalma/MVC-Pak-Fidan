<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/dashboard1.css"> 
</head>
<body>
    <nav class="navbar">
        <a href="">NotesApp
        <a href="index.php?act=catatan" class="btn btn-danger">Catatan</a>
        <a href="index.php?act=kategori" class="btn btn-danger">Kategori</a>
        <a href="index.php?act=logout" class="btn btn-danger">Logout</a>
    </nav>

    <div class="container-dasboard" style="margin-top: 80px;">
        <div class="card">
            <h3>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h3>
            <p>ini adalah halaman dashboard admin, <?= $_SESSION['username'] ?? 'Admin' ; ?></p>
        </div>
    </div>
</body>
</html>