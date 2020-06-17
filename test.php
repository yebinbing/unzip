<?php
    include('unzip.class.php');
	$usezip  = new Unzip();
	// $zip = $usezip->zip('file.zip','test.php');//压缩文件(无密码)
	// $zip = $usezip->zip('pfile.zip','test.php','ybb');//压缩文件(有密码)

	// $zip = $usezip->zip('file.zip','dir');//压缩文件夹(无密码)
	// $zip = $usezip->zip('pfile.zip','dir','ybb');//压缩文件夹(有密码)

	// $zip = $usezip->unzip('file.zip','dir');//解压file.zip到文件夹dir(无密码)
	// $zip = $usezip->unzip('pfile.zip','dir','ybb');//解压file.zip到文件夹dir(有密码)

	// $zip = $usezip->contents_to_zip('file.zip','file.txt','contents');//往file.zip写入一个文件file.txt,内容为content(无密码)
	$zip = $usezip->contents_to_zip('pfile.zip','file.txt','contents','ybb');//往file.zip写入一个文件file.txt,内容为content(有密码)
	var_dump($zip);
?>