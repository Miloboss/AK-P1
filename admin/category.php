<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;

$table = new AdminsTable(new MySQL());
$categories = $table->getAllCategories();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="assets/css/category.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>

<body>
    <?php
    include('navbar.php');
    ?>
    <div class="main-content" id="main-content">
        <header>
            <button id="menu-toggle">☰</button>
            <h1>Manage Categories</h1>
        </header>

        <h1>Manage Categories</h1>
        <form method="POST" action="../_actions/admin_category.php" class="category-form" enctype="multipart/form-data">
            <input type="hidden" name="category_id" id="category_id" value="0">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="image">Category Image:</label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" src="" alt="Image Preview" style="display:none;">
            <button type="submit">Save Category</button>
        </form>
        <h2>Existing Categories</h2>
        <ul class="category-list">
            <li style=" font-weight: bold">
                <span class="">Category Name</span>
                <span class="">Category Image</span>
                <span class="">Category Edit</span>
            </li>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <span class="category-name">
                        <?php echo htmlspecialchars($category['category_name']); ?>
                    </span>

                    <?php if ($category['category_image']) : ?>
                        <img src="assets/image/category_photo/<?php echo htmlspecialchars($category['category_image']); ?>" alt="Category Image" class="category-image">
                    <?php endif; ?>

                    <a class="edit-button" href="edit-category.php?id=<?php echo $category['category_id']; ?>">Edit</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="assets/js/dashboard.js"></script>
    <script>
        function editCategory(id, name, image) {
            document.getElementById('category_id').value = id;
            document.getElementById('name').value = name;
            if (image) {
                document.getElementById('imagePreview').src = '../admin/assets/image/category_photo/' + image;
                document.getElementById('imagePreview').style.display = 'block';
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>