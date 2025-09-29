<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增</title>
</head>
<body>
    <?php
        $name = $_POST['name'];
        $remark = $_POST['remark'];
        $date = $_POST['date'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $content = $_POST['content'];
        
        require './db.php';

        $find_id = "SELECT Id FROM users WHERE Name = '$name'";
        $find_id_result = mysqli_query($link, $find_id);
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

        $sql = "INSERT INTO events (Id, Info_Remark, Date, Time_Start, Time_End, Info_Content) 
        VALUES ('$Id', '$remark', '$date', '$time_start', '$time_end', '$content')";
        $result = mysqli_query($link, $sql);

        if($result){
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "新增成功！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }else{
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "新增失敗！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }
    ?>
</body>
</html>