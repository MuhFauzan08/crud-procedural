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

if (hapusData($id) > 0) {
  echo
  "<script>
    alert('Data berhasil dihapus!');
    document.location.href = 'index.php';
  </script>";
} else {
  echo
  "<script>
    alert('Data gagal dihapus!');
    document.location.href = 'index.php';
  </script>";
}
