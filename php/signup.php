<?php  
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // check xem email hợp lệ ko
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // nếu email hợp lệ
            // check xem email đăng kí đã tồn tại trong database chưa
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            // var_dump($sql);
            // var_dump(mysqli_num_rows($sql));
            // die();
            if(mysqli_num_rows($sql) > 0){ // nếu email đăng kí đã tồn tại
                echo "$email already existed!";
            }else{
                // bắt đầu up file ảnh lên 

                if(isset($_FILES['image'])){ // nếu đã up file
                    $img_name = $_FILES['image']['name']; //lấy tên file
                    $tmp_name = $_FILES['image']['tmp_name']; // lấy đường dẫn tạm thời lưu trên server
                    // lấy đuôi file
                    
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); //lấy đuôi file
                    $extensions = ['png', 'jpeg', 'jpg']; //các đuôi file ảnh
                    if(in_array($img_ext, $extensions) === true){ // nếu ảnh người dùng up lên có đuôi giống với đuôi đã cho
                        $time = time(); //thêm thời gian vào tên file
                        
                        // đưa ảnh đã up lên vào thư mục trong server
                        $new_img_name = "images/".$time.$img_name;
                        
                        if(move_uploaded_file($tmp_name, $new_img_name)){ // nếu ảnh up lên đã được đưa vào server
                            $status = "Active now";
                            $random_id = rand(time(), 10000000); // tạo random user_id

                            // thêm dữ liệu người dùng nhập form đăng kí vào bảng trong database
                            $sql = "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                        VALUES ('$random_id', '$fname', '$lname', '$email', '$password', '$new_img_name', '$status')";
                            $sql2 = mysqli_query($conn, $sql);

                            if($sql2){ // nếu hoàn tất việc thêm dữ liệu
                                $sql = "SELECT * FROM users WHERE email = '$email'";                               
                                $sql3 = mysqli_query($conn, $sql);
                                // var_dump($sql3); 
                                // var_dump(mysqli_num_rows($sql3));
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    // var_dump($row);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    // $_SESSION['status'] = $row['status'];
                                    // var_dump($_SESSION['unique_id']);
                                    // var_dump($_SESSION['status']);
                                    // die();
                                    echo "Success!";
                                }else{
                                    echo "Something went wrong!";
                                }
                            }
                        }
                    }else{ 
                        echo "Please select an image file (jpeg, jpg, png only)!";
                    } // kết thúc việc kiểm tra đuôi file ảnh

                }else{
                    echo "Please select an image to set your avatar!";
                } // Kết thúc việc kiểm tra xem đã up ảnh lên chưa
            } // kết thúc việc up file ảnh
        }else{
            echo "$email is not valid!";
        } // Kết thúc việc kiểm tra email có hợp lệ hay ko  

        // check 
    }else{
        echo "All field are required!";
    }
?>