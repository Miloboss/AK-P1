<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;
use Helpers\Auth;

// Check if admin is logged in
Auth::check();

$table = new AdminsTable(new MySQL());

// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $name = htmlspecialchars(trim($_POST['name']));
//     $price = htmlspecialchars(trim($_POST['price']));
//     $description = htmlspecialchars(trim($_POST['description']));
//     $stock = htmlspecialchars(trim($_POST['stock']));
//     $category = intval($_POST['category']);
//     $images = [
//         'image1' => null,
//         'image2' => null,
//         'image3' => null,
//         'image4' => null
//     ];



// Add new product
// header('location: ../admin/products.php?message=success');
// exit();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $other_description = $_POST['other-description'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $has_colors = isset($_POST['has_colors']) ? 1 : 0;
    $colors = isset($_POST['colors']) ? json_encode($_POST['colors']) : json_encode([]);

    // Handle image uploads
    $uploadDir = '../image/';
    $images = [];
    for ($i = 1; $i <= 4; $i++) {
        $imageField = "image$i";
        if (isset($_FILES[$imageField]) && $_FILES[$imageField]['error'] == UPLOAD_ERR_OK) {
            $imageName = basename($_FILES[$imageField]['name']);
            $imagePath = $uploadDir . $imageName;
            if (move_uploaded_file($_FILES[$imageField]['tmp_name'], $imageName)) {
                $images[$imageField] = $imageName;
            } else {
                $images[$imageField] = null;
            }
        } else {
            $images[$imageField] = null;
        }
    }


    $product_id = $table->addProduct($name, $brand, $price, $other_description, $description, $stock, $category, $has_colors, $colors, $images);

    // header('location: ../admin/products.php?message=success?id=' . $product_id);
}

$db->close();
