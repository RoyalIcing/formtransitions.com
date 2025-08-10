<?php
header(
    "content-security-policy: default-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; object-src 'none'; base-uri 'self'; form-action 'self'; img-src 'self' data:;",
); ?><!doctype html><meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
require "./style.html";

$path = rtrim($_SERVER["REQUEST_URI"], "?");
if ($_SERVER["REQUEST_URI"] !== $path) {
    header("Location: $path");
    exit();
}

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($path === "/"):
    echo "<h1>Form Transitions</h1>";
    echo "<ul>";
    echo "<li><a href=/search>Search</a>";
    echo "<li><a href=/login>Sign in</a>";
    echo "</ul>";
endif;

if ($path === "/search"):
    require "./php/search.php";
endif;

if ($path === "/login"):
    require "./php/login.php";
endif;

