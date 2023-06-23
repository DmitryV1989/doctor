<?

switch(@$_GET['code']) {

    // страница редактирования пациента
    case 'edit':
        {
            if (!empty($_POST['CODE']) && $_POST['CODE'] == 'edit_patient') {
                $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "UPDATE `patient` SET 
                `name` = '" . $_POST['patient_name'] . "',
                `pers_numb` = '" . $_POST['pers_numb'] . "',
                `DOB` = '" . $_POST['birth'] . "',
                `sex` = '" . $_POST['sex'] . "'
                WHERE `id` = " . $_GET['id']);
                header("Location: /profile?id=" . $_GET['id']);
            }

            $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "SELECT * FROM `patient` WHERE `id`= " . $_GET['id']);
            while ($row = mysqli_fetch_assoc($sqlResult)) {
                foreach (scandir($_SERVER['DOCUMENT_ROOT'] . $CORE['CONFIG']['PATIENT_PHOTO_PATH']) as $filename) {
                    if (explode('.',$filename)[0] == $_GET['id']) {
                        $row['patient_photo'] = $CORE['CONFIG']['PATIENT_PHOTO_PATH']. $filename;
                        break;
                    }
                }
                $arPatient = $row;
            }

            require_once ($_SERVER['DOCUMENT_ROOT']) . "/core/dev/block/reg/template_edit.php";
        }
        break;

    // удаление пациента 
    case 'delete':
        {
            $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "DELETE FROM `patient` WHERE `id`=" . $_GET['id']);
            $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "DELETE FROM `history` WHERE `patient_id`=" . $_GET['id']);
            header("Location: /");
        }
        break;

    // страница регистрации пациента
    default: {
        // 2 из 2. Запрос на создание пациента
        if (!empty($_POST['CODE']) && $_POST['CODE'] == 'create_patient') {
            $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "INSERT INTO `patient` VALUES (
                0,
                '" . $_POST['patient_name'] . "',
                '" . $_POST['pers_numb'] . "',
                '" . $_POST['birth'] . "',
                '" . $_POST['sex'] . "',
                NOW()
            );");
            $insert_id = mysqli_insert_id($CORE['CONFIG']['DB']);


            // приём фото пациента
            if (!empty($_FILES)) {

                // путь загружаемой фотографии
                $patient_photo_file = $_FILES[array_key_first($_FILES)];
                $image_path = $_SERVER['DOCUMENT_ROOT'] . $CORE['CONFIG']['PATIENT_PHOTO_PATH'] . $patient_photo_file['name'];

                // проверка на минимальный размер
                list($tmp_width, $tmp_height) = getimagesize($patient_photo_file['tmp_name']);
                if($tmp_width < $CORE['LIST']['photo']['min_width'] OR $tmp_height < $CORE['LIST']['photo']['min_height']) {
                    p("Разрешение картинки должно быть выше чем ".$CORE['LIST']['photo']['min_width']."x".$CORE['LIST']['photo']['min_height']." px");
                    header("Location: /reg");
                    die;
                }

                // загрузка фотографии
                move_uploaded_file($patient_photo_file['tmp_name'], $image_path);

                // проверка и приведение к максимально допустимому размеру
                list($uploaded_width, $uploaded_height, , , ,$mime_type) = array_values(getimagesize($image_path));
                if($uploaded_width > $CORE['LIST']['photo']['limit_width'] OR $uploaded_height > $CORE['LIST']['photo']['limit_height']) {
                    list($ready_width, $ready_height) = array_values(prop_resize_min(
                        $uploaded_width, $uploaded_height, $CORE['LIST']['photo']['limit_width'], $CORE['LIST']['photo']['limit_height']));
                    new_image_create($image_path, $uploaded_width, $uploaded_height, $ready_width, $ready_height, $mime_type);
                }
            }
            header("Location: /profile?id=".$insert_id);
        }

        // 1 из 2. Страница регистрации пациента
        require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/reg/template_add.php";
    } break;
}
?>
