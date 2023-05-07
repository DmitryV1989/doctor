<?
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `patient`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arPatient[$row['id']] = $row;
}

if(isset($_POST['save'])) {
    $name = check($_POST['patient_name']);
    $sqlResult = mysqli_query($CORE['CONFIG']['DB'],"INSERT INTO `patient` VALUES (
        0,
        '".$name."',
        '".$_POST['pers_numb']."',
        '".$_POST['birth']."',
        '".$_POST['sex']."',
        NOW()
    );");
    if($sqlResult){
        // p("запись внесена");
        header("Location: /");
    }
    else {
        p("запись не внесена");
    }
}


require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/reg/template.php";
?>