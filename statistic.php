<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>薪資管理</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main Js -->
    <script src="./assets/js/button.js"></script>
    <script src="./assets/js/icon.js"></script>

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>

    <!-- PHP Setting -->
    <?php
        require './manage/db.php';
        $sql = "SELECT u.Id, u.Name, u.Access, s.Salary,
            (SELECT COUNT(*) FROM Leaves l WHERE l.Id = u.Id) AS Leaves_Count,
            (SELECT COUNT(*) FROM Dock d WHERE d.Id = u.Id) AS Dock_Count,
            (SELECT COALESCE(SUM(d.Dock_Price), 0) FROM Dock d WHERE d.Id = u.Id) AS Dock_Price,
            SEC_TO_TIME(
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(e.Time_End, e.Time_Start))), 0) +
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(t1.Time_End, t1.Time_Start))), 0) +
                COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(t2.Time_End, t2.Time_Start))), 0)
            ) AS Working_Time
            FROM users u
            LEFT JOIN salary s ON u.Id = s.Id
            LEFT JOIN events e ON u.Id = e.Id
            LEFT JOIN train t1 ON u.Id = t1.Id_1
            LEFT JOIN train t2 ON u.Id = t2.Id_2
            GROUP BY u.Id, u.Name, u.Access, s.Salary;
        ";
        $result = mysqli_query($link, $sql);
        $statistic = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $statistic[] = $row;
        }
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
            <?php
                if (isset($_SESSION['Name']) && $_SESSION['Name'] != "") {
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="./leave.php"><i class="fa-regular fa-rectangle-list"></i>請假表單</a>
                        </li>
                    ';
                }
            ?>
            <li class="nav-item">
                <a class="nav-link active" href=""><i class="fa-solid fa-chart-simple active"></i>薪資管理</a>
            </li>
            <li class="nav-item">
                <?php
                    if (isset($_SESSION['Name']) && $_SESSION['Name'] != "") {
                        echo '
                                <a class="nav-link" href="./user.php"><i class="fa-solid fa-users"></i>個人資料</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./manage/logout.php"><i class="fa-solid fa-right-from-bracket"></i>登出</a>
                                
                            ';
                    } else {
                        echo '<a class="nav-link" href="./login.html"><i class="fa-solid fa-right-to-bracket"></i>登入</a>';
                    }
                ?>
            </li>
        </ul>
    </nav>

    <!-- Statistic -->
    <div id="Statistic">
        <h1>薪資管理</h1>
        <table id="Statistic_table">  
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>職位</th>
                    <th>薪資</th>
                    <th>工作時數</th>
                    <th>請假</th>
                    <th colspan="2">扣薪</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($statistic as $row) {
                        $Working_Time = DateTime::createFromFormat('H:i:s.u', $row['Working_Time']);
                        $hr = $Working_Time->format('H');
                        $min = $Working_Time->format('i');

                        $salary = $row['Salary'] + (($hr + $min/60)*200) - $row['Dock_Price'];
                        $salary = round($salary);

                        echo "<tr>";
                        echo "<td>" . $row['Id'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Access'] . "</td>";
                        echo "<td>" . $salary . " (NTD)";
                        if (isset($_SESSION['Access']) && $_SESSION['Access'] == "管理員") {
                            echo '<a href="salary.php?type=salary&salary=' . $row['Salary'] . '&name=' . $row['Name'] . '">
                                    <i class="fa-solid fa-pen-to-square edit_salary_icon">
                                </a>';
                        }
                        echo"</td>";
                        echo "<td>" . $hr . " 時 " . $min . " 分 </td>";
                        echo "<td>" . $row['Leaves_Count'] . " (次)</td>";
                        echo "<td>" . $row['Dock_Count'] . " (次)</td>";
                        echo "<td>" . $row['Dock_Price'] . " (NTD)";
                        if (isset($_SESSION['Access']) && $_SESSION['Access'] == "管理員") {
                            echo '<a href="salary.php?type=dock&name=' . $row['Name'] . '">
                                    <i class="fa-solid fa-pen-to-square edit_dock_icon">
                                </a>';
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>