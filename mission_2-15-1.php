<html>
<head><title>プログラミング</title>
</head>
プログラミングブログ
<body>
<!--↓名前とコメントの入力フォームを作成-->
<form action="mission_2-15.php"method="post">
<!--編集する名前、コメントを入力フォームに表示する（hidden）を用いて-->
<?php
//編集用フォームに値が入力された場合
//編集対象番号を受け取った場合の条件付け
if(!empty($_POST["edit"])){
	/* MySQL データベースに接続する */
	//ホスト
	$dsn = ''データーベース名;
	//ユーザー名
	$user = 'ユーザー名';
	//パスワード
	$password = 'パスワード';


	$pdo = new PDO($dsn,$user,$password);

	/* 文字コードをUTF-8にして文字化け対策 */
	$stmt = $pdo->query('SET NAMES utf8');

	$sql = 'SELECT * FROM programmingblog;';
	$results=$pdo -> query($sql);
	foreach($results as $row){
		if($_POST["edit"]==$row["number"]){
			if($_POST["password_edit"]==$row["pass"]){
				$edit_num=$row["number"];//番号を変数化
				$userr=$row["name"];//名前を変数化
				$text=$row["comment"];//コメントを変数化
			}
			else{
				echo 'パスワードが間違っています！'.'<br>';
			}
		}
	}
}
?>
	<input type="hidden"name="edit_num"value="<?php echo $edit_num ; ?>"/><br>
	「名前」<br />
		<input type="text"name="name"size="20"value="<?php echo $userr ; ?>"><br />
	「コメント」<br />
		<textarea name="comment"cols="40"rows="10"><?php echo $text ; ?></textarea><br />
	「パスワード」<br />
		<input type="password"name="password"size="20"value=""><br />
	<br />
	<input type="submit" value="投稿"/><br />
</form>

<!--削除用フォームを作成-->
<br />
<br />
削除用フォーム
<form action="mission_2-15.php"method="post">
	「削除番号」<br />
		<input type="text"name="number"size="3"value=""/><br />
	「パスワード」<br />
		<input type="password"name="password_delete"size="20"value=""><br />
		<br />
		<input type="submit"value="入力"/>
</form>

<!-- 編集フォームを作成-->
<br />
<br />
編集用フォーム
<form action="mission_2-15.php"method="post">
	「編集対象番号」<br />
		<input type="text"name="edit"size="3"value=""/><br />
	「パスワード」<br />
		<input type="password"name="password_edit"size="20"value=""><br />
		<br />
		<input type="submit"value="入力"/>
</form>

<?php
//編集用フォームに値が入力され、入力フォームで編集された後
if(!empty($_POST["edit_num"])&&($_POST["name"])&&($_POST["comment"])){//編集後登録された場合
	//編集機能
	$dsn = 'データーベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn,$user,$password);

	/* 文字コードをUTF-8にして文字化け対策 */
	$stmt = $pdo->query('SET NAMES utf8');
	
	//置き換えて上書き
	$number = $_POST["edit_num"]; $name_edit=$_POST["name"]; $comment_edit=$_POST["comment"];
	$sql = "update programmingblog set name='$name_edit',comment='$comment_edit'where number ='$number';";
	$result = $pdo->query($sql);

}
?>

<?php
//削除機能
if(!empty($_POST["number"])){ //削除用フォームから数字を受信したら
	//データーベースと接続
	$dsn = 'データーベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';

	$pdo = new PDO($dsn,$user,$password);
	/* 文字コードをUTF-8にして文字化け対策 */
	$stmt = $pdo->query('SET NAMES utf8');

	$sql = 'SELECT * FROM programmingblog;';
	$results=$pdo -> query($sql);
	foreach($results as $row){
		if($row["number"]==$_POST["number"]){
			if($_POST["password_delete"]==$row["pass"]){
				$number=$_POST["number"];
				$sql="delete from programmingblog where number=$number;";
				$result=$pdo->query($sql);
			}
			else{
				echo 'パスワードが間違っています！'.'<br>';
			}
		}
	}
}
?>



<?php
/* MySQL データベースに接続する */
//ホスト
$dsn = 'データーベース名';
//ユーザー名
$user = 'ユーザー名';
//パスワード
$password = 'パスワード';


$pdo = new PDO($dsn,$user,$password);

/* 文字コードをUTF-8にして文字化け対策 */
$stmt = $pdo->query('SET NAMES utf8');

/* SQLコマンド「CREATE TABLE」で新しくテーブルを作り、その中のカラム（項目）を投稿番号、名前、コメント、投稿時間、パスワードにする */
$sql= "CREATE TABLE programmingblog"
." ("
. "number INT,"
. "name char(32),"
. "comment TEXT,"
. "date TEXT,"
. "pass TEXT"
.");";
$stmt = $pdo->query($sql);
?>



<?php
//記入フォームに記入された後、保存する機能
//空欄を除く
if(!empty($_POST["name"])&&($_POST["comment"])&&empty($_POST["edit_num"])){
	if(!empty($_POST["password"])){
//データーベースに接続
	$dsn = 'データーベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';

	$pdo = new PDO($dsn,$user,$password);

/* 文字コードをUTF-8にして文字化け対策 */
	$stmt = $pdo->query('SET NAMES utf8');

//カウント用ファイルを用意して最新番号を記入し、変数化して投稿番号を表示する

	//番号用テキスト
	$filename='kadai2-15.txt';//ファイルを指定
	$fp=fopen($filename,'r');//開く
	$num_text=fgets($fp);//1行目を文字列として読み取る
	fclose($fp);

	$number=(int)$num_text;//文字列をint（整数）型に変換し変数化
	$number +=1;//１増やす

	$fp=fopen('kadai2-15.txt','w');
	fwrite($fp,$number);
	fclose($fp);

//テーブルにデータを挿入
	$sql = $pdo -> prepare("INSERT INTO programmingblog(number,name,comment,date,pass) VALUES (:number,:name,:comment,:date,:pass)");//カラムの箱を準備
	$sql -> bindValue(':number',$numbers, PDO::PARAM_INT);//投稿番号
	$sql -> bindParam(':name',$name, PDO::PARAM_STR);//名前
	$sql -> bindParam(':comment',$comment, PDO::PARAM_STR);//コメント
	$sql -> bindParam(':date',$date, PDO::PARAM_STR);//日付
	$sql -> bindParam(':pass',$pass, PDO::PARAM_STR);//パスワード
	$numbers = ('$number');//番号の変数化
	$name = ($_POST['name']);//名前の変数化
	$comment = ($_POST['comment']);//コメントの変数化
	$date = date("Y/m/d H:i:s");//日付の変数化
	$pass = ($_POST['password']);//パスの変数化
	$params=array(':number'=>"$number",':name'=>"$name",':comment'=>"$comment",':date'=>"$date",':pass'=>"$pass");//変数を配列にする
	$sql -> execute($params);//配列の挿入を実行
	}
	else{
		echo 'パスワードを入力してください'.'<br>';
	}
}

?>

<?php
//データをブラウザに表示する
//データーベースと接続
$dsn = ''データーベース名;
$user = 'ユーザー名';
$password = 'パスワード';

$pdo = new PDO($dsn,$user,$password);

/* 文字コードをUTF-8にして文字化け対策 */
$stmt = $pdo->query('SET NAMES utf8');

//表示機能
$sql = 'SELECT * FROM programmingblog order by number ASC ;';
$results = $pdo -> query($sql);
foreach($results as $row){
	//$rowの中にはテーブルのカラム名が入る
	echo $row['number'] .',';
	echo $row['name'] .',';
	echo nl2br($row['comment'] .',');
	echo $row['date'] .'<br>';
}
?>

</body>
</html>