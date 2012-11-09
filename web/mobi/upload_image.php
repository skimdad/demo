<?

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['crop_submit']) && (!empty($_POST['image_type']))) {
    if ((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
        $type = $_FILES["image"]["type"];
        $file_name = $_FILES["image"]["name"];
        $image_path = EDIRECTORY_ROOT . "/mobi/uploded_images/" . $file_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

        switch ($type) {
            case 'image/gif': $img_type = 'gif';
                $img_r = imagecreatefromgif($image_path);
                break;

            case 'image/jpeg': $img_type = 'jpeg';
                $img_r = imagecreatefromjpeg($image_path);
                break;

            case 'image/x-png': $img_type = 'png';
                $img_r = imagecreatefrompng($image_path);
                break;

            case 'image/png': $img_type = 'png';
                $img_r = imagecreatefrompng($image_path);
                break;
        }
        if (!empty($img_type)) {
            //generate custom name
            $screen_name = (empty($_GET['screen'])) ? 'fav_icon' : $_GET['screen'];
            if (strpos($_SERVER["PHP_SELF"], '/mobileappsettings.php')) {
                $file_name_to_save = $file_name;
            } else {
                $file_name_to_save = 'cropped_' . $_GET['id'] . '_' . $screen_name . '.' . $img_type;
            }


            $dst_r = imagecreatetruecolor($_POST['w'], $_POST['h']);

            if ($img_r) {

                if ($img_type == "png" || $img_type == "gif") {
                    imagealphablending($dst_r, false);
                    imagesavealpha($dst_r, true);
                    $transparent = imagecolorallocatealpha($dst_r, 255, 255, 255, 127);
                    imagefill($dst_r, 0, 0, $transparent);
                    imagecolortransparent($dst_r, $transparent);
                }

                if ($img_type == "gif") { //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
                    //low quality
                    imagecopyresized($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'], $_POST['h']
                    );
                } else {
                    //better quality
                    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'], $_POST['h']
                    );
                }
            }

            $crop_image = EDIRECTORY_ROOT . "/mobi/uploded_images/" . $file_name_to_save;
            if ($img_type == 'gif') {
                imagegif($dst_r, $crop_image);
            } elseif ($img_type == 'jpeg') {
                imagejpeg($dst_r, $crop_image);
            } elseif ($img_type == 'png') {
                imagepng($dst_r, $crop_image);
            }
        } else {
            $image_upload_error = 'unknown image type';
        }
    } else {
        if (!empty($_FILES['image']['error'])) {

            switch ($_FILES['image']['error']) {
                case 1:
                    $image_upload_error = 'The uploaded file exceeds the upload max filesize';
                    break;
                case 2:
                    $image_upload_error = 'The uploaded file exceeds the upload max filesize';
                    break;
                case 3:
                    $image_upload_error = 'The uploaded file was only partially uploaded';
                    break;
                case 4:
                    $image_upload_error = 'No file was uploaded';
                    break;

                default:
                    $image_upload_error = 'something went wrong, please try again latter';
                    break;
            }
        }
    }
}
?>   