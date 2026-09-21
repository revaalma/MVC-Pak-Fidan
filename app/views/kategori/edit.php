<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="public/css/kategoriedit.css">
</head>
<body>
    <?php
    include "app/views/components/nav.php";
    ?>
    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <h2>Edit Kategori<h2>
            <a href="index.php?act=kategori" class="btn btn-primary">Kembali</a>

            <?php if (isset($_SESSION['error_msg'])): ?>
                <div class="error-message">
                    <?= $_SESSION['error_msg']; ?>
                </div>
                <?php
                unset($_SESSION['error_msg']);
                ?>
            <?php endif; ?>
            <form action="index.php?act=kategori-edit-proses" method="POST" style="margin-top: 20px;">
                <input type="hidden" name="id" value="<?= $kategori['id'] ?>">

                <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" required
                style="width: 300px; padding: 5px;">

            <button type="submit" style="padding 5px;">Update</button>
            </form>
        </div>
    </div>
</body>
</html>