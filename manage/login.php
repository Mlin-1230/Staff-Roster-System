<?php
    session_start();
    $account = $_POST['account'];
    $password = $_POST['password'];

    require('db.php');
    $sql = "SELECT DISTINCT * FROM users WHERE account = '$account' AND password = '$password'";
    $result = mysqli_query($link, $sql);
    if ($row=mysqli_fetch_assoc($result)) {
        $_SESSION['Account'] = $account;
        $_SESSION['Password'] = $password;
        $_SESSION['Id'] = $row['Id'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Access'] = $row['Access'];
        $_SESSION['Gender'] = $row['Gender'];
        mysqli_close($link);
        echo '
            <script>
                localStorage.setItem("alertMessage", "你好！ ' . $_SESSION['Name'] . '");
                window.location.href = "../schedule.php";
            </script>
        ';
    } else {
        mysqli_close($link);
        echo '
            <script>
                localStorage.setItem("alertMessage", "帳號或密碼錯誤！");
                window.location.href = "../login.html";
            </script>
        ';
    }
?>