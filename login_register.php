<?php
require('../inc/db_config.php');
require('../inc/essentials.php');





if (isset($_POST['register'])) {
    error_log("Register request received");

    $data = filteration($_POST);

    // matching passwords
    if ($data['pass'] != $data['cpass']) {
        error_log("Password mismatch");
        echo 'Mismatched Password';
        exit;
    }

    // check if user exists
    $u_exist = select("SELECT * FROM `user` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        error_log("User already exists: " . json_encode($u_exist_fetch));
        echo ($u_exist_fetch['email'] == $data['email']) ? 'Email_already' : 'Phone_already';
        exit;
    }

    // Upload user image
    $img = uploadUserImage($_FILES['profile']);
    if ($img == 'inv_img') {
        error_log("Invalid image format");
        echo 'Invalid Image';
        exit;
    } else if ($img == 'upd_failed') {
        error_log("Image upload failed");
        echo 'Upload Failed';
        exit;
    }

    // Encrypt password
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    error_log("Password encrypted successfully");

    // Insert user into database
    $query = "INSERT INTO `user` (`name`, `email`, `phonenum`, `profile`, `gender`, `dob`, `password`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $values = [
        $data['name'],
        $data['email'],
        $data['phonenum'],
        $img,
        $data['gender'],
        $data['dob'],
        $enc_pass
    ];

    $result = insert($query, $values, "sssssss");

    if ($result) {
        error_log("Data inserted successfully");
        echo "success";
    } else {
        error_log("Insert failed: " . mysqli_error($conn)); // Check MySQL errors
        echo "ins_failed";
    }
}



// login 


if (isset($_POST['login'])) {
    session_start(); // Start session at the beginning
    $data = filteration($_POST);

    // Query to check if user exists by email or phone number
    $u_exist = select("SELECT * FROM `user` WHERE `email`=? OR `phonenum`=? LIMIT 1", 
                      [$data['email_mob'], $data['email_mob']], "ss");

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob'; // Invalid email or phone
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);

        // Check if password is correct
        if (!password_verify($data['pass'], $u_fetch['password'])) {
            echo 'invalid_pass'; // Incorrect password
        } else {
            // Store user details in session
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $u_fetch['sr_no'];
            $_SESSION['uName'] = $u_fetch['name'];
            $_SESSION['uPhone'] = $u_fetch['phonenum'];

            // Check if profile picture exists, else assign default
            $_SESSION['uPic'] = (!empty($u_fetch['profile'])) ? $u_fetch['profile'] : 'default.png';

            echo 1; // Success response
        }
    }
}





?>