<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $userId = $_SESSION['user_id'];
//     $usersTable =  new UsersTable(new MySQL());

//     if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
//         $uploadDir = '../assets/uploads/';
//         $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);

//         if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
//             $usersTable->updateUserProfileImage($userId, $uploadFile);
//             header('Content-Type: application/json');
//             echo json_encode(['success' => true, 'imagePath' => $uploadFile]);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'File upload failed.']);
//         }
//     } else {
//         echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
//     }
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $usersTable = new UsersTable(new MySQL());

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploadDir = '../assets/upload/';
        $imageName = basename($_FILES['profile_image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
            if ($usersTable->updateUserProfileImage($userId, $imageName)) {
                header('Location: ../view/profile.php?status=success');
                print_r($imageName);
                // exit();
            } else {
                // header('Location: ../views/profile.php?error=Database update failed.');
                header('Location: ../view/profile.php?status=1');
                exit();
            }
        } else {
            // header('Location: ../views/profile.php?error=File upload failed.');
            header('Location: ../view/profile.php?status=2');
            exit();
        }
    } else {
        // header('Location: ../views/profile.php?error=No file uploaded.');
        header('Location: ../view/profile.php?status=3');
        exit();
    }
}
