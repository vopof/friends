<?php
$dsn ='mysql:dbname=LAA0433175-f6h7zi; host=mysql011.phy.lolipop.lan';
$user = 'LAA0433175';
$password = 'l7xgY2Tf';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
//サーバー設定
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> 地名リスト </title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>

<body>

<?php

$sql = 'SELECT*FROM area_table WHERE1';

//$sql = 'SELECT*FROM area_table;\\\\\
/*
SELECT文の基本形 – WHERE句
「WHERE 1」は、MySQLでは、必ず真という条件になり、検索条件がないのと同じ意味。

SELECT文では指定したテーブル（FROM句）に対して、検索条件（WHERE句）にマッチするレコード（行）の指定フィールド（列）を表示します。SELECTに続くのは列名、と覚えましょう。以下、具体例。

SELECT ＜列名1＞[, ＜列名2＞, …] FROM ＜テーブル名＞
WHERE
＜検索条件＞;
*/

$stmt = $dbh->prepare($sql); 
/*
PDOStatement::execute() メソッドによって実行される SQL ステートメントを
準備。 SQL ステートメントは、文が実行されるときに実際の値に置き換
えられる 0 個もしくはそれ以上の名前 (:name) もしくは疑問符(?) パラメータ
マークを含むことができ, 名前と疑問符パラメータを同一 SQL ステートメ
ント中で使用することはできない。 どちらか一方か、他のパラメータ形式を
使用。 

異なるパラメータを用いて複数回実行されるような文に対し PDO::prepare()と 
PDOStatement::execute() をコールすることで、ドライバがクライアントまたは
サーバ側にクエリプランやメタ情報を キャッシュさせるよう調整するため、ア
プリケーションのパフォーマンスを最適化。また、パラメータに手動でク
オートする必要がなくなるので SQL インジェクション攻撃から保護する。

PDO は元々この機能をサポートしていないドライバに対して プリペアドステー
トメントとバインドパラメータをエミュレート。このため、ある形式をサ
ポートしているがその他の形式をサポートしていないドライバの場合、名前もし
くは疑問符形式のパラメータを他の適当な値に書き換えることも可能。

*/
$stmt -> execute();

//$stmtにSELECTで取得したデータが格納
//プリペアドクエリを実行する 成功した場合に TRUE を、失敗した場合に FALSE を返す。

while(1)

	//while(1) の「1」は常に「Yes」で、「break」になるまで繰り返す
{
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
//結果の行を連想配列で取得する
//取得した行に対応する連想配列を返す。もしもう行がない場合には NULL を返す。

if($rec==false)
//fetch：順番に１レコードずつ取り出す
	//

{
	break;
}
//休止

$sql = 'SELECT COUNT( id ) FROM friends_table WHERE area_table_id =' . $rec['id'];
//テーブルを読み込む。
$stmt_ = $dbh->prepare($sql);
//ファイル名が前記述と同じだと起動しない場合がある
$stmt_->execute();
//$stmtにSELECTで取得したデータが格納
//プリペアドクエリを実行する 成功した場合に TRUE を、失敗した場合に FALSE を返す。
$count = $stmt_->fetch(PDO::FETCH_ASSOC);
//fetch：順番に１レコードずつ取り出す $countに情報を格納



if ($count['COUNT( id )']>= 1) {
	
echo "<table><tr><td>";
echo $rec['id'];
echo "</td><td>";
echo "<a href=\"area_friends.php?id=".$rec['id']."\">";
echo $rec['name'];
echo "</td><td>";
echo $count['COUNT( id )'];
echo "</td></tr></table>";
echo "<a/>";

} else {

echo "<table><tr><td>";
echo $rec['id'];
echo "</td><td>";
echo $rec['name'];
echo "</td><td>";
echo $count['COUNT( id )'];
echo "</td></tr></table>";
}


//出力

}


?>
</body>
</html>