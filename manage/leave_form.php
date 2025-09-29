<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>請假</title>
</head>
<body>
    <?php
        $Id = $_SESSION['Id'];
        $name = $_SESSION['Name'];
        $Leave_Remark = $_POST['Leave_Remark'];
        $Leave_Type =  $_POST['Leave_Type'];
        $Leave_Reason = $_POST['Leave_Reason'];
        $Leave_Start = $_POST['Leave_Start'];
        $Leave_End = $_POST['Leave_End'];
        $Date = $_POST['Date'];

        require './db.php';

        $sql = "INSERT INTO leaves (Id, Leave_Remark, Leave_Type, Leave_Reason, Leave_Start, Leave_End, Date) 
        VALUES ('$Id','$Leave_Remark','$Leave_Type','$Leave_Reason','$Leave_Start','$Leave_End','$Date')";
        $result = mysqli_query($link, $sql);

        if($result){
            require './haveLeave.php';
            if (cancelEvent($link, $Id, $Date, $Leave_Start, $Leave_End)) {
                mysqli_close($link);
                echo '
                    <script>
                        localStorage.setItem("alertMessage", "填寫成功！已取消當天排程。");
                        window.location.href = "../schedule.php";
                    </script>
                ';
            } else if (cancelTrain($link, $Id, $Date, $Leave_Start, $Leave_End)) {
                mysqli_close($link);
                echo '
                    <script>
                        localStorage.setItem("alertMessage", "填寫成功！已取消當天排程。");
                        window.location.href = "../schedule.php";
                    </script>
                ';
            } else {
                mysqli_close($link);
                echo '
                    <script>
                        localStorage.setItem("alertMessage", "填寫成功！");
                        window.location.href = "../schedule.php";
                    </script>
                ';
            }
        }else{
            mysqli_close($link);
            echo '
                <script>
                    localStorage.setItem("alertMessage", "填寫失敗！");
                    window.location.href = "../leave.php";
                </script>
            ';
        }
    ?>
</body>
</html>