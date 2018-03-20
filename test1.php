<?php
if(isset($_POST['img1']))
{
	
	$path = $_FILES['img']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$name = "admin/images_pro/user/".md5(microtime(true)).".".$ext;
	move_uploaded_file($_FILES['img']['tmp_name'],$name);
}
?>

<form enctype="multipart/form-data" method="post">
	<input type="file" name="img" />
	<input type="submit" name="img1" >
</form>