<html>
<head><title>プログラミング</title>
</head>
プログラミングブログ

<!--↓名前とコメントの入力フォームを作成-->
<form action="mission_2-6.php"method="post">
<!--編集する名前、コメントを入力フォームに表示する（hidden）を用いて-->
<?php
//編集用フォームに値が入力された場合
//編集対象番号を受け取った場合の条件付け
if(!empty($_POST["edit"])){
	$filename='kadai2-3.txt';
	$ret_array=file($filename);//一行ずつの配列を取り出す
	foreach($ret_array as $line){ //配列分ループ処理をする
		$data=explode("<>",$line);//配列をexplodeを使用して"<>"で分割する
		if($_POST["edit"]==$data[0]){//編集番号と投稿番号が同じ場合
			if($_POST["password_edit"]==$data[4]){//もしパスが同じなら
				$edit_num=$data[0];//番号を変数化
				$user=$data[1];//名前を変数化
				$text=$data[2];//コメントを変数化
				echo '名前、コメント、パスワードを記入してください';
			}
			else{
				echo 'パスワードが間違っています！'."<br />";
				echo '編集に失敗しました';
			}
		}
	}
}
?>
	<input type="hidden"name="edit_num"value="<?php echo $edit_num ; ?>"/><br>
	「名前」<br />
		<input type="text"name="name"size="20"value="<?php echo $user ; ?>"><br />
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
<form action="mission_2-6.php"method="post">
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
<form action="mission_2-6.php"method="post">
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
	if(!empty($_POST["password"])){//パス記入確認
		$filename='kadai2-3.txt';//テキストファイル
		$ret_array=file($filename);//一行ずつの配列で取り出す
		$fp=fopen($filename,'w+');//ループの前に内容を開いて消す
		foreach($ret_array as $line){//ループをする
			$numbers=explode("<>",$line);//"<>"で分割する
			if($_POST["edit_num"]==$numbers[0]){//編集番号と投稿番号が同じなら
				$date=date("Y/m/d H:i:s");
				fwrite($fp,$numbers[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$date."<>".$_POST["password"]."<>"."\n");//変更後の名前、コメントを差し替えて記入
			}
			else{
				fwrite($fp,$line);//その他はそのまま記入
			}
		}
		fclose($fp);//ループの後にファイルを閉じる
	}
	else{//パス未記入の場合の注意
		echo'パスワードが未記入です'."<br />";
		echo '編集に失敗しました'."<br />";
	}
}
?>


<?php
//↓名前とコメントをテキストファイルに記入

//名前、コメント、時間、パスワード変数化
$name=($_POST["name"]);
$comment=($_POST["comment"]);
$date=date("Y/m/d H:i:s");
$pass=($_POST["password"]);

//空欄を除く
if(!empty($_POST["name"])&&($_POST["comment"])&&empty($_POST["edit_num"])){
	if(!empty($_POST["password"])){
		$filename='kadai2-4.txt';
		$fp=fopen($filename,'a');
		fwrite($fp,"<>".$name."<>".$comment."<>".$date."\n");
		fclose($fp);

//カウント用ファイルを用意して最新番号を記入し、変数化して投稿番号を表示する

		//番号用テキスト
		$fp=fopen($filename,'r');
		$num_text=fgets($fp);//1行目を文字列として読み取る
		fclose($fp);

		$number=(int)$num_text;//文字列をint（整数）型に変換し変数化
		$number +=1;//１増やす

		$fp=fopen('kadai2-4.txt','w');
		fwrite($fp,$number);
		fclose($fp);

//ファイルを開いて番号、名前、コメント、時間、パスワードのデータを保存する
		$filename='kadai2-3.txt';
		$fp=fopen($filename,'a');
		fwrite($fp,$number."<>".$name."<>".$comment."<>".$date."<>".$pass."<>"."\n");
		fclose($fp);
	}
	else{
		echo 'パスワードを記入してください'."<br />";
		echo 'コメントの投稿に失敗しました'."<br />";
	}
}


//削除用フォームに値が入力された場合
//書き込み時のパスと削除用フォームのパスが同時の場合
if(!empty($_POST["number"])){ //削除用フォームから数字を受信したら
	$filename='kadai2-3.txt'; //ファイルを指定
	$ret_array=file($filename);//一行ずつの配列を取り出す
	$fp=fopen($filename,'r'); //まずパスワードを一致させるために、削除用と投稿用番号が一致する配列のパスワードを取り出す、そのために読み取り用で開く
	foreach($ret_array as $line){ //ループ処理
		$numbers=explode("<>",$line); //配列を分裂し投稿番号を取り出す
		if($_POST["number"]==$numbers[0]){//削除番号と投稿番号が一致するか確認
			if($_POST["password_delete"]==$numbers[4]){//パスが一致するか確認
				fclose($fp);//一致したらまず閉じる
				$ret_array=file($filename);//ファイルを一行ずつの配列を取り出す
				$fp=fopen($filename,'w+');//ループの前に内容を開いて消す
				foreach($ret_array as $line){//ループ処理
					$numbers=explode("<>",$line);//explodeを使って投稿番号を取得する

//各投稿番号と削除番号を比較して、≠の時のみファイルに保存する
					if($_POST["number"]!=$numbers[0]){
						fwrite($fp,$line);
					}
				}
				fclose($fp);//ループの後にファイルを閉じる
			}
			else{
				echo 'パスワードが間違っています！'."<br />";
				echo '削除に失敗しました'."<br />";
			}
		}
	}

}
?>



<?php

//↓テキストファイルを読み込みフォームの下に表示
//最初にファイルをfile関数で配列として読み込む
$filename='kadai2-3.txt';
$ret_array=file($filename);


//配列を、配列数だけループさせる
for($i=0; $i<count($ret_array); ++$i){
	
	//記号「＜＞」で分割することでそれぞれの値を取得する（explode）
	$comments=explode("<>",$ret_array[$i]);

	//値をechoで表示（「＜＞」は除く）
	echo($comments[0]." ".$comments[1]." ".$comments[2]." ".$comments[3]."<br />\n");
}

?>


</body>
</html>
