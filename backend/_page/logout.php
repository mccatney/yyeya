<?php
    //session_destroy();
    unset($_SESSION['admin']);
    echo '<script>window.location.href="?page=home"</script>';