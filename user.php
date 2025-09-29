<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>工資管理</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>

    <!-- PHP Setting -->
    <?php
        require './manage/db.php';
        $sql = "SELECT s.Salary,
            SEC_TO_TIME(
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(e.Time_End, e.Time_Start))), 0) +
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(t1.Time_End, t1.Time_Start))), 0) +
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(t2.Time_End, t2.Time_Start))), 0)
            ) AS Working_Time,
            (SELECT COALESCE(COUNT(*), 0) FROM leaves WHERE Id = {$_SESSION['Id']}) AS Count,
            COALESCE(SUM(d.Dock_Price), 0) AS Price
            FROM users u
            LEFT JOIN salary s ON u.Id = s.Id
            LEFT JOIN dock d ON u.Id = d.Id
            LEFT JOIN events e ON u.Id = e.Id
            LEFT JOIN train t1 ON u.Id = t1.Id_1
            LEFT JOIN train t2 ON u.Id = t2.Id_2
            WHERE u.Id = {$_SESSION['Id']}
            GROUP BY u.Id;
        ";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);

        $Working_Time = DateTime::createFromFormat('H:i:s.u', $row['Working_Time']);
        $hr = $Working_Time->format('H');
        $min = $Working_Time->format('i');
    ?>

    <!-- Alert Js -->
    <script src="./assets/js/alert.js"></script>
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
                <a class="nav-link active" href=""><i class="fa-solid fa-users active"></i>個人資料</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./manage/logout.php"><i class="fa-solid fa-right-from-bracket"></i>登出</a>
            </li>
        </ul>
    </nav>

    <!-- User -->
    <div class="User">
        <div class="Person">
            <h1>個人資料</h1>
            <table id="info">
                <tr>
                    <th class="title" colspan="4">基本信息
                        <a href="./info_edit.php">
                            <i class="fa-solid fa-pen-to-square edit_info_icon"></i>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>員工編號</th>
                    <td><?php echo $_SESSION['Id'];?></td>
                    <th>姓名</th>
                    <td><?php echo $_SESSION['Name'];?></td>
                </tr>
                <tr>
                    <th>帳號</th>
                    <td><?php echo $_SESSION['Account'];?></td>
                    <th>密碼</th>
                    <td><?php echo $_SESSION['Password'];?></td>
                </tr>
                <tr>
                    <th>職位</th>
                    <td><?php echo $_SESSION['Access'];?></td>
                    <th>生理性別</th>
                    <td><?php echo $_SESSION['Gender'];?></td>
                </tr>
                <tr>
                    <th class="title" colspan="4">工作內容</th>
                </tr>
                <tr>
                    <th>底薪</th>
                    <td><?php echo $row['Salary'] . ' (NTD)';?></td>
                    <th>總工時</th>
                    <td><?php echo $hr . ' 時 ' . $min . '分';?></td>
                </tr>
                <tr>
                    <th>請假</th>
                    <td><?php echo $row['Count'] . ' (次)';?></td>
                    <th>扣薪</th>
                    <td><?php echo $row['Price'] . ' (NTD)';?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>