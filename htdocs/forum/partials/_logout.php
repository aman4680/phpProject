<?php
    session_start();
    echo 'Logging out. Please Wait...';

    session_destroy();
    header("location: /forum");
    exit();
?>