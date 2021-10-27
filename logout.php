<?php
session_start();
session_destroy();

echo"<script>alert('logout berhasil, Have a nice day');location='login.php'</script>";