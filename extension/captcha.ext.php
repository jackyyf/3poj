<?php

if(!defined("_IN_3POJ"))die();

function displayCaptcha(){
?>
<tr><td>BOT CHECK:</td><td><input type="text" id="captcha" name="captcha" maxlength="5" /></td><td><a href="#" onclick="document.getElementById('captchaimg').src=document.getElementById('captchaimg').src" ><img id="captchaimg" src="/extension/captcha/captcha.img.php" alt="Click to refresh" /></a></td></tr>
<?php
}

function checkCaptcha(){
	if(strtoupper($_POST['captcha']) != strtoupper(Session::get("captcha"))){
?>
<script language="javascript" type="text/javascript">
window.alert("Captcha doesn't match!");
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php
		die();
	}
}

Event::addHook("onsubmit", "checkCaptcha");
Event::addHook("onlogin", "checkCaptcha");
Event::addHook("onregister", "checkCaptcha");
Event::addHook("onsubmitform", "displayCaptcha");
Event::addHook("onloginform", "displayCaptcha");
Event::addHook("onregisterform", "displayCaptcha");
?>