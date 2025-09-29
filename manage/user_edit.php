<?php
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $account = $_POST['account'];
    $password = $_POST['password'];

    require './db.php';

    $sql = "UPDATE users SET
    Name = '$name',
    Gender = '$gender',
    Account = '$account',
    Password = '$password'
    WHERE Id = '{$_SESSION['Id']}'";
    $result = mysqli_query($link, $sql);

    if (mysqli_affected_rows($link)>0) {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改成功！");
                    window.location.href = "../user.php";
                </script>
            ';
    } else if (mysqli_affected_rows($link)==0) {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "無資料修改！");
                    window.location.href = "../user.php";
                </script>
            ';
    } else {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改失敗！");
                    window.location.href = "../user.php";
                </script>
            ';
    }
?>