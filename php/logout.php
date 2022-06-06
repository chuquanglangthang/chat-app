<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // if users log in then come to this page 
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){ //if logout_id is set, update status thành offline
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '$status' WHERE unique_id = '$logout_id'");
            if($sql){
                session_unset();
                session_destroy();
                header("location: /chat-app/form/login.php"); // quay về trang login
            }
        }else{ // nếu không thì vẫn ở lại trang list người dùng
            header("location: /chat-app/form/users-list-page.php");
        }
    }else{ //otherwise come to login page
        header("location: /chat-app/form/login.php");
    }
?>