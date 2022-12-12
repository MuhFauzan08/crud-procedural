<?php
require_once '../functions/functions.php';
session_start();

// Cek session
if (!isset($_SESSION['login'])) {
  header('Location: ../login_sys/sign-in.php');
  exit;
}

if (isset($_POST['submit'])) {
  if (tambahData($_POST) > 0) {
    echo
    "<script>
      alert('Data berhasil ditambahkan!');
    </script>";
  } else {
    echo
    "<script>
      alert('Data gagal ditambahkan!');
    </script>";
  }
}
?>

<!doctype html>

<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec" prefix="og: http://ogp.me/ns#" class="no-js">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Add Data</title>


  <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

  <script>
    (adsbygoogle = window.adsbygoogle || []).push({

      google_ad_client: "ca-pub-6724419004010752",

      enable_page_level_ads: true

    });
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131906273-1"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-131906273-1');
  </script>

</head>



<body>
  <div class="container my-4">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- demo top banner -->

    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6724419004010752" data-ad-slot="6737619771" data-ad-format="auto" data-full-width-responsive="true"></ins>

    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

  </div>



  <div class="container">

    <h1><a href="#" style="text-decoration: none;">Add New Book</a></h1>

    <div class="card">

      <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Book</strong> <a href="index.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Books</a></div>

      <div class="card-body">



        <div class="col-sm-6">

          <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Tittle <span class="text-danger">*</span></label>
              <input type="text" name="judul" id="username" class="form-control" placeholder="Enter Tittle" autofocus required>
            </div>

            <div class="form-group">
              <label>ISBN <span class="text-danger">*</span></label>
              <input type="number" min="0" max="999999999" name="isbn" id="username" class="form-control" placeholder="Enter ISBN" required>
            </div>

            <div class="form-group">
              <label>Author <span class="text-danger">*</span></label>
              <input type="text" name="pengarang" id="useremail" class="form-control" placeholder="Enter Author" required>
            </div>

            <div class="form-group">
              <label>Publisher <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="penerbit" id="userphone" placeholder="Enter Publisher" required>
            </div>

            <div class="form-group">
              <label>Year Of Publication <span class="text-danger">*</span></label>
              <input type="number" min="2000" max="2100" class="form-control" name="tahun_terbit" id="userphone" x-autocompletetype="tel" placeholder="Enter Date" required>
            </div>

            <div class="form-group">
              <label>Image <span class="text-danger">*</span></label>
              <input type="file" name="gambar" class="form-control-file" id="userphone" placeholder="Enter Image" accept="image/*" required>
            </div>

            <div class="form-group">
              <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Book</button>
            </div>
          </form>

        </div>

      </div>

    </div>

  </div>



  <div class="container my-4">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- demo left sidebar -->

    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6724419004010752" data-ad-slot="7706376079" data-ad-format="auto" data-full-width-responsive="true"></ins>

    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
  <script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
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
    });
  </script>



</body>

</html>