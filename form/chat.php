<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){ // nếu người dùng chưa log in thì sẽ điều hướng đến trang login
        header("location: /chat-app/form/login.php");
    }
?>

<?php include_once "header.php";?>
<body>
    <div class="chat-container">
        <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
                include_once "../php/config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                // chọn tất cả dữ liệu của người dùng đăng nhập hiện tại trong phiên làm việc
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>
                <a href="users-list-page.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>

                <img src="../php/<?php echo $row['img'];?>" alt="">

                <div class="details">
                    <span><?php echo $row['fname']." ".$row['lname'];?></span>
                    <p><?php echo $row['status'];?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>

                <div class="chat incoming">
                    <img src="/chat-app/assets/img/img.jpg" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div> -->

            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id;?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fas fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    </div>
    <script src="/chat-app/script/chat.js"></script>
</body>
</html>