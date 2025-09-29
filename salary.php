<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>薪資調整</title>

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

    <!-- Salary -->
    <div id="Salary">
        <h1>薪資調整</h1>
        <?php
            if ($_GET['type']=="salary") {
                echo '
                    <form method="post" action="./manage/salary_edit.php">
                        <table class="Salary_table">
                            <tr>
                                <th>姓名</th>
                                <td><input type="text" name="name" value="' . $_GET['name'] . '"></td>
                                <th>調整底薪</th>
                                <td><input type="int" name="salary" placeholder="（原始底薪：' . $_GET['salary'] . '）"></td>
                            </tr>
                        </table>
                        <button class="edit" type="submit" value="確認">確認</button>
                ';
            } else if ($_GET['type']=="dock") {
                echo '
                    <form method="post" action="./manage/dock_edit.php">
                        <table class="Salary_table">
                            <tr>
                                <th>姓名</th>
                                <td><input type="text" name="name" value="' . $_GET['name'] . '"></td>
                                <th>扣薪</th>
                                <td><input type="int" name="dock_price"></td>
                            </tr>
                            <tr>
                                <th>原因</th>
                                <td colspan="3"><input type="text" id="dock_reason" name="dock_reason"></td>
                            </tr>
                        </table>
                        <button class="edit" type="submit" value="確認">確認</button>
                ';
            }
        ?>
        </form>
        <button class="back2">取消</button>
    </div>
</body>
</html>