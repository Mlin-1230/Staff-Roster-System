<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯</title>
</head>
<body>
    <?php
        $Event_Id = $_GET['Event_Id'];
        $name = $_POST['name'];
        $remark = $_POST['remark'];
        $date = $_POST['date'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $content = $_POST['content'];

        require './db.php';

        $find_id = "SELECT Id FROM users WHERE Name='$name'";
        $find_id_result = mysqli_query($link,$find_id);
        $row = mysqli_fetch_assoc($find_id_result);
        $Id = $row['Id'];

        require './haveLeave.php';

        if (hasLeave_Event($link, $Id, $date, $time_start, $time_end)) {
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "該日期已有請假紀錄！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }

        $sql = "UPDATE events SET 
        Id='$Id',
        Info_Remark='$remark',
        Date='$date',
        Time_Start='$time_start',
        Time_End='$time_end',
        Info_Content='$content'
        WHERE Event_Id='$Event_Id'
        ";
        $result = mysqli_query($link,$sql);

        if (mysqli_affected_rows($link)>0) {
            mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改成功！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        } else if (mysqli_affected_rows($link)==0) {
            mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "無資料修改！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        } else {
            mysqli_close($link); 
            echo '
                <script>
                    localStorage.setItem("alertMessage", "修改失敗！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }
    ?>
</body>
</html>