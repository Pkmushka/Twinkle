<?php 
require_once "config.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="Регистрация пользователей PHP MySQL, Авторизация пользователей PHP MySQL" /> 
		<meta name="description" content="Регистрация пользователей PHP MySQL с активацией письмом" />
		<title>TWINKLE</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="./style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="/img/TWINKLE.ico">
    </head>
	<body>
		<header>
        <div id="logo">
				<div class="logo">
					<a href="index.html">TWINKLE</a>
				</div>
			</div>
			<div id="menu">
					<div class="menu">
						<ul>
                            <!-- кнопка для выхода -->
							<li><a href="logout.php" role="button" aria-pressed="true">ВЫХОД</a></li>
						</ul>
					</div>
				</div>		
		</header>
<?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $userid = $db->real_escape_string($_GET["id"]);
    $sql = "SELECT * FROM Sport WHERE id = '$userid'";
    if($result = $db->query($sql)){
        if($result->num_rows > 0){
            foreach($result as $row){
                $username = $row["name"];
                $userage = $row["cond"];
            }
            echo "<h3>Обновление инвентаря</h3>
                <form method='post'>
                    <input type='hidden' name='id' value='$userid' />
                    <p>Название:
                    <input type='text' name='name' value='$username' /></p>
                    <p>Состояние:
                    <input type='number' name='cond' value='$userage' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Пользователь не найден</div>";
        }
        $result->free();
    } else{
        echo "Ошибка: " . $db->error;
    }
}
elseif (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["cond"])) {
      
    $userid = $db->real_escape_string($_POST["id"]);
    $username = $db->real_escape_string($_POST["name"]);
    $userage = $db->real_escape_string($_POST["cond"]);
    $sql = "UPDATE Sport SET name = '$username', cond = '$userage' WHERE id = '$userid'";
    if($result = $db->query($sql)){
        header("Location: welcome1.php");
    } else{
        echo "Ошибка: " . $db->error;
    }
}
else{
    echo "Некорректные данные";
}
$db->close();
?>
</body>
</html>