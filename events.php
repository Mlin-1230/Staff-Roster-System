<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>班表</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main Js -->
    <script src="./assets/js/button.js"></script>

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>

    <!-- PHP Setting -->
    <?php
        require './manage/db.php';
    ?>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a class="navbar-brand" href="./schedule.php">排班系統</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./schedule.php"><i class="fa-solid fa-calendar"></i>查閱班表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./train.php"><i class="fa-solid fa-users-line"></i>教育訓練</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./leave.php"><i class="fa-regular fa-rectangle-list"></i>請假表單</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./statistic.php"><i class="fa-solid fa-chart-simple"></i>薪資管理</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./user.php"><i class="fa-solid fa-users"></i>個人資料</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./manage/logout.php"><i class="fa-solid fa-right-from-bracket"></i>登出</a>
            </li>
        </ul>
    </nav>

    <div id="event">
        <h1>編輯班表</h1>
            <?php
                if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                    if ($type == 'train') {
                        
                    // Train_Insert
                        echo '
                            <form action="./manage/train_insert.php" method="post">
                            <table class="event_table">
                                <tbody>
                                    <tr>
                                        <td>培訓人員</td>
                                        <td>實習人員</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="name1" required></td>
                                        <td><input type="text" name="name2" required></td>
                                    </tr>
                                    <tr>
                                        <td>日期</td>
                                        <td>時間</td>
                                    </tr>
                                    <tr>
                                        <td><input type="date" name="date" required></td>
                                        <td>
                                            <input type="time" name="time_start" required> ~ 
                                            <input type="time" name="time_end" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>培訓內容</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="content" name="content" required></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="edit">新增</button>
                        ';
                    } else if ($type == 'add') {

                    // Event_Insert
                        echo '
                            <form action="./manage/events_insert.php" method="post">
                            <table class="event_table">
                                <tbody>
                                    <tr>
                                        <td>姓名</td>
                                        <td>備註</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="name" required></td>
                                        <td><input type="text" class="remark" name="remark"></td>
                                    </tr>
                                    <tr>
                                        <td>日期</td>
                                        <td>時間</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="date" value="' . $_GET['date'] . '"></td>
                                        <td>
                                            <input type="time" name="time_start" required> ~ 
                                            <input type="time" name="time_end" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>工作內容</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="content" name="content" required></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="edit">新增</button>
                        ';
                    } else if ($type == 'edit_train') {

                    // Train_Edit
                        $sql = "SELECT *,
                            (SELECT Name FROM users WHERE users.Id = train.Id_1) AS Name1,
                            (SELECT Name FROM users WHERE users.Id = train.Id_2) AS Name2
                            FROM train WHERE Train_Id = {$_GET['id']}";
                        $result = mysqli_query($link, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $name1 = $row['Name1'];
                        $name2 = $row['Name2'];
                        $date = $row['Date'];
                        $time_start = $row['Time_Start'];
                        $time_end = $row['Time_End'];
                        $content = $row['Train_Content'];

                        $time_start_datetime = DateTime::createFromFormat('H:i:s.u', $time_start);
                        $time_start_format = $time_start_datetime->format('H:i');

                        $time_end_datetime = DateTime::createFromFormat('H:i:s.u', $time_end);
                        $time_end_format = $time_end_datetime->format('H:i');
                        echo '
                            <form action="./manage/train_edit.php?Train_Id=' . $_GET['id'] . '" method="post">
                            <table class="event_table">
                                <tbody>
                                    <tr>
                                        <td>培訓人員</td>
                                        <td>實習人員</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="name1" value="' . $name1 . '" required></td>
                                        <td><input type="text" name="name2" value="' . $name2 . '" required></td>
                                    </tr>
                                    <tr>
                                        <td>日期</td>
                                        <td>時間</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="date" value="' . $date . '" required></td>
                                        <td><input type="time" name="time_start" value="' . $time_start_format . '" required> ~ 
                                            <input type="time" name="time_end" value="' . $time_end_format . '" required></td>
                                    </tr>
                                    <tr>
                                        <td>培訓內容</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="content" name="content" required>' . $content . '</textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="edit">編輯</button>
                        ';
                    } else if ($type == 'edit_event') {

                    // Event_Edit
                        $sql = "SELECT *,
                            (SELECT Name FROM users WHERE users.Id = events.Id) AS Name
                            FROM events WHERE Event_Id = {$_GET['id']}";
                        $result = mysqli_query($link, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $name = $row['Name'];
                        $date = $row['Date'];
                        $time_start = $row['Time_Start'];
                        $time_end = $row['Time_End'];
                        $content = $row['Info_Content'];
                        $remark = ($row['Info_Remark'] === null) ? '' : $row['Info_Remark'];

                        $time_start_datetime = DateTime::createFromFormat('H:i:s.u', $time_start);
                        $time_start_format = $time_start_datetime->format('H:i');

                        $time_end_datetime = DateTime::createFromFormat('H:i:s.u', $time_end);
                        $time_end_format = $time_end_datetime->format('H:i');
                        echo '
                            <form action="./manage/events_edit.php?Event_Id=' . $_GET['id'] . '" method="post">
                            <table class="event_table">
                                <tbody>
                                    <tr>
                                        <td>姓名</td>
                                        <td>備註</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="name" value="' . $name . '" required></td>
                                        <td><input type="text" class="remark" name="remark" value="' . $remark . '"></td>
                                    </tr>
                                    <tr>
                                        <td>日期</td>
                                        <td>時間</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="date" value="' . $date . '" required></td>
                                        <td><input type="time" name="time_start" value="' . $time_start_format . '" required> ~ 
                                            <input type="time" name="time_end" value="' . $time_end_format . '" required></td>
                                    </tr>
                                    <tr>
                                        <td>工作內容</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="content" name="content" required>' . $content . '</textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="edit">編輯</button>
                        ';
                    }
                }
            ?>
        </form>
        <button class="back">取消</button>
    </div>
</body>

</html>