<?php

namespace Libs\Database;

use dbException;

class AdminsTable
{
    private $db = null;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }
    // admin authorization and admin controller

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT id, username, password, role FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    public function findByEmailAndPasword($username, $password)
    {
        $statement = $this->db->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
        $statement->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        $row = $statement->fetch();
        return $row ?? false;
    }

    // Admin category

    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll();
    }

    public function findCategoryID($id)
    {
        $stmt = $this->db->query("SELECT * FROM categories WHERE $id");
        return $stmt->fetch();
    }

    public function addCategory($name, $image)
    {
        $stmt = $this->db->prepare("INSERT INTO categories (category_name, category_image) VALUES (?, ?)");
        return $stmt->execute([$name, $image]);
    }

    public function getAllProductsC()
    {
        $stmt = $this->db->query("SELECT products.*, categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.category_id");
        return $stmt->fetchAll();
    }

    public function updateCategory($id, $name, $image = null)
    {
        if ($image) {
            $stmt = $this->db->prepare("UPDATE categories SET category_name = ?, category_image = ?, updated_at = NOW() WHERE category_id = ?");
            return $stmt->execute([$name, $image, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE categories SET category_name = ?, updated_at = NOW() WHERE category_id = ?");
            return $stmt->execute([$name, $id]);
        }
    }

    // Products Upload
    public function getAllProducts()
    {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }
    // public function addProduct($name, $price, $description, $category, $stock, $images)
    // {
    //     $stmt = $this->db->prepare("INSERT INTO products (product_name, product_description, price ,category_id,stock, main_image, image1, image2, image3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //     return $stmt->execute([
    //         $name,
    //         $price,
    //         $description,
    //         $category,
    //         $stock,
    //         $images['image1'],
    //         $images['image2'],
    //         $images['image3'],
    //         $images['image4']
    //     ]);
    // }

    public function addProduct($name, $brand, $price, $other_description, $description, $stock, $category, $has_colors, $colors, $images)
    {
        $sql = "INSERT INTO products (product_name, product_brand, product_description1, product_description, price,  category_id,stock, has_colors, 
        colors, main_image, image1, image2, image3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // $stmt = $this->db->prepare($sql);
        // $stmt->execute([
        //     $name,
        //     $brand,
        //     $other_description,
        //     $description,
        //     $price,
        //     $category,
        //     $stock,
        //     $has_colors,
        //     $colors,
        //     $images['image1'],
        //     $images['image2'],
        //     $images['image3'],
        //     $images['image4']
        // ]);

        print_r($images);
        print_r($has_colors);

        return $this->db->lastInsertId();
    }

    // 
}
