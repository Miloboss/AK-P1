<?php

namespace Helpers;

use Libs\Database\AdminsTable;
use Libs\Database\MySQL;

class Auth
{
	static $loginUrl = 'admin/index.php';

	public static function check()
	{
		session_start();

		// Check if session is expired
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
			// Last activity is more than 1 hour ago
			session_start();
			session_unset();
			session_destroy();
			HTTP::redirect(static::$loginUrl);
		}

		// Update last activity time
		$_SESSION['LAST_ACTIVITY'] = time();

		if (isset($_SESSION['admin'])) {
			return $_SESSION['admin'];
		} else {
			HTTP::redirect(static::$loginUrl);
		}
	}

	// public static function login($username, $password)
	// {
	// 	$Table = new AdminsTable(new MySQL());
	// 	$admin = $Table->getUserByUsername($username);

	// 	if ($admin && password_verify($password, $admin['password']) && $admin['role'] === 'admin') {
	// 		session_start();
	// 		$_SESSION['admin'] = $admin['id'];
	// 		$_SESSION['username'] = $admin['username'];
	// 		$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time
	// 		return true;
	// 	}

	// 	return false;
	// }
}
