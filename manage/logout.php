<?php
    $_SESSION['Account'] = "";
    $_SESSION['Id'] = "";
    $_SESSION['Name'] = "";
    $_SESSION['Access'] = "";

    echo '
        <script>
            localStorage.setItem("alertMessage", "已登出！");
            window.location.href = "../schedule.php";
        </script>
    ';
?>