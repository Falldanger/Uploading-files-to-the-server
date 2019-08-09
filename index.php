<?php
	
	if(isset($_POST['upload'])){

		$whitelist = ['.mp3'];
    	foreach ($whitelist as $item) {
    		if (preg_match("/$item$/", $_FILES['audiofile']['name'])) {
			}
    		else{
    			exit('Невозможно загрузить такой тип файла');
    		}
		}

    	$type = mime_content_type($_FILES['audiofile']['tmp_name']);
        if ($type && ($type == 'audio/mpeg')) {
            if ($_FILES['audiofile']['size'] < 1024 * 10000) {
                $upload = 'music/'.$_FILES['audiofile']['name'];
    			if (move_uploaded_file($_FILES['audiofile']['tmp_name'], $upload)){ 
    				echo 'Файл успешно загружен!';
    			}
    			else{
    				echo 'Ошибка загрузки! ';
    			}
            }
            else{
            	exit('Размер файла превышен!');
            } 
        }
        else {
        	exit('Тип файла не подходит');
        }

	}
?>
<form name="upload" action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <input type="file" name="audiofile" />
    </p>
    <p>
        <input type="submit" name="upload" value="Отправить" />
    </p>
</form>
 <?php 
		$dir = opendir('music/');
		$allfiles=[];
	while ($file = readdir($dir)) {
    if ($file == '.' || $file == '..') {
        continue;
    }

    $allfiles[]='music/'.$file;
	}
	foreach ($allfiles as $k) {?>
			<audio src="<?php echo $k; ?>" controls="" preload="metadata"></audio>
		<?php
	}
	closedir($dir);
?>