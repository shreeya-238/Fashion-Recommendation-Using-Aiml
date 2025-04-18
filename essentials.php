<?php

 


// frontend image upload process
define('SITE_URL', 'http://127.0.0.1/fashion');
define('USER_IMG_PATH', SITE_URL . '/images/users/');




// backend image process
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/fashion/images/');
define('USER_FOLDER', 'users/');

function redirect($url)
{
    echo "
    <script>window.location.href='$url'</script>;
    ";
    exit;
}


function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<ALERT
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert" >
            <strong class="me-3">$msg</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ALERT;
}

function uploadImage($images, $folder)
{
    $valid_mine = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mine = $images['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_image';
    } else if (($images['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($images['name'], PATHINFO_EXTENSION);
        $rname = 'IMG' . random_int(11111, 99999) . ".$ext";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($images['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'inv_upload';
        }
    }
}

function deleteImage($image, $folder)
{
    $image_path = UPLOAD_IMAGE_PATH . $folder . $image;

    // Debug: Check file existence before deletion
    if (!empty($image) && file_exists($image_path) && !is_dir($image_path)) {
        if (unlink($image_path)) {
            return true;
        } else {
            return false;
        }
    }
    return false; // File does not exist or is a directory
}

function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg', 'image/png'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_image';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG' . random_int(11111, 99999) . "." . $ext;
        $img_path = UPLOAD_IMAGE_PATH . USER_FOLDER . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'inv_upload';
        }
    }
}


?>