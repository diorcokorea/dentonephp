<?
session_start();
include_once("../../models/db/querys.php");

$lab_key = $_POST['brk_dental_lab_id'];
$checked = $_POST['checked'];

//$product_json = bracket_r($lab_key,"B");

echo bracketJson_r($lab_key,$checked);

?>