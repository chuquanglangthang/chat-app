<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // if user is logged in
        header("location: /chat-app/form/users-list-page.php"); //move to this page
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="signup-container">
        <div class="wrapper">
        <section class="form signup">
        <!-- header of signup page -->
            <header>Create an account</header>
            <!-- form đăng kí -->
            <form action="/chat-app/php/signup.php" method="post" enctype="multipart/form-data">
                <!-- Error messages -->
                <div class="error-txt">This is an error message</div>
                <!-- Họ tên -->
                <div class="name-details">
                    <!-- First Name -->
                    <div class="field input">
                        <!-- <label>First Name</label> -->
                        <input type="text" placeholder="First Name" name="fname" required>
                    </div>
                    <!-- Last Name -->
                    <div class="field input">
                        <!-- <label>Last Name</label> -->
                        <input type="text" placeholder="Last Name" name="lname" required>
                    </div>
                </div>
                <!-- Địa chỉ email -->
                <div class="field input">
                    <!-- <label>Email Address</label> -->
                    <input type="text" placeholder="Enter your email" name="email" required>
                </div>
                <!-- Mật khẩU -->
                <div class="field input">
                    <!-- <label>Password</label> -->
                    <input type="password" placeholder="Enter new password" name="password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <!-- Chọn ảnh làm avatar -->
                <div class="field image">
                    <label>Select your avatar</label>
                    <input type="file" name="image" required>
                </div>
                <!-- Nút submit -->
                <div class="field button">
                    <input type="submit" value="Sign up">
                </div>
            </form>
            <!-- Nếu đã đăng kí thì có thể chuyển qua trang đăng nhập -->
            <div class="link">Already had an account? <a href="login.php">Sign in now!</a></div>
        </section>
    </div>
    </div>
    
    <script src="/chat-app/script/pass-show-hide.js"></script>
    <script src="/chat-app/script/signup.js"></script>

</body>
</html>