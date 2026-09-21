<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link rel="stylesheet" href="public/css/catatan1.css"> 
</head>
<body>
    <!-- <?php
    include "app/views/components/nav.php";
    ?> -->
    <div class="container" style="margin-top: 80px;">
        <div class="card">
        <h2>Daftar Catatan</h2>
        <a href="index.php?act=catatan-tambah" class="btn btn-primary">Tambah Catatan Baru</a>
        <a href="index.php?act=kategori" class="btn btn-primary">Kategori</a>

        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="success-messege">
                <?= $_SESSION['success_msg']; ?>
            </div>
            <?php
            unset($_SESSION['success_msg']);
            ?>
        <?php endif; ?>
        <div class="sticky-container">
            <?php if (!empty($data_catatan) > 0): ?>
                <?php foreach($data_catatan as $row): ?>

                    <div class="sticky-note">
                        <h3 class="note-title"><?= htmlspecialchars($row['judul']) ?></h3>

                        <div class="note-body">
                            <?=nl2br(htmlspecialchars($row['isi'])) ?>
                        </div>

                        <div class="note-meta">
                            <strong>Kategori:</strong> <?= $row['nama_kategori'] ? 
                            htmlspecialchars($row['nama_kategori']) : '<i>Tidak ada</i>' ?><br>
                        </div>

                        <div class="note-actions">
                            <a href="index.php?act=catatan-edit&id=<?= $row['id'] ?>"
                            class="btn-orange">Edit</a>
                            <a href="index.php?act=catatan-hapus&id=<?= $row['id'] ?>"
                            class="btn-red" onclick="return confirm('Yakin ingin menghapus catatan ini?')">Hapus</a>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada catatan. <br>Silahkan tambah catatan baru!</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>