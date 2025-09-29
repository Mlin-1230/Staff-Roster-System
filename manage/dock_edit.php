<?php
    $name = $_POST['name'];
    $dock_price = $_POST['dock_price'];
    $dock_reason = $_POST['dock_reason'];

    require './db.php';
    $find_id = "SELECT Id FROM users WHERE Name='$name'";
    $find_id_result = mysqli_query($link,$find_id);
    $row = mysqli_fetch_assoc($find_id_result);
    $Id = $row['Id'];

    $sql = "INSERT INTO dock (Id, Dock_Price, Dock_Reason)
    VALUES ('$Id', '$dock_price', '$dock_reason')";
    $result = mysqli_query($link, $sql);

    if ($result) {
        mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改成功！");
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