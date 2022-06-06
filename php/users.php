<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    // sử dụng where not để bỏ phần chat với chính ngườI dùng
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = '$outgoing_id'");
    $output = "";
    // var_dump(mysqli_num_rows($sql));
    // die();
    // if(mysqli_num_rows($sql) == 1){
    //     $output .= "No users are available to chat"; // Nếu chỉ có 1 hàng trong database thì chứng tỏ chỉ có 1 người đăng nhập duy nhất là ta 
    // }else if(mysqli_num_rows($sql) > 0){
    //     include_once "data.php";
    // }

    if (mysqli_num_rows($sql) > 0){
        include_once "data.php";
    }
    echo $output;
?>