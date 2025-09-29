<?php
    $name = $_POST['name'];
    $salary = $_POST['salary'];

    require './db.php';
    $find_id = "SELECT Id FROM users WHERE Name='$name'";
    $find_id_result = mysqli_query($link,$find_id);
    $row = mysqli_fetch_assoc($find_id_result);
    $Id = $row['Id'];

    $sql = "UPDATE salary SET
    Salary = '$salary'
    WHERE Id = '$Id'";
    $result = mysqli_query($link, $sql);

    if (mysqli_affected_rows($link)>0) {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改成功！");
                    window.location.href = "../statistic.php";
                </script>
            ';
    } else if (mysqli_affected_rows($link)==0) {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "無資料修改！");
                    window.location.href = "../statistic.php";
                </script>
            ';
    } else {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改失敗！");
                    window.location.href = "../statistic.php";
                </script>
            ';
    }
?>