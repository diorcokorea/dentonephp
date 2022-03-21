<?

$filename = $_GET['src'];

?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<a class="basiccolor" id="btn_save_img" download href="<?=$filename?>" style="" target="_blank">저장</a>

<script>
$(document).ready(function(){
	$("#btn_save_img").get(0).click();
	window.close();
	});
     
</script>