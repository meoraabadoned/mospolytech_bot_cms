<?php

define('ADMIN_PASSWORD', '123456'); // Пароль админа

session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/*
  Возвращает экземпляр класса для работы с БД
 */
function getDb()
{
	static $mysqli;

	if (is_null($mysqli))
	{
		$mysqli = new mysqli('std-mysql','std_320','meowmeow', 'std_320');
		if (mysqli_connect_errno())
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	}

	return $mysqli;
}

/**
 * Выводит "шапку" страницы
 *
 * @param string $title Заголовок страницы
 */
function viewHeader($title)
{
?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
	<link rel="stylesheet" href="Log.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<title><?php echo $title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<?php
}

if (!isset($_SESSION['Admin_Password']) || $_SESSION['Admin_Password'] != ADMIN_PASSWORD)
	$action = 'auth';
elseif (isset($_GET['action']))
	$action = trim($_GET['action']);
else
	$action = '';

switch ($action)
{
	case 'auth':
		if (isset($_POST['cool']))
		{
			$l_Password= trim($_POST['password']);
			if ($l_Password == ADMIN_PASSWORD)
			{
				$_SESSION['Admin_Password']= ADMIN_PASSWORD;
				header("Location: /admin.php");
			}
			else
			{
				$error = 'Неверный пароль';
			}
		}
		viewHeader('Страница входа в админку');
		?>
		<body class="text-center">
			<form method="post" class="form-signin">
			  <img class="mb-4" src="polytech.png" alt="polytech logo" width="320" height="140">
			  <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
			  <h1 class="h3 mb-3 font-weight-normal">Авторизируйтесь</h1>
			  <label for="password" class="sr-only">Пароль:</label>
			  <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
			  <button class="btn btn-dark btn-block" name="cool" type="submit">Войти</button>
			  <p class="mt-5 mb-4 text-muted">&copy; Московский Политех </p>
			</form>
		</body>
		</html>
		<?php
		break;
	case 'add':
		// Добавление пользователя
		if (isset($_POST['add'])) {
			$salt = 'HOHOHOLOLOLOBOBOBO';
			$errors = array();
			if (empty($_POST['login']))
				$errors['login'] = 'Не введён логин!';
			elseif (!preg_match('/^([a-z0-9_-]{2,20})$/i', $_POST['login']))
				$errors['login'] = 'Логин может содержать буквы латинского алфавита, цифры, символы _, -, а так же быть длиной от 2 до 20 символов!';
			elseif ((getDb()->query('SELECT COUNT(*) as `cnt` FROM `Auth` WHERE `login` = "' . getDb()->escape_string($_POST['login']) . '" LIMIT 1')->fetch_object()->cnt))
				$errors['login'] = 'Пользователь с таким логином уже существует!';

			if (empty($_POST['password']))
				$errors['password'] = 'Не введён пароль!';
			elseif (6 > strlen($_POST['password']))
				$errors['password'] = 'Пароль должен содержать не менее 6 символов!';
				 

			if (empty($errors)) {
				$password = sha1($_POST['password']);
				getDb()->query(
					'INSERT INTO `Auth` ('
					. '`login`, `password`, `status`'
					. ') VALUES ('
					. '"' . getDb()->escape_string($_POST['login']) . '", "' . $password . '", ' . (empty($_POST['status']) ? 0 : 1)
					. ')'
				);
				unset($_POST);
				$success = 'Пользователь успешно добавлен!';
			} else {
				$errors['title'] = 'Ошибка добавления пользователя!';
			}
		}
	case 'edit':
		// Редактирование
		if (isset($_POST['edit'])) {
			$salt = 'HOHOHOLOLOLOBOBOBO';
			$errors = array();
			if (empty($_POST['login']))
				$errors[] = 'Не введён логин!';
			elseif (!preg_match('/^([a-z0-9_-]{2,20})$/i', $_POST['login']))
				$errors[] = 'Логин может содержать буквы латинского алфавита, цифры, символы _, -, а так же быть длиной от 2 до 20 символов!';
			elseif ((getDb()->query('SELECT COUNT(*) as `cnt` FROM `Auth` WHERE `login` = "' . getDb()->escape_string($_POST['login']) . '" AND `id` != ' . intval($_POST['id']) . ' LIMIT 1')->fetch_object()->cnt))
				$errors[] = 'Пользователь с таким логином уже существует!';

			if (empty($_POST['password']) && 6 > strlen($_POST['password'], 'utf-8'))
				$errors[] = 'Пароль должен содержать не менее 6 символов!';

			if (empty($errors)) {
				$password = sha1($_POST['password']);
				getDb()->query(
					'UPDATE `Auth` SET '
					. '`login` = "' . getDb()->escape_string($_POST['login']) . '", '
					. '`status` = ' . (empty($_POST['status']) ? 0 : 1)
					. (!empty($_POST['password']) ? ', `password` = "' . sha1($_POST['password']) . '" ' : ' ')
					. 'WHERE `id` = ' . intval($_POST['id'])
				);
				$success = 'Данные пользователя успешно изменены!';
			} else {
				$errors['title'] = implode('<br>', $errors);
			}
			unset($_POST);
		}
	case 'delete':
		// Удаление
		if (isset($_GET['delete'])) {
			if (getDb()->query('DELETE FROM `Auth` WHERE `id` = ' . intval($_GET['delete'])) && getDb()->affected_rows)
				$success = 'Пользователь успешно удалён!';
			else
				$errors['title'] = 'Ошибка удаления пользователя!';
		}
	default:
		// Вывод формы и пользователей
		$users_count = getDb()->query('SELECT COUNT(*) as `count` FROM `Auth`')->fetch_object()->count;
		if (0 < $users_count) {
			$query = getDb()->query('SELECT `id`, `login`, `status` FROM `Auth` ORDER BY `id` DESC');
		}

		viewHeader('Админка');
		?>
		<body>
			<div class="container">
				<div class="row justify-content-sm-center">
					<form action="?action=add" method="post">
						<?php if (isset($success)): ?>
							<div class="alert alert-success text-center"><?php echo $success; ?></div>
						<?php elseif (!empty($errors)): ?>
							<div class="alert alert-danger text-center"><?php echo $errors['title']; ?></div>
						<?php endif; ?>
						<div class="form-group row">
							<label for="add_login" class="col-sm-4 col-form-label">Логин</label>
							<div class="col-sm-8">
								<input
									type="text"
									name="login"
									id="add_login"
									class="form-control<?php if (!empty($errors['login'])) echo ' is-invalid'; ?>"
									placeholder="Логин"
									value="<?php echo empty($_POST['login']) ? '' : htmlspecialchars($_POST['login'], ENT_QUOTES); ?>"
									required>
								<?php if (!empty($errors['login'])) echo '<div class="invalid-feedback">' . $errors['login'] . '</div>'; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="add_password" class="col-sm-4 col-form-label">Пароль</label>
							<div class="col-sm-8">
								<input
									type="text"
									name="password"
									id="add_password"
									class="form-control<?php if (!empty($errors['password'])) echo ' is-invalid'; ?>"
									placeholder="Пароль"
									value="<?php echo empty($_POST['password']) ? '' : htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"
									required>
								<?php if (!empty($errors['password'])) echo '<div class="invalid-feedback">' . $errors['password'] . '</div>'; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="add_status" class="col-sm-4 col-form-label">Полномочия</label>
							<div class="col-sm-8">
								<select name="status" id="add_status" class="form-control">
									<option value="0"<?php if (empty($_POST['status'])) echo ' selected="selected"'; ?>>Админ</option>
									<option value="1"<?php if (!empty($_POST['status'])) echo ' selected="selected"'; ?>>Модер</option>
								</select>
							</div>
						</div>
						<div class="form-group row justify-content-end">
							<div class="col-sm-8">
								<input type="submit" name="add" class="btn btn-success" value="Добавить пользователя">
							</div>
						</div>
					</form>
				</div>

				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Логин</th>
								<th>Полномочия</th>
								<th>Действие</th>
							</tr>
						</thead>
						<tbody>
						<?php if (0 < $users_count): ?>
						<?php while ($user = $query->fetch_assoc()): ?>
							<tr>
								<td><?php echo $user['login']; ?></td>
								<td><?php echo ($user['status']) ? 'Модер' : 'Админ'; ?></td>
								<td>
									<button
										type="button"
										class="edit btn btn-primary"
										data-toggle="modal"
										data-target="#edit"
										user-id="<?php echo $user['id']; ?>"
										user-login="<?php echo $user['login']; ?>"
										user-status="<?php echo $user['status']; ?>">Редактировать</button>
									<button
										type="button"
										class="delete btn btn-primary"
										data-toggle="modal"
										data-target="#delete"
										user-id="<?php echo $user['id']; ?>"
										user-login="<?php echo $user['login']; ?>">Удалить</button>
								</td>
							</tr>
						<?php endwhile; ?>
						<?php else: ?>
							<tr>
								<td colspan="2" class="text-center">Список пользователей пуст</td>
							</tr>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editTitle">Редактирование</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="/admin.php?action=edit" method="post">
							<div class="modal-body">
								<input type="hidden" name="id" id="edit_id" value="">
								<div class="form-group row">
									<label for="edit_login" class="col-sm-4 col-form-label">Логин</label>
									<div class="col-sm-8">
										<input
											type="text"
											name="login"
											id="edit_login"
											class="form-control"
											placeholder="Логин"
											value=""
											required>
									</div>
								</div>
								<div class="form-group row">
									<label for="edit_password" class="col-sm-4 col-form-label">Новый пароль</label>
									<div class="col-sm-8">
										<input
											type="text"
											name="password"
											id="edit_password"
											class="form-control"
											placeholder="Пароль"
											value="">
									</div>
								</div>
								<div class="form-group row">
									<label for="edit_status" class="col-sm-4 col-form-label">Полномочия</label>
									<div class="col-sm-8">
										<select name="status" id="edit_status" class="form-control">
											<option value="0" id="edit_status_0">Админ</option>
											<option value="1" id="edit_status_1">Модер</option>
										</select>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="submit" name="edit" value="Сохранить" class="btn btn-success">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="deleteTitle">Удаление</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Подтвердите удаление пользователя <b id="delete_login"></b>
						</div>
						<div class="modal-footer">
							<a href="" id="delete_link" class="btn btn-success">Удалить</a>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
						</div>
					</div>
				</div>
			</div>

			<script>
				$(function () {
					$(".edit").click(function () {
						$("#edit_id").prop("value", this.getAttribute("user-id"));
						$("#edit_login").prop("value", this.getAttribute("user-login"));
						$("#edit_status_" + this.getAttribute("user-status")).prop("selected", "selected");
					});
					$(".delete").click(function () {
						$("#delete_login").text(this.getAttribute("user-login"));
						$("#delete_link").prop("href", "/admin.php?action=delete&delete=" + this.getAttribute("user-id"));
					});
				});
			</script>
		</body>
		</html>
		<?php
		break;
}
