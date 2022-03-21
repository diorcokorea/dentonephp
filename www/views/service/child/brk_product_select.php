<?
session_start();
include_once("../../models/db/querys.php");

$product_key = $_POST['brk_product_id'];
$checked = $_POST['checked'];

//$product_json = bracket_r($lab_key,"B");
echo bracketNO_r($product_key, $checked);

?>