<?php

namespace Libs\Database;

use dbException;

class UsersTable
{
    private $db = null;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }
    // admin authorization and admin controller

    public function registerUser($email, $password)
    {
        $query = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // Return the ID of the inserted record
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM user WHERE user_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // 

    public function updateUserProfileImage($userId, $imageName)
    {
        $query = "UPDATE user SET user_profile = :profile_image WHERE user_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':profile_image', $imageName);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function updateUserInfo($userId, $name, $phone, $address)
    {
        $query = "UPDATE user SET user_name = :name, phone_number = :phone, address = :address WHERE user_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function updateUser($userId, $data)
    {
        $fields = [];
        $params = ['id' => $userId];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        }

        $sql = "UPDATE user SET " . implode(", ", $fields) . " WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // 

    public function getProductById($product_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :id");
        $stmt->execute(['id' => $product_id]);
        return $stmt->fetch();
    }


    // 

    public function getProducts($offset, $limit)
    {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY updated_at DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalProducts()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }

    public function getFilterProduct($product_id)
    {
        $query = "SELECT * FROM products WHERE product_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateProductStock($product_id, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE products SET stock = stock - :quantity WHERE product_id = :product_id");
        return $stmt->execute(['quantity' => $quantity, 'product_id' => $product_id]);
    }

    // CART

    public function getCartRowCount($userId)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM cart WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }

    public function saveCartItem($user_id, $product_id, $quantity, $product_color, $price)
    {
        $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id AND product_color = :product_color");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'product_color' => $product_color]);
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            $newQuantity = $cartItem['quantity'] + $quantity;
            $newPrice = $newQuantity * $price;
            $stmt = $this->db->prepare("UPDATE cart SET quantity = :quantity, price = :price WHERE cart_id = :cart_id");
            return $stmt->execute(['quantity' => $newQuantity, 'price' => $newPrice, 'cart_id' => $cartItem['cart_id']]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity, price, product_color) VALUES (:user_id, :product_id, :quantity, :price, :product_color)");
            return $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity, 'price' => $price, 'product_color' => $product_color]);
        }
    }

    // public function saveCartItem($userId, $productId, $productColor, $quantity)
    // {
    //     $stmt = $this->db->query('SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND product_color = ?', [$userId, $productId, $productColor]);
    //     $existingItem = $stmt->fetch();

    //     if ($existingItem) {
    //         $this->db->query('UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ? AND product_color = ?', [$quantity, $userId, $productId, $productColor]);
    //     } else {
    //         $this->db->query('INSERT INTO cart (user_id, product_id, product_color, quantity) VALUES (?, ?, ?, ?)', [$userId, $productId, $productColor, $quantity]);
    //     }
    // }

    public function getCartItems($user_id)
    {
        $stmt = $this->db->prepare("SELECT cart.cart_id, cart.user_id, cart.product_id, cart.quantity, cart.price, cart.product_color, cart.added_at, cart.updated_at, products.product_name AS product_name, products.image1 AS product_image FROM cart JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    public function updateCartItem($user_id, $product_id, $product_color, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id AND product_color = :product_color");
        return $stmt->execute(['quantity' => $quantity, 'user_id' => $user_id, 'product_id' => $product_id, 'product_color' => $product_color]);
    }

    public function removeCartItem($cart_id)
    {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE cart_id = :cart_id");
        return $stmt->execute(['cart_id' => $cart_id]);
    }

    public function clearCart($user_id)
    {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $user_id]);
    }

    // 

    public function saveOrder($order_id, $user_id, $product_id, $product_color, $quantity, $price, $user_address, $user_phone_number)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (order_id, user_id, product_id, product_color, quantity, price, user_address, user_phone_number) VALUES (:order_id, :user_id, :product_id, :product_color, :quantity, :price, :user_address, :user_phone_number)");
        return $stmt->execute(['order_id' => $order_id, 'user_id' => $user_id, 'product_id' => $product_id, 'product_color' => $product_color, 'quantity' => $quantity, 'price' => $price, 'user_address' => $user_address, 'user_phone_number' => $user_phone_number]);
    }

    public function checkOrderExists($order_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getOrderHistory($user_id)
    {
        $stmt = $this->db->prepare("SELECT orders.order_id AS order_id, orders.product_id AS product_id, orders.product_color AS product_color, orders.quantity AS quantity, orders.price AS price, orders.total_price AS total_price, orders.user_address AS user_address, orders.user_phone_number AS user_phone_number, orders.created_at AS created_at, products.product_name AS product_name, products.main_image AS main_image FROM orders JOIN products ON orders.product_id = products.product_id WHERE orders.user_id = :user_id ORDER BY orders.created_at DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }
}
