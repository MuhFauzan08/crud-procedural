<?php
$link = mysqli_connect('localhost', 'root', '', 'library');

// Fungsi untuk menampilkan data
function tampilData($query)
{
  global $link;
  $result = mysqli_query($link, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// Fungsi untuk menambah data
function tambahData($data)
{
  global $link;

  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $penerbit = htmlspecialchars($data['penerbit']);
  $isbn = htmlspecialchars($data['isbn']);
  $tahunTerbit = htmlspecialchars($data['tahun_terbit']);

  $gambar = uploadFile();
  if (!$gambar) {
    return false;
  }

  // Cek apakah data yang diinput sama
  $result = mysqli_query($link, "SELECT isbn FROM books WHERE isbn = '$isbn'");
  if (mysqli_fetch_assoc($result)) {
    echo
    "<script>
      alert('Data sudah pernah diinput!');
    </script>";

    return false;
  } else {
    $query = "INSERT INTO books VALUES ('', '$judul', '$pengarang', '$penerbit', '$isbn', '$tahunTerbit', '$gambar')";
    mysqli_query($link, $query);

    return mysqli_affected_rows($link);
  }
}

// Fungsi untuk mengubah data
function ubahData($data, $id)
{
  global $link;

  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $penerbit = htmlspecialchars($data['penerbit']);
  $isbnBaru = htmlspecialchars($data['isbn']);
  $tahunTerbit = htmlspecialchars($data['tahun_terbit']);
  $gambarLama = $data['gambar_lama'];
  $isbnLama = $data['isbn_lama'];

  // Cek apakah user menginputkan isbn baru / tidak
  $isbn = $isbnBaru == $isbnLama ? $isbnLama : $isbnBaru;

  // Cek apakah user tidak menginput data baru
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    hapusFile($id);
    $gambar = uploadFile();
  }

  // Cek agar data tidak terduplikat
  $tmp = tampilData("SELECT isbn FROM books WHERE NOT isbn = '$isbnLama'");
  $getISBN = array_column($tmp, 'isbn');

  // Cek apakah ada isbn yang sama
  if (in_array($isbn, $getISBN)) {
    echo
    "<script>
      alert('Data sudah pernah diinput!');
    </script>";

    return false;
  } else {
    $query = "UPDATE books SET
              judul = '$judul',
              pengarang = '$pengarang',
              penerbit = '$penerbit',
              isbn = $isbn,
              tahun_terbit = $tahunTerbit,
              gambar = '$gambar'
            WHERE id = $id";

    mysqli_query($link, $query);

    // Ambil hasil dari mysqli_info 
    $prototype = mysqli_info($link);
    list($matched, $changed, $warnings) = sscanf($prototype, "Rows matched: %d Changed: %d Warnings: %d");

    return $matched;
  }
}

// Fungsi untuk mengahapus data
function hapusData($id)
{
  global $link;

  // Hapus data dan file
  hapusFile($id);
  mysqli_query($link, "DELETE FROM books WHERE id = $id");

  return mysqli_affected_rows($link);
}

// Search total data
function cariTotalData($keyword)
{
  $judul = $keyword['judul'];
  $isbn = $keyword['isbn'];
  $pengarang = $keyword['pengarang'];
  $penerbit = $keyword['penerbit'];
  $tahunTerbit = $keyword['tahun_terbit'];

  $query = "SELECT id FROM books WHERE
              judul LIKE '%$judul%' AND
              isbn LIKE '%$isbn%' AND
              pengarang LIKE '%$pengarang%' AND
              penerbit LIKE '%$penerbit%' AND
              tahun_terbit LIKE '%$tahunTerbit%'";

  return tampilData($query);
}

// Search Data dengan limit
function cariData($keyword, $awalData, $jumlahDataPerHalaman)
{
  $judul = $keyword['judul'];
  $isbn = $keyword['isbn'];
  $pengarang = $keyword['pengarang'];
  $penerbit = $keyword['penerbit'];
  $tahunTerbit = $keyword['tahun_terbit'];

  $query = "SELECT * FROM books WHERE
						judul LIKE '%$judul%' AND
						isbn LIKE '%$isbn%' AND
						pengarang LIKE '%$pengarang%' AND
						penerbit LIKE '%$penerbit%' AND
						tahun_terbit LIKE '%$tahunTerbit%'
					 LIMIT $awalData, $jumlahDataPerHalaman";

  return tampilData($query);
}

// Fungsi untuk mengupload gambar
function uploadFile()
{
  $gambar = $_FILES['gambar'];

  $namaFile = $gambar['name'];
  $ukuranFile = $gambar['size'];
  $tmpName = $gambar['tmp_name'];

  // Cek apakah ukuran file terlalu besar
  if ($ukuranFile > 1_048_576) {
    echo
    "<script>
      alert('Ukuran gambar terlalu besar!');
    </script>";

    return false;
  }

  // Ambil ekstensi File
  $tmp = explode('.', $namaFile);
  $ekstensiFile = strtolower(end($tmp));

  // Generate nama file random
  $namaFileBaru = uniqid() . ".$ekstensiFile";

  // Pindahkan file yang diupload
  move_uploaded_file($tmpName, "../img/$namaFileBaru");

  return $namaFileBaru;
}

// Fungsi untuk menghapus gambar
function hapusFile($id)
{
  global $link;

  // Ambil data dari field db dan jadikan array assoc
  $result = mysqli_query($link, "SELECT gambar FROM books WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // Ubah array jadi string dan simpan dalam variabel
  $namaFile = $row['gambar'];
  $lokasiFile = "../img/$namaFile";

  // Hapus file
  unlink($lokasiFile);
}

// Fungsi untuk registrasi user
function register($data)
{
  global $link;

  $username = strtolower(stripslashes($data['username']));
  $password = mysqli_real_escape_string($link, $data['password']);
  $rePassword = mysqli_real_escape_string($link, $data['re_password']);

  // Cek apakah username pernah diinputkan
  $result = mysqli_query($link, "SELECT username FROM users WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo
    "<script>
      alert('Username sudah terdaftar!');
    </script>";

    return false;
  }

  // Cek apakah password sudah sesuai
  if ($password !== $rePassword) {
    echo
    "<script>
      alert('Password yang anda masukkan tidak sesuai!');
    </script>";

    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Input ke database
  mysqli_query($link, "INSERT INTO users VALUES ('', '$username', '$password')");

  return mysqli_affected_rows($link);
}

// Pagination
function pagination($judul = "", $isbn = "", $pengarang = "", $penerbit = "", $tahunTerbit = "", $startNum, $endNum, $jumlahHalaman, $halamanAktif)
{
  // Prev arrow
  if ($halamanAktif > 1) {
    echo
    "<li>
      <a href=\"?page=" . $halamanAktif - 1 . "&judul=$judul&isbn=$isbn&pengarang=$pengarang&penerbit=$penerbit&tahun_terbit=$tahunTerbit\">&laquo;</a>
    </li>";
  }

  // Num page
  for ($num = $startNum; $num <= $endNum; $num++) {
    if ($num == $halamanAktif) {
      echo
      "<li>
        <a href=\"?page=$num&&judul=$judul&isbn=$isbn&pengarang=$pengarang&penerbit=$penerbit&tahun_terbit=$tahunTerbit\"class=\"active\"> $num </a>
      </li>";
    } else {
      echo
      "<li>
        <a href=\"?page=$num&&judul=$judul&isbn=$isbn&pengarang=$pengarang&penerbit=$penerbit&tahun_terbit=$tahunTerbit\"> $num </a>
      </li>";
    }
  }

  // Next arrow
  if ($halamanAktif < $jumlahHalaman) {
    echo
    "<li>
      <a href=\"?page=" . $halamanAktif + 1 . "&judul=$judul&isbn=$isbn&pengarang=$pengarang&penerbit=$penerbit&tahun_terbit=$tahunTerbit\">&raquo;</a>
    </li>";
  }
}
