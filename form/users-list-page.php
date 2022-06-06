<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){ // nếu người dùng chưa log in thì sẽ điều hướng đến trang login
        header("location: /chat-app/form/users-list-page.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="users-container">
        <div class="wrapper">
        <section class="users">
            <header>
            <?php
                include_once "../php/config.php";
                // chọn tất cả dữ liệu của người dùng đăng nhập hiện tại trong phiên làm việc
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                // var_dump($sql);
                // var_dump(mysqli_num_rows($sql));
                // die();
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>
                <div class="content">
                    <img src="../php/<?php echo $row['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']." ".$row['lname']?></span>
                        <p><?php echo $row['status']?></p>
                    </div>
                </div>
                <a href="../php/logout.php?logout_id=<?php echo $row['unique_id']?>" class="logout">Log out</a>
            </header>
            <div class="search">
                <span class="text">Search</span>
                <input type="text" placeholder="Search for an user to chat...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>
    </div>
    
    <script src="/chat-app/script/users.js"></script>
</body>
</html>