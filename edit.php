<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>班表</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">

    <!-- Main js -->
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
                <i class="fa-solid fa-calendar"></i>
                <a class="nav-link" href="./schedule.php">查閱班表</a>
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-users-line"></i>
                <a class="nav-link" href="./train.php">教育訓練</a>
            </li>
            <li class="nav-item">
                <i class="fa-regular fa-rectangle-list"></i>
                <a class="nav-link" aria-current="page" href="./leave.php">請假表單</a>
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-chart-simple"></i>
                <a class="nav-link" href="./statistic.php" id="navbarDropdownMenuLink" role="button">各項統計</a>
            </li>
            <li>
                <i class="fa-solid fa-users"></i>
                <a class="nav-link" href="./user.php">使用者</a>
            </li>
        </ul>
    </nav>

    <div id="edit">
        <h1>編輯班表</h1>
        <form action="#" method="post">
            <table id="edit_table">
                <tbody>
                    <?php
                        if (isset($_GET['type'])) {
                            $type = $_GET['type'];
                            echo '
                                <tr>
                                    <td>培訓人員</td>
                                    <td>實習人員</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="name1"></td>
                                    <td><input type="text" name="name2"></td>
                                </tr>
                                <tr>
                                    <td>日期</td>
                                    <td>時間</td>
                                </tr>
                                <tr>
                                    <td><input type="date" name="date"></td>
                                    <td><input type="time" name="time_start"> ~ <input type="time" name="time_end"></td>
                                </tr>
                                <tr>
                                    <td>培訓內容</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><textarea id="content" name="content"></textarea></td></tr>
                            ';
                        } else {
                            echo '
                                <tr>
                                    <td>姓名</td>
                                    <td>備註</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="name"></td>
                                    <td><input type="text" id="remark" name="remark"></td>
                                </tr>
                                <tr>
                                    <td>日期</td>
                                    <td>時間</td>
                                </tr>
                                <tr>
                                    <td><input type="date" name="date"></td>
                                    <td><input type="time" name="time_start"> ~ <input type="time" name="time_end"></td>
                                </tr>
                                <tr>
                                    <td>工作內容</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><textarea id="content" name="content"></textarea></td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
            <button class="button cancel"><a href="./schedule.php">取消</a></button>
            <button class="button submit" type="submit">編輯</button>
        </form>
    </div>
</body>

</html>