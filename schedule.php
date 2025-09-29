<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查閱班表</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main Js -->
    <script src="./assets/js/popup.js"></script>
    <script src="./assets/js/button.js"></script>
    <script src="./assets/js/icon.js"></script>

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>

    <!-- PHP Setting -->
    <?php
        require './manage/db.php';
        $events_sql = "SELECT Event_Id, Id, Info_Content, Info_Remark, Date,
            SUBSTRING(Time_Start, 1, 5) AS Time_Start, SUBSTRING(Time_End, 1, 5) AS Time_End,
            (SELECT Name FROM users WHERE users.Id = events.Id) AS Name
            FROM events ORDER BY Date";
        $events_result = mysqli_query($link, $events_sql);
        $events = array();
        while ($row = mysqli_fetch_assoc($events_result)) {
            $events[] = $row;
        }

        $trains_sql = "SELECT Train_Id, Id_1, Id_2, Train_Content, Date,
            SUBSTRING(Time_Start, 1, 5) AS Time_Start, SUBSTRING(Time_End, 1, 5) AS Time_End,
            (SELECT Name FROM users WHERE users.Id = train.Id_1) AS Name1,
            (SELECT Name FROM users WHERE users.Id = train.Id_2) AS Name2
            FROM train ORDER BY Date";
        $trains_result = mysqli_query($link, $trains_sql);
        $trains = array();
        while ($row = mysqli_fetch_assoc($trains_result)) {
            $trains[] = $row;
        }
    ?>

    <!-- Json_Encode -->
    <script>
        var eventsData = <?php echo json_encode($events); ?>;
        var trainsData = <?php echo json_encode($trains); ?>;
        <?php $access = isset($_SESSION['Access']) ? json_encode($_SESSION['Access']) : "''"; ?>
        var access = <?php echo $access; ?>;
    </script>

    <!-- Alert -->
    <script src="./assets/js/alert.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a class="navbar-brand" href="">排班系統</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href=""><i class="fa-solid fa-calendar active"></i>查閱班表</a>
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
                <a class="nav-link" href="./statistic.php"><i class="fa-solid fa-chart-simple"></i>薪資管理</a>
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

    <!-- Calendar -->
    <div id="Calendar">
        <?php
            require 'Calendar.php';
            echo new Calendar;
        ?>

        <!-- Popup -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <h2></h2>
                <p></p>
                <?php
                    if (isset($_SESSION['Access']) && $_SESSION['Access'] == "管理員") {
                        echo '
                            <button class="edit add">新增</button>
                            <button class="cancel">取消</button>
                        ';
                    } else {
                        echo '
                            <button class="cancel">關閉</button>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>