<?php
require_once "connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function upload_image() {
    $image = $_FILES['file']['tmp_name'];
    $image_name = $_FILES['file']['name'];

    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/uploaded_image';

    $data = "";

    if (!file_exists($file_path)) {
        mkdir($file_path, 0777, true);
    }

    if (!$image) {
        $data['message'] = "Gambar tidak ditemukan";
    } else {
        if (move_uploaded_file($image, $file_path . '/' . $image_name)) {
            $data['message'] = "Sukses Upload Gambar";
        }
    }
    print_r(json_encode($data));
}
