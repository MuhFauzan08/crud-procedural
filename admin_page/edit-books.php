<?php
require_once '../functions/functions.php';
session_start();

// Cek session
if (!isset($_SESSION['login'])) {
  header('Location: ../login_sys/sign-in.php');
  exit;
}

// Cek id
$id = $_GET['id'];

if (!isset($id)) {
  header('Location: index.php');
  exit;
}

// Tampilkan Data
$book = tampilData("SELECT * FROM books WHERE id = $id")[0];

// Ubah Data
if (isset($_POST['submit'])) {
  if (ubahData($_POST, $id) > 0) {
    echo
    "<script>
      alert('Data berhasil diubah!');
      document.location.href = 'index.php';
    </script>";
  } else {
    echo
    "<script>
      alert('Data gagal diubah!');
      document.location.href = 'edit-books.php?id=$id';
    </script>";
  }
}
?>

<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec" prefix="og: http://ogp.me/ns#" class="no-js">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Data</title>

  <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1 class="mt-4"><a href="#" style="text-decoration: none;">Edit Book</a></h1>
    <div class="card">
      <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Edit Book</strong> <a href="index.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Books</a></div>
      <div class="card-body">

        <div class="col-sm-6">
          <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gambar_lama" value="<?= $book['gambar']; ?>">
            <input type="hidden" name="isbn_lama" value="<?= $book['isbn']; ?>">

            <div class="form-group">
              <label>Tittle <span class="text-danger">*</span></label>
              <input type="text" name="judul" id="username" class="form-control" value="<?= $book['judul']; ?>" placeholder="Enter Tittle" required autofocus>
            </div>

            <div class="form-group">
              <label>ISBN <span class="text-danger">*</span></label>
              <input type="number" min="0" max="999999999" name="isbn" id="username" class="form-control" value="<?= $book['isbn']; ?>" placeholder="Enter ISBN" required>
            </div>

            <div class="form-group">
              <label>Author <span class="text-danger">*</span></label>
              <input type="text" name="pengarang" id="useremail" class="form-control" value="<?= $book['pengarang']; ?>" placeholder="Enter Author" required>
            </div>

            <div class="form-group">
              <label>Publisher <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="<?= $book['penerbit']; ?>" name="penerbit" id="userphone" placeholder="Enter Publisher" required>
            </div>

            <div class="form-group">
              <label>Year Of Publication <span class="text-danger">*</span></label>
              <input type="number" min="2000" max="2100" class="form-control" value="<?= $book['tahun_terbit']; ?>" name="tahun_terbit" id="userphone" x-autocompletetype="tel" placeholder="Enter Date" required>
            </div>

            <div class="form-group">
              <label style="display: block;">Image <span class="text-danger">*</span></label>
              <img src="../img/<?= $book['gambar']; ?>" alt="Gambar buku" class="img-thumbnail mb-3" width="75">
              <input type="file" class="form-control" value="<?= $book['gambar']; ?>" name="gambar" id="userphone" placeholder="Enter Image" accept="image/*">
            </div>
            <div class="form-group">
              <input type="hidden" name="editId" id="editId" value="">
              <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update Book</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>

</html>