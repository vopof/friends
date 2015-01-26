<?php
$dsn ='mysql:dbname=LAA0433175-f6h7zi; host=mysql011.phy.lolipop.lan';
$user = 'LAA0433175';
$password = 'l7xgY2Tf';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
//サーバー設定

if (isset($_POST['name'])){
	//echo '無事に登録されました！';
	
	$sql = "INSERT INTO `LAA0433175-f6h7zi`.`friends_table` (`id`, `area_table_id`, `name`, `gender`, `age`) ";
	$sql .= "VALUES (NULL, '".$_POST['area_table_id']."', '".$_POST['name']."', '".$_POST['gender']."', '".$_POST['age']."');";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	//echo $sql;
	header('Location: http://www.a-ir.net/tes/friends/index.php');
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> お友達フォーム </title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<?php
		$sql = 'SELECT * FROM `area_table`';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
	?>
<form method="post" >
<table><tr><td>名前</td><td>
		<input name="name" type="text" value=<?php echo $rec['name']; ?>></td><td>
性別</td><td>
<input type="radio" name="gender" value="男" checked="checked">男
<input type="radio" name="gender" value="女">女</td><td>
年齢</td><td>
<input name="age" type="text" style="width:80px"></td><td>
出身地</td><td>

		<select name="area_table_id">
			<?php
				while(1){
					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($rec == false){
						break;
					}
					echo '<option value="'.$rec['id'].'">';
					echo $rec['name'];
					echo '</option>';
				}
			?>
		</select></td><td>
		<input type="submit" value="登録する" ></td><td><input type="button" onclick="history.back()" value="戻る">
	</td><td></form>




</body>
</html>