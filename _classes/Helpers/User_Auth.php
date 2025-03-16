<?php

namespace Helpers;

use Libs\Database\UsersTable;
use Libs\Database\MySQL;

class User_Auth
{

    static $loginUrl = '/AK%20PHP/view/login.php';

    public static function check()
    {
        session_start();

        // Check if session is expired
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
            // Last activity is more than 1 hour ago
            session_unset();
            session_destroy();

            // Check cookies for auto-login
            if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
                $usersTable = new UsersTable(new MySQL());

                $userId = $_COOKIE['user_id'];
                $userToken = $_COOKIE['user_token'];
                $user = $usersTable->getUserById($userId);

                if ($user && md5($user['id'] . $user['email']) === $userToken) {
                    // Auto login successful
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
                    return $_SESSION['user_id'];
                }
            }

            // If no valid cookies, redirect to login
            header("Location: " . static::$loginUrl);
            exit;
        }

        // Update last activity time
        $_SESSION['LAST_ACTIVITY'] = time();

        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            header("Location: " . static::$loginUrl);
            exit;
        }
    }
}
