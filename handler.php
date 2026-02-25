<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require "function.php";

/* Sanitize inputs */
$PLname = trim($_POST['PLname'] ?? '');
$PFname = trim($_POST['PFname'] ?? '');
$Bdate = $_POST['Bdate'] ?? '';
$Gender = $_POST['Gender'] ?? '';
$tel = trim($_POST['PHnum'] ?? '');
$Cdate = $_POST['Cdate'] ?? '';
$Creason = trim($_POST['Creason'] ?? '');
$temp = isset($_POST['temp']) ? floatval($_POST['temp']) : 0;

$pressure = $_POST['pressure'] ?? [];
$systolic = isset($pressure[0]) ? intval($pressure[0]) : 0;
$diastolic = isset($pressure[1]) ? intval($pressure[1]) : 0;

$weight = isset($_POST['weight']) ? floatval($_POST['weight']) : 0;
$height = isset($_POST['height']) ? floatval($_POST['height']) : 0;

$Symptoms = $_POST['symptoms'] ?? [];

/* Calculations */
$age = calculAge($Bdate);
$BMI = calculIMC($weight, $height); 

/* Generate Unique ID */
$id = uniqid("PAT_");

/* Prepare arrays */
$Pinfo = [$id, $PLname, $PFname, $Bdate, $Gender, $tel, $age];
$Cinfo = [$Cdate, $Creason, $temp, $systolic, $diastolic, $weight, $height, $BMI, $Symptoms];

/* Validate */
$errors = validateConsultation(
    $PLname,
    $PFname,
    $Bdate,
    $tel,
    $Cdate,
    $Creason,
    $temp,
    $systolic,
    $diastolic,
    $weight,
    $height
);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: add.php");
    exit;
}

/* Save */
$ALLinfo = [$Pinfo, $Cinfo];
ADDinfo($ALLinfo);


/* Redirect */
header("Location: index.php");
exit;
?>
