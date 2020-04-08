<?php
$host = $_SERVER['HTTP_HOST'];
$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$url .= "://" . $host;
if ($host == "localhost") {
    header("Location: " . $url . "/covid/error_page");
} else {
    header("Location: " . $url . "/error_page");
}
