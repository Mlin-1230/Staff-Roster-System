<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人信息修改</title>

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

    <!-- Info Edit -->
    <div id="info_edit">
        <h1>修改個人信息</h1>
        <form method="post" action="./manage/user_edit.php">
            <table class="info_table">
                <tr>
                    <th>員工編號</th>
                    <td><input type="int" name="id" value="<?php echo $_SESSION['Id'];?>" disabled="disabled"></td>
                    <th>姓名</th>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['Name'];?>"></td>
                </tr>
                <tr>
                    <th>帳號</th>
                    <td><input type="text" name="account" value="<?php echo $_SESSION['Account'];?>"></td>
                    <th>密碼</th>
                    <td><input type="text" name="password" value="<?php echo $_SESSION['Password'];?>"></td>
                </tr>
                <tr>
                    <th>職位</th>
                    <td><input type="text" name="access" value="<?php echo $_SESSION['Access'];?>" disabled="desabled"></td>
                    <th>生理性別</th>
                    <td><input type="text" name="gender" value="<?php echo $_SESSION['Gender'];?>"></td>
                </tr>
            </table>
            <button class="edit" type="submit" value="確認">確認</button>
        </form>
        <button class="back3">取消</button>
    </div>
</body>
</html>