<html>
<head><title>�v���O���~���O</title>
</head>
�v���O���~���O�u���O

<!--�����O�ƃR�����g�̓��̓t�H�[�����쐬-->
<form action="mission_2-6.php"method="post">
<!--�ҏW���閼�O�A�R�����g����̓t�H�[���ɕ\������ihidden�j��p����-->
<?php
//�ҏW�p�t�H�[���ɒl�����͂��ꂽ�ꍇ
//�ҏW�Ώ۔ԍ����󂯎�����ꍇ�̏����t��
if(!empty($_POST["edit"])){
	$filename='kadai2-3.txt';
	$ret_array=file($filename);//��s���̔z������o��
	foreach($ret_array as $line){ //�z�񕪃��[�v����������
		$data=explode("<>",$line);//�z���explode���g�p����"<>"�ŕ�������
		if($_POST["edit"]==$data[0]){//�ҏW�ԍ��Ɠ��e�ԍ��������ꍇ
			if($_POST["password_edit"]==$data[4]){//�����p�X�������Ȃ�
				$edit_num=$data[0];//�ԍ���ϐ���
				$user=$data[1];//���O��ϐ���
				$text=$data[2];//�R�����g��ϐ���
				echo '���O�A�R�����g�A�p�X���[�h���L�����Ă�������';
			}
			else{
				echo '�p�X���[�h���Ԉ���Ă��܂��I'."<br />";
				echo '�ҏW�Ɏ��s���܂���';
			}
		}
	}
}
?>
	<input type="hidden"name="edit_num"value="<?php echo $edit_num ; ?>"/><br>
	�u���O�v<br />
		<input type="text"name="name"size="20"value="<?php echo $user ; ?>"><br />
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
<form action="mission_2-6.php"method="post">
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
<form action="mission_2-6.php"method="post">
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
	if(!empty($_POST["password"])){//�p�X�L���m�F
		$filename='kadai2-3.txt';//�e�L�X�g�t�@�C��
		$ret_array=file($filename);//��s���̔z��Ŏ��o��
		$fp=fopen($filename,'w+');//���[�v�̑O�ɓ��e���J���ď���
		foreach($ret_array as $line){//���[�v������
			$numbers=explode("<>",$line);//"<>"�ŕ�������
			if($_POST["edit_num"]==$numbers[0]){//�ҏW�ԍ��Ɠ��e�ԍ��������Ȃ�
				$date=date("Y/m/d H:i:s");
				fwrite($fp,$numbers[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$date."<>".$_POST["password"]."<>"."\n");//�ύX��̖��O�A�R�����g�������ւ��ċL��
			}
			else{
				fwrite($fp,$line);//���̑��͂��̂܂܋L��
			}
		}
		fclose($fp);//���[�v�̌�Ƀt�@�C�������
	}
	else{//�p�X���L���̏ꍇ�̒���
		echo'�p�X���[�h�����L���ł�'."<br />";
		echo '�ҏW�Ɏ��s���܂���'."<br />";
	}
}
?>


<?php
//�����O�ƃR�����g���e�L�X�g�t�@�C���ɋL��

//���O�A�R�����g�A���ԁA�p�X���[�h�ϐ���
$name=($_POST["name"]);
$comment=($_POST["comment"]);
$date=date("Y/m/d H:i:s");
$pass=($_POST["password"]);

//�󗓂�����
if(!empty($_POST["name"])&&($_POST["comment"])&&empty($_POST["edit_num"])){
	if(!empty($_POST["password"])){
		$filename='kadai2-4.txt';
		$fp=fopen($filename,'a');
		fwrite($fp,"<>".$name."<>".$comment."<>".$date."\n");
		fclose($fp);

//�J�E���g�p�t�@�C����p�ӂ��čŐV�ԍ����L�����A�ϐ������ē��e�ԍ���\������

		//�ԍ��p�e�L�X�g
		$fp=fopen($filename,'r');
		$num_text=fgets($fp);//1�s�ڂ𕶎���Ƃ��ēǂݎ��
		fclose($fp);

		$number=(int)$num_text;//�������int�i�����j�^�ɕϊ����ϐ���
		$number +=1;//�P���₷

		$fp=fopen('kadai2-4.txt','w');
		fwrite($fp,$number);
		fclose($fp);

//�t�@�C�����J���Ĕԍ��A���O�A�R�����g�A���ԁA�p�X���[�h�̃f�[�^��ۑ�����
		$filename='kadai2-3.txt';
		$fp=fopen($filename,'a');
		fwrite($fp,$number."<>".$name."<>".$comment."<>".$date."<>".$pass."<>"."\n");
		fclose($fp);
	}
	else{
		echo '�p�X���[�h���L�����Ă�������'."<br />";
		echo '�R�����g�̓��e�Ɏ��s���܂���'."<br />";
	}
}


//�폜�p�t�H�[���ɒl�����͂��ꂽ�ꍇ
//�������ݎ��̃p�X�ƍ폜�p�t�H�[���̃p�X�������̏ꍇ
if(!empty($_POST["number"])){ //�폜�p�t�H�[�����琔������M������
	$filename='kadai2-3.txt'; //�t�@�C�����w��
	$ret_array=file($filename);//��s���̔z������o��
	$fp=fopen($filename,'r'); //�܂��p�X���[�h����v�����邽�߂ɁA�폜�p�Ɠ��e�p�ԍ�����v����z��̃p�X���[�h�����o���A���̂��߂ɓǂݎ��p�ŊJ��
	foreach($ret_array as $line){ //���[�v����
		$numbers=explode("<>",$line); //�z��𕪗􂵓��e�ԍ������o��
		if($_POST["number"]==$numbers[0]){//�폜�ԍ��Ɠ��e�ԍ�����v���邩�m�F
			if($_POST["password_delete"]==$numbers[4]){//�p�X����v���邩�m�F
				fclose($fp);//��v������܂�����
				$ret_array=file($filename);//�t�@�C������s���̔z������o��
				$fp=fopen($filename,'w+');//���[�v�̑O�ɓ��e���J���ď���
				foreach($ret_array as $line){//���[�v����
					$numbers=explode("<>",$line);//explode���g���ē��e�ԍ����擾����

//�e���e�ԍ��ƍ폜�ԍ����r���āA���̎��̂݃t�@�C���ɕۑ�����
					if($_POST["number"]!=$numbers[0]){
						fwrite($fp,$line);
					}
				}
				fclose($fp);//���[�v�̌�Ƀt�@�C�������
			}
			else{
				echo '�p�X���[�h���Ԉ���Ă��܂��I'."<br />";
				echo '�폜�Ɏ��s���܂���'."<br />";
			}
		}
	}

}
?>



<?php

//���e�L�X�g�t�@�C����ǂݍ��݃t�H�[���̉��ɕ\��
//�ŏ��Ƀt�@�C����file�֐��Ŕz��Ƃ��ēǂݍ���
$filename='kadai2-3.txt';
$ret_array=file($filename);


//�z����A�z�񐔂������[�v������
for($i=0; $i<count($ret_array); ++$i){
	
	//�L���u�����v�ŕ������邱�Ƃł��ꂼ��̒l���擾����iexplode�j
	$comments=explode("<>",$ret_array[$i]);

	//�l��echo�ŕ\���i�u�����v�͏����j
	echo($comments[0]." ".$comments[1]." ".$comments[2]." ".$comments[3]."<br />\n");
}

?>


</body>
</html>
