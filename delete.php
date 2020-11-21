<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$delete = mysqli_query($connect, "DELETE FROM something WHERE id={$_GET['id']}");
	header('Location: acc.php');
?>