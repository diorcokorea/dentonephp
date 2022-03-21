
 
<div class="captcha_box">
<?
include_once('../models/naverCaptchaAPI/image_key_issuance.php');
//include_once('../models/naverCaptchaAPI/radio_key_issuance.php');
?>
<img id="img_captcha" src='../views/captcha.jpg'>
 
<!-- <p id="radio_captcha" style="display:none;">Now playing.</p> -->
<input type="hidden" name="captcha" id="captcha">
<input type="hidden" name="image_key" id="image_key" value=<? echo $image_key ?>>
<!-- <input type="hidden" name="radio_key" id="radio_key" value=<? echo $radio_key ?> disabled> -->
<div class="form-group" style="margin:0px;">
<button id="btn_img" type="button" value="Image" onClick="imageCaptcha();" style="display:none;border-radius:0">Image</button>
<!-- <button id="btn_radio" type="button"  value="Voice" onClick="radioCaptcha();" style="border-radius:0">Voice</button> -->
<button type="button" value="Refresh" onClick="window.location.reload();" style="border-radius:0 margin-bottom:10px;" style="">Refresh</button>

<input class="form-control-sign_up" type="text" name="captcha_result" id="captcha_result" value="" placeholder="Plase enter the answer." style="margin-top:5px" >
<div class="form-control-sign_up-border"></div>
</div>
<p class='check_text' id="ch_result_null" style="display:none;padding:5px 0">Plase enter the answer.</p>
</div>
