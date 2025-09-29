<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教育訓練</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main Js -->
    <script src="./assets/js/button.js"></script>

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/3daedf892a.js" crossorigin="anonymous"></script>
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
                <a class="nav-link active" href=""><i class="fa-solid fa-users-line active"></i>教育訓練</a>
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

    <!-- Train -->
    <div class="Train">
        <!-- 培訓須知 -->
        <h1>培訓須知</h1>
        <table id="training">
            <thead>
                <tr class="titles">
                    <th>編號</th>
                    <th>項目名稱</th>
                    <th>網址</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>公司章程</td>
                    <td>
                        <a href="#">(XXX.pdf)</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>培訓計畫</td>
                    <td>
                        <a href="#">(XXX.pdf)</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- 相關資訊 -->
        <h1>其他相關資訊連結</h1>
        <table id="links">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>名稱</th>
                    <th>檔案</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>公司規範</td>
                    <td>
                        <a href="#">(https://xxx)</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>勞基法</td>
                    <td>
                        <a href="#">(https://xxx)</a>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- 時程安排 -->
        <?php
            if (isset($_SESSION['Access']) && $_SESSION['Access'] == "管理員") {
                echo '<button class="button edit train_btn" value="時程安排">時程安排</button>';
            }
        ?>
    </div>
</body>

</html>