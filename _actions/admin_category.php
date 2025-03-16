<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;
use Helpers\Auth;

// Check if admin is logged in
Auth::check();

$table = new AdminsTable(new MySQL());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $image = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../admin/assets/image/category_photo/';
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imageName;
        }
    }

    if ($categoryId > 0) {
        // Update category
        $table->updateCategory($categoryId, $name, $image);
    } else {
        // Add new category
        $table->addCategory($name, $image);
    }

    header('location: ../admin/category.php');
    exit();
}
