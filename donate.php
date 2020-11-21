<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$donate = mysqli_query($connect, "UPDATE something SET donated = donated + 10 WHERE id={$_POST['id']}");
	header('Location: index.php');
?>