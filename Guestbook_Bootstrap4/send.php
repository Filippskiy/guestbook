<?php
	include ("dbconnect.php");
	if (!isset($_SESSION)) {
		session_start();
	}

	$post = (!empty($_REQUEST)) ? true : false;
	
	if($post)
	{
		$name 	 = htmlspecialchars(trim($_REQUEST['caption']));
		
		
		$message = htmlspecialchars(trim($_REQUEST['message']));//убираем пробелы по краям	
		
		$headers  = "Content-type: text/plain; charset=utf-8 \r\n"; 
		
		global $conn; // делаем переменную $conn глобальной
	              // получаем переменные из формы
		$caption = $_REQUEST ['caption'];
		$message = $_REQUEST ['message'];
		// добавление данных в БД
		try {
			if (!$conn->query("INSERT INTO GBookTable(caption, date, message) VALUES ('$caption', NOW(), '$message')"))
				throw new Exception('Ошибка заполнения  таблицы GBookTable: [' . $conn->error . ']');
			$_SESSION ['add'] = true;
			header("Location: admin_panel.php");
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	
?>