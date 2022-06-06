<?php
    while($row = mysqli_fetch_assoc($sql)){

        // hiện tin nhắn chưa đọc
        $sql2 = "SELECT *
                FROM messages 
                WHERE (incoming_msg_id = {$row['unique_id']} 
                OR outgoing_msg_id = {$row['unique_id']}) 
                AND (outgoing_msg_id = '$outgoing_id' 
                OR incoming_msg_id = '$outgoing_id') 
                ORDER BY msg_id 
                DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        // var_dump($query2);
        // die();
        // var_dump($row2);

        if(mysqli_num_rows($query2) > 0){
            // access to the value of 'msg'
            $result = $row2['msg'];
        }else{
            $result = " ";
        }

        // ẩn đoạn sau tin nhắn nếu tin nhắn dài quá 28 kí tự
        if(strlen($result) > 28){
            $msg = substr($result, 0, 28);
        }else{
            $msg = $result;
        }
        // Thêm "You: " vào tin nhắn vừa gửi bởi người dùng hiện tại
        // if(($row2['outgoing_msg_id'])>0){
        //      ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        // }
        // var_dump($row2['outgoing_msg_id']);

        //check if user is active or not
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        $output .= ' <a href="../form/chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="../php/'. $row['img'] .'" alt="">
                             <div class="details">
                                <span>'. $row['fname']." ".$row['lname'] .'</span>
                                <p>'. $msg .'</p>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </a>';
    }
?>