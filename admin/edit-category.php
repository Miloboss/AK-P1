<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\AdminsTable;

$id = $_GET['id'];
$table = new AdminsTable(new MySQL());
$edit = $table->findCategoryID($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Categories</title>
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
            <h1>Edit Categories</h1>
        </header>

        <h1>Edit Categories</h1>
        <form method="POST" action="../_actions/admin_category_edit.php?category-id=<?php echo $edit['category_id']; ?>
        " class="category-form" enctype="multipart/form-data">
            <input type="hidden" name="category_id" id="category_id" value="0">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($edit['category_name']); ?>" required>
            <label for="image">Category Image:</label>
            <img class="imageEdit" src="assets/image/category_photo/<?php echo htmlspecialchars($edit['category_image']); ?>" alt="Image Preview">
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" src="" alt="Image Preview" style="display:none;">
            <button type="submit">Save Category</button>
        </form>
    </div>
    <script src="assets/js/dashboard.js"></script>
    <script>
        function editCategory(id, name, image) {
            document.getElementById('category_id').value = id;
            document.getElementById('name').value = name;
            // if (image) {
            //     document.getElementById('imagePreview').src = '../admin/assets/image/category_photo/' + image;
            //     document.getElementById('imagePreview').style.display = 'block';
            // } else {
            //     document.getElementById('imagePreview').style.display = 'none';
            // }
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