<?php
include("../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\AdminsTable;

$table = new AdminsTable(new MySQL());
$categories = $table->getAllCategories();

// $auth = Auth::check();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Product</title>
    <link rel="stylesheet" href="assets/css/add-product.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="main-content" id="main-content">
        <header>
            <button id="menu-toggle">☰</button>
            <h1>Upload Products</h1>
        </header>
        <h1>Upload Product</h1>
        <form method="POST" action="../_actions/admin_products.php" class="product-form" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Product Price:</label>
            <input type="text" id="price" name="price" required>

            <label for="description">Product Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="stock">Product Stock:</label>
            <input type="text" id="stock" name="stock" required>

            <label for="image1">Product Image 1:</label>
            <input type="file" id="image1" name="image1" accept="image/*" onchange="previewImage(event, 'imagePreview1')">
            <img id="imagePreview1" src="" alt="Image Preview" style="display:none;">

            <label for="image2">Product Image 2:</label>
            <input type="file" id="image2" name="image2" accept="image/*" onchange="previewImage(event, 'imagePreview2')">
            <img id="imagePreview2" src="" alt="Image Preview" style="display:none;">

            <label for="image3">Product Image 3:</label>
            <input type="file" id="image3" name="image3" accept="image/*" onchange="previewImage(event, 'imagePreview3')">
            <img id="imagePreview3" src="" alt="Image Preview" style="display:none;">

            <label for="image4">Product Image 4:</label>
            <input type="file" id="image4" name="image4" accept="image/*" onchange="previewImage(event, 'imagePreview4')">
            <img id="imagePreview4" src="" alt="Image Preview" style="display:none;">

            <button type="submit">Upload Product</button>
        </form>

    </div>
    <script src="assets/js/dashboard.js"></script>
    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>