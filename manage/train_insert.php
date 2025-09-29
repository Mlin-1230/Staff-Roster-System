<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增</title>
</head>
<body>
    <?php
        $name1 = $_POST['name1'];
        $name2 = $_POST['name2'];
        $date = $_POST['date'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $content = $_POST['content'];

        require './db.php';

        $find_id1 = "SELECT Id FROM users WHERE Name = '$name1'";
        $find_id_result1 = mysqli_query($link, $find_id1);
        $row1 = mysqli_fetch_assoc($find_id_result1);
        $Id_1 = $row1['Id'];

        $find_id2 = "SELECT Id FROM users WHERE Name = '$name2'";
        $find_id_result2 = mysqli_query($link, $find_id2);
        $row2 = mysqli_fetch_assoc($find_id_result2);
        $Id_2 = $row2['Id'];

        require './haveLeave.php';

        if (hasLeave_Train($link, $Id_1, $Id_2, $date, $time_start, $time_end)) {
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "該日期已有請假紀錄！");
                    window.location.href = "../schedule.php";
                </script>
            ';
        }

        $sql = "INSERT INTO train (Id_1, Id_2, Date, Time_Start, Time_End, Train_Content) 
        VALUES ('$Id_1', '$Id_2', '$date', '$time_start', '$time_end', '$content')";
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