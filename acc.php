<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<?php
	$connect = mysqli_connect("127.0.0.1", "root", "root", "something");
	$select = mysqli_query($connect, "SELECT * FROM something WHERE user='John Carmack'");
	$num = mysqli_num_rows($select)
?>
<div class="col-12">
	<div class="row">
		<div class="col-2 pt-3">
			<a href="index.php" class="text-dark ml-3">Explore</a>
			<a href="" class="text-dark ml-3">Start a project</a>
		</div>
		<div class="col-8 text-center">
			<img src="img/logo.png" class="w-25">
			<p>#BlackLivesDontMatter</p>
		</div>
		<div class="col-2 text-left pt-3">
			<a href="" > <i class="fa fa-search"></i> Search</a>
			<a href=""><img src="img/lk.png" class="rounded-circle" ></a>
		</div>
	</div>
</div>
<div class="col-10 mx-auto">
	<form class="col-6 mx-auto" action="insert.php" method="GET">
		<input type="" class="form-control" placeholder="Название" name="title">
		<textarea type="text" class="form-control" placeholder="Описание" name="description"></textarea>
		<input type="" class="form-control" placeholder="Целевая сумма" name="goal">
		<input type="" class="form-control" placeholder="Обложка" name="img">
		<input type="" class="form-control" placeholder="Местоположение" name="place">
		<input type="" class="form-control" placeholder="Имя" name="user">
		<div class="text-center mt-2 mb-5"><button class="btn btn-success">Добавить проект</button></div>
	</form>
	<h4 class="text-center">My <span class="text-success font-weight-bold"><?php echo $num ?> projects<!--Вывести количество проектов--></span></h4>
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
				<!--редактирование и удаление-->
				<button class="edit-btn btn btn-success">Редактировать проект</button>
				<button class="cancel-edit-btn btn btn-danger" style="display: none;">Отменить редактирование</button>
				<form action="update.php" method="GET" class="edit-form mt-3" style="display: none;">
					<input type="" name="id" value="<?php echo $project['id'] ?>" style="display: none;">
					<input type="" name="title" value="<?php echo $project['title'] ?>" class="form-control" placeholder="Название">
					<input type="" name="description" value="<?php echo $project['description'] ?>" class="form-control" placeholder="Описание">
					<input type="" name="img" value="<?php echo $project['img'] ?>" class="form-control" placeholder="Картинка">
					<button class="btn btn-success mt-3">Редактировать</button>
				</form>
				<form action="delete.php" method="GET" class="delete-form mt-3">
					<input type="" name="id" value="<?php echo $project['id'] ?>" style="display: none;">
					<button class="btn btn-danger">Удалить запись</button>
				</form>
				<!---->
				<h1 class="text <?php
					if($project['donated']>=$project['goal']) {
						echo "text-success";
					}
					else {
						echo "text-dark";
					}
				 ?>"><?php echo $project['goal'] ?>$ goal</h1>
				<h1 class="text text-success"><?php echo $project['donated'] ?>$ donated</h1>
				<form action="donate2.php" method="POST">
					<input type="" name="id" value="<?php echo $project['id'] ?>" style="display: none">
					<input type="" name="donate" value="<?php echo $project['donated'] ?>" style="display: none">
					<button class="btn btn-success mb-3">Back this project - 10$</button>
				</form>
			</div>
		<?php		
			}
		?>
	</div>
</body>
<script type="text/javascript">
	let cords = ['scrollX','scrollY']
	window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]))
	window.scroll(...cords.map(cord => localStorage[cord]))
</script>
<script type="text/javascript">
	let editBtn = document.querySelectorAll('.edit-btn')
	let cancelEditBtn = document.querySelectorAll('.cancel-edit-btn')
	let editForm = document.querySelectorAll('.edit-form')
	let deleteForm = document.querySelectorAll('.delete-form')
	for(let i=0; i<<?php echo $num ?>; i++) {
		editBtn[i].onclick = function() {
			editBtn[i].style.display = 'none'
			cancelEditBtn[i].style.display = 'block'
			editForm[i].style.display = 'block'
			deleteForm[i].style.display = 'none'
			cancelEditBtn[i].onclick = function() {
				editBtn[i].style.display = 'block'
				cancelEditBtn[i].style.display = 'none'
				editForm[i].style.display = 'none'
				deleteForm[i].style.display = 'block'
			}
		}
	}
</script>
</html>