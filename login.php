<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>

    <!-- Main Css -->
    <link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
    <!-- Navbar -->


    <!-- Login -->
    <div id="Login">
        <div>
            <img src="./assets/img/login.png" alt=""><br>
            <h3>登入</h3>
        </div>

        <!-- Form -->
        <form action="./schedule.php" method="post">
            <div class="Input">
                <input type="text" name="account" id="username" placeholder="請輸入帳號">
            </div>
            <div class="Input">
                <input type="password" name="password" id="password" placeholder="請輸入密碼">
            </div>
            <div id="Forget">
                <a href="#">忘記密碼</a>
            </div>
            <div id="Submit">
                <input type="submit" value="登入">
            </div>
        </form>
    </div>
</body>
</html>