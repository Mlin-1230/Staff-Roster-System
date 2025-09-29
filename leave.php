<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>請假表單</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main Js -->
    <script src="./assets/js/button.js"></script>

    <!-- Alert -->
    <script src="./assets/js/alert.js"></script>

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
                <a class="nav-link active" href=""><i class="fa-regular fa-rectangle-list active"></i>請假表單</a>
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

    <!-- Leave Form -->
    <div id="leave">
        <h1>請假表單</h1>
        <form id="leave_form" method="post" action="./manage/leave_form.php">
            <table id="leave_table">
                <tr>
                    <th>申請人</th>
                    <td><input type="text" name="Name" value="<?php echo $_SESSION['Name'];?>" disabled="disabled"></td>
                    <th>備註</th>
                    <td><input type="text" name="Leave_Remark"></td>
                </tr>
                <tr>
                    <th>假別</th>
                    <td>
                        <select id="leaveType" name="Leave_Type" required>
                            <option value=0>病假</option>
                            <option value=1>事假</option>
                            <option value=2>喪假</option>
                        </select>
                    </td>
                    <th>請假事由</th>
                    <td><input type="text" name="Leave_Reason" required></td>
                </tr>
                <tr>
                    <th>開始時間</th>
                    <td>
                        <input type="time" name="Leave_Start" required>
                    <th>結束時間</th>
                    <td>
                        <input type="time" name="Leave_End" required>
                    </td>
                </tr>
                <tr>
                    <th>日期</th>
                    <td><input type="date" name="Date" required></td>
                    <th>附件</th>
                    <td><input type="file" name="attachments" multiple></td>
                </tr>
            </table>
            <button class="edit" type="submit" value="提交">提交</button>
        </form>
        <button class="back">取消</button>
    </div>
</body>

</html>