<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // if user is logged in
        header("location: /chat-app/form/users-list-page.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="login-container">
        <div class="wrapper">
        <section class="form login">
            <header>Sign in</header>
            <form action="login.php" autocomplete="off" method="post">
                <div class="error-txt">This is an error message!</div>
                <div class="field input">
                    <!-- <label>Email</label> -->
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="field input">
                    <!-- <label>Password</label> -->
                    <input type="password" placeholder="Password" name="password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="button" value="Sign in">
                </div>
            </form>
            <div class="link">Don't have an account? <a href="/chat-app/form/signup.php">Create now!</a></div>
        </section>
        </div>
    </div>
    <script src="/chat-app/script/pass-show-hide.js"></script>
    <script src="/chat-app/script/login.js"></script>
</body>
</html>