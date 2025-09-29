<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>刪除</title>
</head>
<body>
    <?php
        $id = $_GET['id'];

        require './db.php';

        $find_date = "SELECT * FROM train WHERE Train_Id = '$id'";
        $find_date_result = mysqli_query($link, $find_date);
        $row = mysqli_fetch_assoc($find_date_result);
        $id_1 = $row['Id_1'];
        $id_2 = $row['Id_2'];
        $date = $row['Date'];
        $time_start = $row['Time_Start'];
        $time_end = $row['Time_End'];
        $content = $row['Train_Content'];

        $sql = "DELETE FROM train WHERE
        Id_1='$id_1' and
        Id_2='$id_2' and
        Date='$date'and
        Time_Start='$time_start'and
        Time_End='$time_end'and
        Train_Content='$content';
        ";
        $result = mysqli_query($link,$sql);

        if (mysqli_affected_rows($link)>0) {
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "刪除成功！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        } else if (mysqli_affected_rows($link)==0) {
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "無資料刪除！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        } else {
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "刪除失敗！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }
    ?>
</body>
</html>