<?
// @LUCAS 1.5 이메일에서 버튼을 누르면
//이 페지를 통해서 patientServiceInfo.php 로 이동한다.
//ini_set("display_errors" , "1");
$patientkey = $_GET['patientkey'];
$patientServiceKey = $_GET['patientServiceKey'];
?>
<form name="key_form" id="key_form" method="POST" action="/views/patientprofile.php">
    <input type="hidden" id="patientkey" name="patientkey" value="<?= $patientkey ?>" />
    <input type="hidden" id="patientServiceKey" name="patientServiceKey" value="<?= $patientServiceKey ?>" />
</form>
<script>
    document.getElementById("key_form").submit();
</script>
