<html>
<head><title>�v���O���~���O</title>
</head>
�v���O���~���O�u���O
<body>
<!--�����O�ƃR�����g�̓��̓t�H�[�����쐬-->
<form action="mission_2-15.php"method="post">
<!--�ҏW���閼�O�A�R�����g����̓t�H�[���ɕ\������ihidden�j��p����-->
<?php
//�ҏW�p�t�H�[���ɒl�����͂��ꂽ�ꍇ
//�ҏW�Ώ۔ԍ����󂯎�����ꍇ�̏����t��
if(!empty($_POST["edit"])){
	/* MySQL �f�[�^�x�[�X�ɐڑ����� */
	//�z�X�g
	$dsn = ''�f�[�^�[�x�[�X��;
	//���[�U�[��
	$user = '���[�U�[��';
	//�p�X���[�h
	$password = '�p�X���[�h';


	$pdo = new PDO($dsn,$user,$password);

	/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
	$stmt = $pdo->query('SET NAMES utf8');

	$sql = 'SELECT * FROM programmingblog;';
	$results=$pdo -> query($sql);
	foreach($results as $row){
		if($_POST["edit"]==$row["number"]){
			if($_POST["password_edit"]==$row["pass"]){
				$edit_num=$row["number"];//�ԍ���ϐ���
				$userr=$row["name"];//���O��ϐ���
				$text=$row["comment"];//�R�����g��ϐ���
			}
			else{
				echo '�p�X���[�h���Ԉ���Ă��܂��I'.'<br>';
			}
		}
	}
}
?>
	<input type="hidden"name="edit_num"value="<?php echo $edit_num ; ?>"/><br>
	�u���O�v<br />
		<input type="text"name="name"size="20"value="<?php echo $userr ; ?>"><br />
	�u�R�����g�v<br />
		<textarea name="comment"cols="40"rows="10"><?php echo $text ; ?></textarea><br />
	�u�p�X���[�h�v<br />
		<input type="password"name="password"size="20"value=""><br />
	<br />
	<input type="submit" value="���e"/><br />
</form>

<!--�폜�p�t�H�[�����쐬-->
<br />
<br />
�폜�p�t�H�[��
<form action="mission_2-15.php"method="post">
	�u�폜�ԍ��v<br />
		<input type="text"name="number"size="3"value=""/><br />
	�u�p�X���[�h�v<br />
		<input type="password"name="password_delete"size="20"value=""><br />
		<br />
		<input type="submit"value="����"/>
</form>

<!-- �ҏW�t�H�[�����쐬-->
<br />
<br />
�ҏW�p�t�H�[��
<form action="mission_2-15.php"method="post">
	�u�ҏW�Ώ۔ԍ��v<br />
		<input type="text"name="edit"size="3"value=""/><br />
	�u�p�X���[�h�v<br />
		<input type="password"name="password_edit"size="20"value=""><br />
		<br />
		<input type="submit"value="����"/>
</form>

<?php
//�ҏW�p�t�H�[���ɒl�����͂���A���̓t�H�[���ŕҏW���ꂽ��
if(!empty($_POST["edit_num"])&&($_POST["name"])&&($_POST["comment"])){//�ҏW��o�^���ꂽ�ꍇ
	//�ҏW�@�\
	$dsn = '�f�[�^�[�x�[�X��';
	$user = '���[�U�[��';
	$password = '�p�X���[�h';
	$pdo = new PDO($dsn,$user,$password);

	/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
	$stmt = $pdo->query('SET NAMES utf8');
	
	//�u�������ď㏑��
	$number = $_POST["edit_num"]; $name_edit=$_POST["name"]; $comment_edit=$_POST["comment"];
	$sql = "update programmingblog set name='$name_edit',comment='$comment_edit'where number ='$number';";
	$result = $pdo->query($sql);

}
?>

<?php
//�폜�@�\
if(!empty($_POST["number"])){ //�폜�p�t�H�[�����琔������M������
	//�f�[�^�[�x�[�X�Ɛڑ�
	$dsn = '�f�[�^�[�x�[�X��';
	$user = '���[�U�[��';
	$password = '�p�X���[�h';

	$pdo = new PDO($dsn,$user,$password);
	/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
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
				echo '�p�X���[�h���Ԉ���Ă��܂��I'.'<br>';
			}
		}
	}
}
?>



<?php
/* MySQL �f�[�^�x�[�X�ɐڑ����� */
//�z�X�g
$dsn = '�f�[�^�[�x�[�X��';
//���[�U�[��
$user = '���[�U�[��';
//�p�X���[�h
$password = '�p�X���[�h';


$pdo = new PDO($dsn,$user,$password);

/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
$stmt = $pdo->query('SET NAMES utf8');

/* SQL�R�}���h�uCREATE TABLE�v�ŐV�����e�[�u�������A���̒��̃J�����i���ځj�𓊍e�ԍ��A���O�A�R�����g�A���e���ԁA�p�X���[�h�ɂ��� */
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
//�L���t�H�[���ɋL�����ꂽ��A�ۑ�����@�\
//�󗓂�����
if(!empty($_POST["name"])&&($_POST["comment"])&&empty($_POST["edit_num"])){
	if(!empty($_POST["password"])){
//�f�[�^�[�x�[�X�ɐڑ�
	$dsn = '�f�[�^�[�x�[�X��';
	$user = '���[�U�[��';
	$password = '�p�X���[�h';

	$pdo = new PDO($dsn,$user,$password);

/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
	$stmt = $pdo->query('SET NAMES utf8');

//�J�E���g�p�t�@�C����p�ӂ��čŐV�ԍ����L�����A�ϐ������ē��e�ԍ���\������

	//�ԍ��p�e�L�X�g
	$filename='kadai2-15.txt';//�t�@�C�����w��
	$fp=fopen($filename,'r');//�J��
	$num_text=fgets($fp);//1�s�ڂ𕶎���Ƃ��ēǂݎ��
	fclose($fp);

	$number=(int)$num_text;//�������int�i�����j�^�ɕϊ����ϐ���
	$number +=1;//�P���₷

	$fp=fopen('kadai2-15.txt','w');
	fwrite($fp,$number);
	fclose($fp);

//�e�[�u���Ƀf�[�^��}��
	$sql = $pdo -> prepare("INSERT INTO programmingblog(number,name,comment,date,pass) VALUES (:number,:name,:comment,:date,:pass)");//�J�����̔�������
	$sql -> bindValue(':number',$numbers, PDO::PARAM_INT);//���e�ԍ�
	$sql -> bindParam(':name',$name, PDO::PARAM_STR);//���O
	$sql -> bindParam(':comment',$comment, PDO::PARAM_STR);//�R�����g
	$sql -> bindParam(':date',$date, PDO::PARAM_STR);//���t
	$sql -> bindParam(':pass',$pass, PDO::PARAM_STR);//�p�X���[�h
	$numbers = ('$number');//�ԍ��̕ϐ���
	$name = ($_POST['name']);//���O�̕ϐ���
	$comment = ($_POST['comment']);//�R�����g�̕ϐ���
	$date = date("Y/m/d H:i:s");//���t�̕ϐ���
	$pass = ($_POST['password']);//�p�X�̕ϐ���
	$params=array(':number'=>"$number",':name'=>"$name",':comment'=>"$comment",':date'=>"$date",':pass'=>"$pass");//�ϐ���z��ɂ���
	$sql -> execute($params);//�z��̑}�������s
	}
	else{
		echo '�p�X���[�h����͂��Ă�������'.'<br>';
	}
}

?>

<?php
//�f�[�^���u���E�U�ɕ\������
//�f�[�^�[�x�[�X�Ɛڑ�
$dsn = ''�f�[�^�[�x�[�X��;
$user = '���[�U�[��';
$password = '�p�X���[�h';

$pdo = new PDO($dsn,$user,$password);

/* �����R�[�h��UTF-8�ɂ��ĕ��������΍� */
$stmt = $pdo->query('SET NAMES utf8');

//�\���@�\
$sql = 'SELECT * FROM programmingblog order by number ASC ;';
$results = $pdo -> query($sql);
foreach($results as $row){
	//$row�̒��ɂ̓e�[�u���̃J������������
	echo $row['number'] .',';
	echo $row['name'] .',';
	echo nl2br($row['comment'] .',');
	echo $row['date'] .'<br>';
}
?>

</body>
</html>