<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?= View::asset('css/style.css'); ?>">
</head>

<body>

<div class="viewport">

    <div id="message" class="message">
        <ul>

        </ul>
    </div>

    <div class="container">

        <div class="blackBox">

            <div class="infoBox">

                <h2>Don’t have an account?</h2>
                <hr class="hr">
                <p>
                    Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua.
                </p>

                <button name="singUp" class="button" onclick="animation.slideForm(1)">SING UP</button>

            </div>

            <div class="infoBox">

                <h2>Don’t have an account?</h2>
                <hr class="hr">
                <p>
                    Lorem ipsum dolor sit amet
                    consectetur adipisicing elit.
                </p>

                <button name="login" class="button" onclick="animation.slideForm(0)"> LOGIN</button>

            </div>

        </div>

        <div class="whiteBox login">


            <div class="headLiner">
                <h2 id="headline" data-login-text="Login" data-register-text="SIGN UP"> Login </h2>
                <img class="logo" src="<?= View::asset('img/mb-logo.svg') ?>" alt="mg-logo">
            </div>

            <hr class="hr">
            <!-- Login Form -->
            <form id="login" method="post" action="<?=URL ?>/auth/login">

                <div class="inputField">
                    <div class="textPlace">
                        <label for="name">
                            Email
                            <span class="alert">*</span>
                        </label>
                        <span class="email icon"></span>
                    </div>
                        <input type="text" name="email" value="" required>
                </div>

                <div class="inputField">
                    <div class="textPlace">
                        <label for="name" class="active">
                            Password
                            <span class="alert">*</span>
                        </label>
                        <span class="password active icon"></span>
                    </div>
                    <input type="password" name="password" placeholder="" required>
                </div>

                <div class="inputField submitField">
                    <button type="button" name="login" class="button submit" onclick="app.formSubmit('login')">LOGIN</button>  <a href="#">Forgot?</a>
                </div>

            </form>

            <!-- Login Form end -->

            <!-- Register Form -->
            <form id="register" class="hide singUpForm" action="<?=URL ?>/register/create" method="post">

                <div class="inputField">
                    <div class="textPlace">
                        <label for="name">
                            Name
                            <span class="alert">*</span>
                        </label>
                        <span class="user active"></span>
                    </div>
                    <input type="text" name="name" required>
                </div>

                <div class="inputField">
                    <div class="textPlace">
                        <label for="email">
                            Email
                            <span class="alert">*</span>
                        </label>
                        <span class="email"></span>
                    </div>
                    <input type="text" name="email" required>
                </div>

                <div class="inputField">
                    <div class="textPlace">
                        <label for="password">
                            Password
                            <span class="alert">*</span>
                        </label>
                        <span class="password active"></span>
                    </div>
                    <input type="password" name="password" required>
                </div>

                <div class="inputField submitField">
                    <button name="singUp" class="button submit" type="button" onclick="app.formSubmit('register')">SIGN UP</button>  <a href="#">Forgot?</a>
                </div>

            </form>
            <!-- Register From end -->

        </div>

    </div>



</div>
<div class="copyright"> All Rights Reserved “Magebit” 2016. </div>
<script src="<?=View::asset("js/app.js") ?>"></script>
<script src="<?=View::asset("js/animation.js") ?>"></script>
</body>

</html>