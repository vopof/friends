<?php
$dsn ='mysql:dbname=LAA0433175-f6h7zi; host=mysql011.phy.lolipop.lan';
$user = 'LAA0433175';
$password = 'l7xgY2Tf';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');


if (isset($_POST['name'])){
	
	$sql = "UPDATE `friends_table` SET `name` = '".$_POST['name']."',`gender` = '".$_POST['gender']."',`age` = '".$_POST['age'];
	$sql .= "' WHERE `id` = ".$_POST['id'];	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	header('Location: http://www.a-ir.net/tes/friends/index.php');
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> 編集フォーム </title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body><?php
	
		$sql_friends = 'SELECT * FROM `friends_table` WHERE `id` = '.$_GET['id'];
		$stmt_friends = $dbh->prepare($sql_friends);
		$stmt_friends->execute();
		$rec_friends = $stmt_friends->fetch(PDO::FETCH_ASSOC);


		$id = $rec_friends['id'];
		$area_table_id = $rec_friends['area_table_id'];
		$name = $rec_friends['name'];
		$gender = $rec_friends['gender'];
		$age = $rec_friends['age'];
		$sql = 'SELECT * FROM `area_table`';
		

		$stmt = $dbh->prepare($sql);
		$stmt->execute();
	?>

	<form method="post" >
	<table><tr><td>	名前</td><td>
		<input name="name" type="text" style="width:100px;" maxlength="20" value="<?php echo $name; ?>"><br />
		</td><td>出身地</td><td>
		<select name="area_table_id">
			<?php
				while(1){
					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($rec == false){
						break;
					}
					if ($area_table_id == $rec['id']){
						echo '<option value="'.$rec['id'].'" selected>';
					}else{
						echo '<option value="'.$rec['id'].'">';						
					}
					echo $rec['name'];
					echo '</option>';
				}
			?>
		</select>
		</td><td>性別</td><td>
		<select name="gender">
			<?php 
				if ($gender == '男'){
					echo '<option value="男" selected>男性</option>';
					echo '<option value="女">女性</option>';
				}else{
					echo '<option value="男">男性</option>';
					echo '<option value="女" selected>女性</option>';					
				}
			?>
		</select></td><td>年齢</td><td>
		<input name="age" type="text" style="width:100px;" maxlength="10" value="<?php echo $age; ?>"><br />
		<input name="id" type="hidden" value="<?php echo $id; ?>"></td><td>
		<input type="submit" value="保存する" ></td><td><a href="http://www.a-ir.net/tes/friends/index.php">戻る</a></td></tr></table>
	</form>
</body>
</html>