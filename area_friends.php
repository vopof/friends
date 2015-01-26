<?php
$dsn ='mysql:dbname=LAA0433175-f6h7zi; host=mysql011.phy.lolipop.lan';
$user = 'LAA0433175';
$password = 'l7xgY2Tf';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$area_id = $_GET['id'];
if (isset($_GET['del_flag'])){
	$del_sql = 'DELETE FROM `friends_table` WHERE `id`='.$_GET['friend_id'];
	$del_stmt = $dbh->prepare($del_sql);
	$del_stmt->execute();

	
}

//データベースから切断する
//$dbh=null;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> フレンドリスト </title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<?php


$id = $_GET['id'];

$sql = 'SELECT name FROM area_table where id='.$id;
$stmt = $dbh->prepare($sql); 
$stmt -> execute();

$rec = $stmt->fetch(PDO::FETCH_ASSOC);


$area_name = $rec['name'];
$friends_array = array();
while(1){
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($rec == false) {
		break;
	}
	$friends_array[] = $rec; 
}


$sql = 'SELECT * FROM friends_table where area_table_id='.$id;
$stmt = $dbh->prepare($sql); 
$stmt -> execute();
$flag = false;


while(1)
{
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
if($rec==false)
{
  break;
}


$flag = true;

echo "<table><tr><td>";
echo $rec['area_table_id'];
echo "</td><td>";
echo $rec['name'];
echo "</td><td>";
echo $rec['gender'];
echo "</td><td>";
echo $rec['age'];
echo "</td><td>";


echo '<input type="button" value="編集" onclick="location.href=\'up.php?id='.$rec['id'].'\'">';
echo '<input type="button" value="削除" onclick="if (confirm(\'削除しますか？\')){location.href=\'area_friends.php?id='.$area_id.'&friend_id='.$rec['id'].'&del_flag=1\'}">';
			
echo "</td></tr></table>";

}


	if ($flag == false) {
		echo "<table><tr><td>";
  		echo "無事に削除されました";
  		echo "</td></tr></table>";
  	}

echo "<table><tr><td>";
echo '<a href="form.php">友達を追加する</a>';
echo "</td><td>";
echo '<a href="http://www.a-ir.net/tes/friends/index.php">戻る</a>';
//echo '<a href="javascript:history.back();">戻る</a>';
echo "</td></tr></table>";

?>
</body>
</html>