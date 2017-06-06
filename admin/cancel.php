<?php
session_start();
unset($_SESSION['admin_info']);
if (empty($_SESSION))
    session_destroy();
echo "<script>window.location.href = 'index.php';</script>";