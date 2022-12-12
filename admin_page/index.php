<?php
require_once '../functions/functions.php';
session_start();

// Cek session
if (!isset($_SESSION['login'])) {
  header('Location: ../login_sys/sign-in.php');
  exit;
}

// Pagination config
if (
  isset($_GET['judul']) &&
  isset($_GET['isbn']) &&
  isset($_GET['pengarang']) &&
  isset($_GET['penerbit']) &&
  isset($_GET['tahun_terbit'])
) {
  $jumlahData = count(cariTotalData($_GET));
} else {
  $jumlahData = count(tampilData('SELECT id FROM books'));
}

$jumlahDataPerHalaman = 4;
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = isset($_GET['page']) ? $_GET['page'] : 1;
$awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;

$jumlahLink = 2;
if ($halamanAktif > $jumlahLink) {
  $startNum = $halamanAktif - $jumlahLink;
} else {
  $startNum = 1;
}

if ($halamanAktif < ($jumlahHalaman - $jumlahLink)) {
  $endNum = $halamanAktif + $jumlahLink;
} else {
  $endNum = $jumlahHalaman;
}

// Tampilkan data
if (
  isset($_GET['judul']) &&
  isset($_GET['isbn']) &&
  isset($_GET['pengarang']) &&
  isset($_GET['penerbit']) &&
  isset($_GET['tahun_terbit'])
) {
  $keyword = $_GET;
  $books = cariData($keyword, $awalData, $jumlahDataPerHalaman);
} else {
  $books = tampilData("SELECT * FROM books LIMIT $awalData, $jumlahDataPerHalaman");
}
?>
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec" prefix="og: http://ogp.me/ns#" class="no-js">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>My Library</title>

  <link rel="stylesheet" href="../my_css/style.css">
  <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <style>
    .img {
      box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    }


    a {
      color: inherit;
    }

    a:hover {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="d-flex justify-content-between align-items-end">
      <h1 class="mt-4"><a href="#" style="text-decoration: none; color: #007BFF;">My Library</a></h1>
      <button type="button" class="btn btn-danger mb-2 btn-sm">
        <a href="../login_sys/sign-out.php">Logout</a>
      </button>
    </div>

    <!-- Kolom pencarian -->
    <div class="card">
      <div class="card-header">
        <i class="fa fa-fw fa-globe"></i>
        <strong>Browse Book</strong>
        <a href="add-books.php" class="float-right btn btn-dark btn-sm">
          <i class="fa fa-fw fa-plus-circle"></i> Add Book
        </a>
      </div>
      <div class="card-body">

        <div class="col-sm-12">
          <h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find Book</h5>
          <form action="" method="GET">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tittle</label>
                  <input type="text" name="judul" id="username" class="form-control" placeholder="Enter Tittle" autofocus>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>ISBN</label>
                  <input type="number" min="0" max="999999999" name="isbn" id="useremail" class="form-control" placeholder="Enter ISBN">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Author</label>
                  <input type="tel" name="pengarang" id="userphone" class="form-control" placeholder="Enter Author">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Publisher</label>
                  <input type="tel" name="penerbit" id="userphone" class="form-control" placeholder="Enter Publisher">
                </div>
              </div>
              <div class="col-sm-2">

                <div class="form-group">

                  <label>Date</label>
                  <div class="input-group">
                    <input type="number" min="2000" max="2100" class="fromDate form-control hasDatepicker" name="tahun_terbit" id="df" placeholder="Enter Date">
                  </div>

                </div>

              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div>
                    <button type="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <hr>

    <!-- Tabel Data -->
    <div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="bg-primary text-white">
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle" style="width: 180px;">Tittle</th>
            <th class="text-center align-middle">Image</th>
            <th class="text-center align-middle">ISBN</th>
            <th class="text-center align-middle">Author</th>
            <th class="text-center align-middle">Publisher</th>
            <th class="text-center align-middle" style="width: 60px;">Year Of Publication</th>
            <th class="text-center align-middle">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($jumlahData > 0) { ?>
            <?php $no = $awalData + 1; ?>
            <?php foreach ($books as $book) { ?>
              <tr>
                <td align="center" class="align-middle"><?= $no; ?></td>
                <td align="center" class="align-middle"><?= $book['judul']; ?></td>
                <td align="center" class="align-middle">
                  <img src="../img/<?= $book['gambar']; ?>" alt="Gambar buku" style="width: 70px;" class="img">
                </td>
                <td align="center" class="align-middle"><?= $book['isbn']; ?></td>
                <td align="center" class="align-middle"><?= $book['pengarang']; ?></td>
                <td align="center" class="align-middle"><?= $book['penerbit']; ?></td>
                <td align="center" class="align-middle"><?= $book['tahun_terbit']; ?></td>
                <td align="center" class="align-middle">
                  <a href="edit-books.php?id=<?= $book['id']; ?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> |
                  <a href="delete.php?id=<?= $book['id']; ?>" class="text-danger" onClick="return confirm('Apakah anda yakin?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
                </td>

              </tr>
              <?php $no++; ?>
            <?php } ?>
          <?php } else { ?>
            <!-- Jika data tidak ditemukan munculkan pesan -->
            <tr>
              <td colspan="12" align="center">No Data Available!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!--/.col-sm-12-->

    <!-- Pagination -->
    <div>
      <ul class="pagination modal-1 justify-content-center">
        <?php
        if (
          isset($_GET['judul']) &&
          isset($_GET['isbn']) &&
          isset($_GET['pengarang']) &&
          isset($_GET['penerbit']) &&
          isset($_GET['tahun_terbit'])
        ) {
          $judul = $_GET['judul'];
          $isbn = $_GET['isbn'];
          $pengarang = $_GET['pengarang'];
          $penerbit = $_GET['penerbit'];
          $tahunTerbit = $_GET['tahun_terbit'];

          pagination($judul, $isbn, $pengarang, $penerbit, $tahunTerbit, $startNum, $endNum, $jumlahHalaman, $halamanAktif);
        } else {
          pagination('', '', '', '', '', $startNum, $endNum, $jumlahHalaman, $halamanAktif);
        }
        ?>
      </ul>
    </div>

  </div>

  <footer>
    <p class="text-center">© 2022 Muhammad Fauzan, All Right Reserved.</p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
  <script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      jQuery(function($) {
        var input = $('[type=tel]')
        input.mobilePhoneNumber({
          allowPhoneWithoutPrefix: '+1'
        });
        input.bind('country.mobilePhoneNumber', function(e, country) {
          $('.country').text(country || '')
        })
      });

      //From, To date range start
      var dateFormat = "yy-mm-dd";
      fromDate = $(".fromDate").datepicker({
          changeMonth: true,
          dateFormat: 'yy-mm-dd',
          numberOfMonths: 2
        })
        .on("change", function() {
          toDate.datepicker("option", "minDate", getDate(this));
        }),
        toDate = $(".toDate").datepicker({
          changeMonth: true,
          dateFormat: 'yy-mm-dd',
          numberOfMonths: 2
        })
        .on("change", function() {
          fromDate.datepicker("option", "maxDate", getDate(this));
        });


      function getDate(element) {
        var date;
        try {
          date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
          date = null;
        }
        return date;
      }
      //From, To date range End here	

    });
  </script>
</body>

</html>