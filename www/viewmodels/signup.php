<?
include '../models/db/querys.php';



$member_id = $_POST['member_id'];

$member_hospital_name = $_POST['member_hospital_name'];

$member_name = $_POST['first_name'].",".$_POST['last_name'];

$member_pass = $_POST['member_pass'];

$postcode = $_POST['postcode'];

$address1 = $_POST['address1'];

$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$address4 = $_POST['address4'];
$address5 = $_POST['address5'];
$country = $_POST['country'];
//$member_email = $_POST['member_email'];

//$email_domain = $_POST['email_domain'];

$phone_country_code = $_POST['phone_country_code'];
$contact_number = $phone_country_code." ".$_POST['contact_number'];

//$license_number = $_POST['license_number'];

$moblile_country_code = $_POST['moblile_country_code'];
$phone_number = $moblile_country_code." ".$_POST['phone_number'];

$marketing = $_POST['marketing'];
$marketing = $marketing ? $marketing : 'N';

$signup_values = [];
$signup_values['ACCDRID'] = 0; //최초 가입시 0
$signup_values['LOGINID'] = $member_id;
$signup_values['LOGINPW'] = $member_pass;
$signup_values['PARENTID'] = 0; //최초 가입시 0
$signup_values['DOCTORID'] = 0; //최초 가입시 0
$signup_values['DRNAME'] = $member_name;
$signup_values['H_NAME'] = $member_hospital_name;
$signup_values['PHONE'] = $contact_number;
$signup_values['MOBILE'] = $phone_number;
$signup_values['EMAIL'] = $member_id;
$signup_values['LICENSENUM'] = 1;
$signup_values['COUNTRYID']= $country; //국가id
$signup_values['STNAME'] = $member_name;
$signup_values['ROLE'] = "Admin";
$signup_values['ADDRID']= 0; //최초 가입시 0
$signup_values['ADDNAME'] = $member_hospital_name;
$signup_values['ADD1'] = $address1;
$signup_values['ADD2'] = $address2;
$signup_values['ADD3'] = $address3;
$signup_values['ADD4'] = $address4;
$signup_values['ZIPOCODE'] = $postcode;
$signup_values['STAFFID']= 0; //최초 가입시 0
//$signup_values['MIDUFUED_DT'] = date("Y-m-d H:i:s");
$signup_values['SETTING']  = null;


$CLINICSETTING['numbering_option'] = "fdi";
$CLINICSETTING['passive_aligner'] = "Y";

$CLINICSETTING['maxillary_tooth_alignment'] = "based_gingival";
$CLINICSETTING['based_gingival'] = "arrange_the_lateral";
$CLINICSETTING['ipr_option'] = "apply";

$CLINICSETTING['cutting_appliances'] = "cut_aligner";
$CLINICSETTING['overcorrection_chain'] = "not_apply";

$CLINICSETTING['virtual_teeth'] = "full_size";
$CLINICSETTING['extraction_cases'] = "";
$CLINICSETTING['posterior_teeth'] = "";

$CLINICSETTING['arch_expansion'] = "canine";

$CLINICSETTING['when_shipping'] = "5_appliances";
$CLINICSETTING['special_instructions'] = "";

$CLINICSETTING['permanent_teeth'] = "apply";
$CLINICSETTING['primary_teeth'] = "not_apply";

$CLINICSETTING['teeth_to_expand'] = "expansion_permanent_teeth";
$CLINICSETTING['arch_expansion_primary_teeth'] = "primary_teeth_3";




  $CLINICSETTING_JSON = json_encode($CLINICSETTING);
 // echo $result;

$signup_values['CLINICSETTING'] = $CLINICSETTING_JSON;

$signup_values['TOSYN']  = 'Y';            // 이용약관동의      Y or N
$signup_values['PERSONAL']  = 'Y';      //  개인정보 수집동의
$signup_values['THIRDPERSON'] = 'Y';    // 제3자 제공 동의  
$signup_values['MARKETING']  = $marketing;     // 마케팅 정보수신



//var_dump( $signup_values );

$result = sign_Up($signup_values);
//echo $result;
echo "<script>location.href = '../views/signup_result.php'</script>";


?>