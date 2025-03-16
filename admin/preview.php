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
    <link rel="stylesheet" href="assets/css/preview.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="main-content" id="main-content">
        <header>
            <button id="menu-toggle">☰</button>
            <h1>Manage Categories</h1>
        </header>

        <h1>Manage Categories</h1>
        <div class="">
            <h1>Upload Product</h1>
            <form method="POST" action="../_actions/admin_products.php" class="product-form" enctype="multipart/form-data">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="brand">Product Brand:</label>
                <input type="text" id="brand" name="brand" required>

                <label for="price">Product Price:</label>
                <input type="number" id="price" name="price" required>

                <label class="pt-3" for="other-description">Product other-description Example: Warrenty, other remark</label>
                <textarea name="other-description" id="editor2" class="form-control" id="textAreaExample2" rows="4"></textarea>

                <label class="pt-3" for="description">Product Description:</label>
                <textarea name="description" id="editor1" data-custom1="value1" class=" description form-control" id="textAreaExample1" rows="4"></textarea>

                <label class="pt-3" for="stock">Product Stock:</label>
                <input type="number" id="stock" name="stock" required>

                <label class="pt-3" for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label>
                    <input type="checkbox" id="hasColorOptions" onclick="toggleColorOptions()"> Has Color Options
                </label>

                <div id="colorOptions" name="has_colors" style="display:none;">
                    <label for="color1">Color 1:</label>
                    <input type="text" id="color1" name="colors[]">

                    <label for="color2">Color 2:</label>
                    <input type="text" id="color2" name="colors[]">

                    <label for="color3">Color 3:</label>
                    <input type="text" id="color3" name="colors[]">
                </div>
                <button type="button" onclick="addColorField()">Add More Colors</button>

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

                <button type="button" onclick="previewProduct()">Preview Product</button>
                <button type="submit">Upload Product</button>
            </form>

            <h2>Preview Product</h2>
            <!-- <div class="product-preview">
                <h3 id="previewName"></h3>
                <p id="previewPrice"></p>
                <p id="previewDescription"></p>
                <p id="previewCategory"></p>
                <div id="previewColors" style="display:none;">
                    <p id="previewColor1"></p>
                    <p id="previewColor2"></p>
                    <p id="previewColor3"></p>
                </div>
                <div id="previewImages">
                    <img id="previewImage1" src="" style="display:none;">
                    <img id="previewImage2" src="" style="display:none;">
                    <img id="previewImage3" src="" style="display:none;">
                    <img id="previewImage4" src="" style="display:none;">
                </div>
            </div> -->

            <!--  -->

            <div class="details-container product-preview mt-4">
                <div class="image-gallery">
                    <div class="image-container" id="previewImages">
                        <!-- <img src="assets/image/products/9.png" >
                        <img src="assets/image/products/10.png" alt="Product Image 2" class="product-image"> -->
                        <button class="nav-btn prev-btn" id="prevBtn">&#10094;</button>
                        <img id="previewImage1" src="" alt="Product Image 1" class="product-image" style="display:none;">
                        <img id="previewImage2" src="" alt="Product Image 2" class="product-image" style="display:none;">
                        <img id="previewImage3" src="" alt="Product Image 3" class="product-image" style="display:none;">
                        <img id="previewImage4" src="" alt="Product Image 4" class="product-image" style="display:none;">
                        <button class="nav-btn next-btn" id="nextBtn">&#10095;</button>
                    </div>
                </div>
                <div class="product-details">
                    <h2 id="previewName" style=" font-weight: bold;"></h2>
                    <p id="previewBrand"></p>
                    <h3 id="previewPrice" style=" font-weight: bold;"></h3>
                    <span id="previewOtherD"></span>
                    <div id="previewColors" style="display: none;"></div>
                    <div class="product">

                        <div class="quantity-control">
                            <button id="decrease-quantity">-</button>
                            <input type="text" id="quantity" value="1" readonly>
                            <button id="increase-quantity">+</button>
                        </div>
                        <div class="add-1">
                            <button id="add-to-cart">ADD TO CART</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-description mb-4">
                <div class=" desc-txt d-flex justify-content-between">
                    <h2>Description</h2>
                    <!-- <i id="toggle-icon">+</i> -->
                </div>

                <div id="dsc-more" class="description-content">
                    <h5 id="previewName1" class="ps-1 mt-3 mb-5" style=" font-weight: bold;"></h5>
                    <span class="ps-1" id="previewDescription"></span>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(newEditor => {
                editor1 = newEditor;
            })
            .catch(error => {
                console.error(error);
            });


        function toggleColorOptions() {
            var colorOptions = document.getElementById('colorOptions');
            if (document.getElementById('hasColorOptions').checked) {
                colorOptions.style.display = 'block';
            } else {
                colorOptions.style.display = 'none';
                // Clear the color fields if the checkbox is unchecked
                var colorFields = colorOptions.getElementsByTagName('input');
                for (var i = 0; i < colorFields.length; i++) {
                    colorFields[i].value = '';
                }
            }
        }

        function addColorField() {
            var colorOptions = document.getElementById('colorOptions');
            var newField = document.createElement('div');
            newField.classList.add('color-field');
            newField.innerHTML = `
                <label>Color:</label>
                <input type="text" name="colors[]">
                <button type="button" onclick="removeColorField(this)">Remove</button>
            `;
            colorOptions.appendChild(newField);
        }

        function removeColorField(button) {
            var colorField = button.parentNode;
            colorField.parentNode.removeChild(colorField);
        }

        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewProduct() {
            document.getElementById('previewName').textContent = 'Name: ' + document.getElementById('name').value;
            document.getElementById('previewName1').textContent = 'Name: ' + document.getElementById('name').value;
            document.getElementById('previewPrice').textContent = 'Price: K' + document.getElementById('price').value;
            document.getElementById('previewDescription').innerHTML = editor.getData();
            document.getElementById('previewBrand').textContent = 'Brand:' + document.getElementById('brand').value;
            document.getElementById('previewOtherD').innerHTML = editor1.getData();

            let colors = document.getElementsByName('colors[]');
            let previewColors = document.getElementById('previewColors');
            previewColors.innerHTML = '';
            if (colors.length > 0) {
                previewColors.style.display = 'block';
                for (var i = 0; i < colors.length; i++) {
                    if (colors[i].value) {
                        var colorPreview = document.createElement('input');
                        colorPreview.type = 'text';
                        colorPreview.value = colors[i].value;
                        colorPreview.readOnly = true;
                        previewColors.appendChild(colorPreview);
                    }
                }
            } else {
                previewColors.style.display = 'none';
            }
            document.getElementById('colorOptions').addEventListener('input', previewColors);







            // var category = document.getElementById('category');
            // var categoryText = category.options[category.selectedIndex].text;
            // document.getElementById('previewCategory').textContent = 'Category: ' + categoryText;

            // var colors = document.getElementsByName('colors[]');
            // var previewColors = document.getElementById('previewColors');
            // previewColors.innerHTML = '';
            // if (colors.length > 0) {
            //     previewColors.style.display = 'block';
            //     for (var i = 0; i < colors.length; i++) {
            //         if (colors[i].value) {
            //             var colorPreview = document.createElement('p');
            //             colorPreview.textContent = 'Color: ' + colors[i].value;
            //             previewColors.appendChild(colorPreview);
            //         }
            //     }
            // } else {
            //     previewColors.style.display = 'none';
            // }

            var image1 = document.getElementById('image1').files[0];
            var image2 = document.getElementById('image2').files[0];
            var image3 = document.getElementById('image3').files[0];
            var image4 = document.getElementById('image4').files[0];

            if (image1) {
                var reader1 = new FileReader();
                reader1.onload = function(e) {
                    document.getElementById('previewImage1').src = e.target.result;
                    document.getElementById('previewImage1').style.display = 'block';
                };
                reader1.readAsDataURL(image1);
            }

            if (image2) {
                var reader2 = new FileReader();
                reader2.onload = function(e) {
                    document.getElementById('previewImage2').src = e.target.result;
                    document.getElementById('previewImage2').style.display = 'block';
                };
                reader2.readAsDataURL(image2);
            }

            if (image3) {
                var reader3 = new FileReader();
                reader3.onload = function(e) {
                    document.getElementById('previewImage3').src = e.target.result;
                    document.getElementById('previewImage3').style.display = 'block';
                };
                reader3.readAsDataURL(image3);
            }

            if (image4) {
                var reader4 = new FileReader();
                reader4.onload = function(e) {
                    document.getElementById('previewImage4').src = e.target.result;
                    document.getElementById('previewImage4').style.display = 'block';
                };
                reader4.readAsDataURL(image4);
            }
        }
    </script>
    <script src="assets/js/preview.js"></script>
</body>

</html>