<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$insert = mysqli_query($connect, "INSERT INTO something (title, description, goal, donated, img, place, user) VALUES ('{$_GET['title']}', '{$_GET['description']}', '{$_GET['goal']}', 0, '{$_GET['img']}', '{$_GET['place']}', '{$_GET['user']}')");
	header('Location: acc.php')
?>