<?php

session_start();

if (isset($_POST["logout"])) {
    session_destroy();

    echo "<script>
        window.location.href = '../login.php';
    </script>";
}


?>