<?php
session_start();
echo "<pre>";
if (empty($_GET["s"])) {
    $veri = $_SESSION;
} else {
    $veri = $_SESSION[$_GET["s"]];
}
print_r($veri);
echo "</pre>";
