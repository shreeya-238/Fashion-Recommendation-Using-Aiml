<?php


require('../inc/db_config.php');
require('../inc/essentials.php');




if (isset($_POST['info-form'])) {
    $frm_data = filteration($_POST);
    session_start();

    // ✅ Execute the query properly
    $stmt = $con->prepare("SELECT * FROM `user` WHERE `phonenum`=? AND `sr_no`!=? LIMIT 1");
    $stmt->bind_param("ss", $frm_data['phonenum'], $_SESSION['uId']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        echo 'phone_already';
        exit;
    }

    // ✅ Correct the UPDATE query
    $query = "UPDATE `user` SET `name`=?, `phonenum`=?, `gender`=?, `dob`=? WHERE `sr_no`=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssss", $frm_data['name'], $frm_data['phonenum'], $frm_data['gender'], $frm_data['dob'], $_SESSION['uId']);
    
    if ($stmt->execute()) {
        $_SESSION['uName'] = $frm_data['name'];
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $con->close();
}




if (isset($_POST['profile-form'])) {
    session_start();

    if (!isset($_SESSION['uId'])) {
        echo 'session_error';
        exit;
    }

    error_log("User ID: " . $_SESSION['uId']); // Check if session ID is set

    if (!isset($_FILES['profile']) || $_FILES['profile']['error'] !== UPLOAD_ERR_OK) {
        echo 'file_upload_error';
        exit;
    }

    // Upload image
    $img = uploadUserImage($_FILES['profile']);
    error_log("Uploaded Image: " . $img); // Log image name

    if ($img == 'inv_img') {
        echo 'Invalid Image';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'Upload Failed';
        exit;
    }

    // Check existing profile image
    $u_exist = select("SELECT `profile` FROM `user` WHERE `sr_no`=?", [$_SESSION['uId']], "s");

    if (!$u_exist || mysqli_num_rows($u_exist) == 0) {
        echo 'user_not_found';
        exit;
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);
    error_log("Old Profile Image: " . $u_fetch['profile']); // Log old profile

    if (!empty($u_fetch['profile'])) {
        deleteImage($u_fetch['profile'], USER_FOLDER);
    }

    // Update new profile image in the database
    $query = "UPDATE `user` SET `profile`=? WHERE `sr_no`=?";
    $values = [$img, $_SESSION['uId']];

    if (update($query, $values, "ss")) {
        $_SESSION['uPic'] = $img;
        error_log("Profile Updated Successfully: " . $_SESSION['uPic']); // Log session update
        echo 'success';
    } else {
        echo 'db_update_error';
    }
}
