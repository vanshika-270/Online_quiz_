<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "online_quiz";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8");
}
function go($url) {
    header("Location: $url");
    exit;
}
function require_login() {
    if (empty($_SESSION["role"])) go("login.php");
}
function require_role($role, $loginPath = "../login.php") {
    if (empty($_SESSION["role"]) || strcasecmp($_SESSION["role"], $role) !== 0) {
        go($loginPath);
    }
}
function current_id() {
    return (int)($_SESSION["user_id"] ?? 0);
}
function current_name() {
    return $_SESSION["user_name"] ?? "User";
}
function role_home($role) {
    return match (strtolower($role)) {
        "admin" => "admin/dashboard.php",
        "teacher" => "teacher/dashboard.php",
        "student" => "student/dashboard.php",
        default => "login.php"
    };
}
?>
