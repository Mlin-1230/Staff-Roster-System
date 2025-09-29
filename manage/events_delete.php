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

        $find_date = "SELECT * FROM events WHERE Event_Id = '$id'";
        $find_date_result = mysqli_query($link, $find_date);
        $row = mysqli_fetch_assoc($find_date_result);
        $id = $row['Id'];
        $remark = $row['Info_Remark'];
        $date = $row['Date'];
        $time_start = $row['Time_Start'];
        $time_end = $row['Time_End'];
        $content = $row['Info_Content'];

        $sql = "DELETE FROM events WHERE
        Id='$id' and
        Info_Remark='$remark'and
        Date='$date'and
        Time_Start='$time_start'and
        Time_End='$time_end'and
        Info_Content='$content';
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