<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$update = mysqli_query($connect, "UPDATE something SET title='{$_GET['title']}', description='{$_GET['description']}', img='{$_GET['img']}' WHERE id='{$_GET['id']}'");
	header('Location: acc.php');
?>