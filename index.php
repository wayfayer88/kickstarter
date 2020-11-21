<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$select = mysqli_query($connect, "SELECT * FROM something");
	$num = mysqli_num_rows($select)
?>
<div class="col-12">
	<div class="row">
		<div class="col-2 pt-3">
			<a href="" class="text-dark ml-3">Explore</a>
			<a href="" class="text-dark ml-3">Start a project</a>
		</div>
		<div class="col-8 text-center">
			<img src="img/logo.png" class="w-25">
			<p>#BlackLivesDontMatter</p>
		</div>
		<div class="col-2 text-left pt-3">
			<a href="" > <i class="fa fa-search"></i> Search</a>
			<a href="acc.php"><img src="img/lk.png" class="rounded-circle" ></a>

		</div>
	</div>
</div>
<div class="col-10 mx-auto">
	<h4 class="">Explore <span class="text-success font-weight-bold"><?php echo $num ?> projects<!--Вывести количество проектов--></span></h4>
	<p></p>
	<div class="row mt-5">

		<!--Вывести сами проекты здесь-->
		<?php
			for($i=0;$i<$num;$i++) {
				$project = $select->fetch_assoc()
		?>
			<div class="col-4 rounded border border-secondary mb-5">
				<img src="<?php echo $project['img'] ?>" class="w-100 my-3">
				<h1 class="text text-secondary"><?php echo $project['title'] ?></h1>
				<p class="text"><?php echo $project['description'] ?></p>
				<p class="mt-5"><?php echo $project['place'] ?></p>
				<h1 class="text <?php
					if($project['donated']>=$project['goal']) {
						echo "text-success";
					}
					else {
						echo "text-dark";
					}
				 ?>"><?php echo $project['goal'] ?>$ goal</h1>
				<h1 class="text text-success"><?php echo $project['donated'] ?>$ donated</h1>
				<form action="donate.php" method="POST">
					<input type="" name="id" value="<?php echo $project['id'] ?>" style="display: none">
					<input type="" name="donate" value="<?php echo $project['donated'] ?>" style="display: none">
					<button class="btn btn-success mb-3">Back this project - 10$</button>
				</form>
			</div>
		<?php		
			}
		?>
	</div>

</div>
</body>
<script type="text/javascript">
	let cords = ['scrollX','scrollY']
	window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]))
	window.scroll(...cords.map(cord => localStorage[cord]))
</script>
</html>