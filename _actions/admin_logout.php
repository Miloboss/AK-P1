<?php
include("../vendor/autoload.php");

session_start();
session_unset();
session_destroy();
header('location: ../admin/index.php');
