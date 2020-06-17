<?php
/**
 * ****************************************************************
 * 标题：unzip类
 * 作者:叶斌兵
 * 邮箱：yebnbing@yebinbing.win
 * 博客：www.yebinbing.win
 *
 * 描述：在PHP-ZipArchive类的基础上进行二次封装使得方便调用
 * zip方法:用于压缩文件/文件夹
 * contents_to_zip方法:该方法可以在Zip文件里面写入指定文件和内容
 * unzip方法:解压zip文件（可加密码方便基友暴力zip文件）
 * **************************************************************
 */
class Unzip{
	protected $unzip;
	protected $zipfilename;
	public function __construct(){
		$this->unzip =  new ZipArchive();
	}
	/**
	 * [zip description]
	 * @param  string $filename     新建压缩文件的文件名，若不符合(*.zip)格式将自动添加zip后缀
	 * @param  string $Fromfilename 被压缩文件/文件夹的路径
	 * @param  string $pwd          压缩密码
	 * @return string               若错误返回错误信息,若压缩成功将返回 TRUE
	 */
	public function zip($filename='',$Fromfilename,$pwd = ""){
		if (!empty($filename) && preg_match('/zip/m', $filename)){
			if(!$this->unzip->open($filename, ZipArchive::CREATE))
				return 'File open failed';
		}elseif(!empty($filename)&& !preg_match('/zip/m', $filename)){
			$filename = $filename.'zip';
			if(!$this->unzip->open($filename, ZipArchive::CREATE))
				return 'File open failed';
		}
		if(is_dir($Fromfilename)){
			$list_dir = scandir($Fromfilename);
			for($i=2;$i<count($list_dir);$i++){
				if(is_dir($Fromfilename.'/'.$list_dir[$i])){
					$this->unzip->addGlob($Fromfilename.'/'.$list_dir[$i].'/*.*', 0, array('add_path' => $Fromfilename.'/'.$list_dir[$i].'/', 'remove_path' => $Fromfilename.'/'.$list_dir[$i]));
					$list_chr = scandir($Fromfilename.'/'.$list_dir[$i]);
					for($j=2;$j<count($list_chr);$j++){
						if(is_dir($Fromfilename.'/'.$list_dir[$i].'/'.$list_chr[$j])){
							echo $list_chr[$j];
							$this->zip($filename,$Fromfilename.'/'.$list_dir[$i].'/'.$list_chr[$j],$pwd);
						}else {
							$this->unzip->addFile($Fromfilename.'/'.$list_dir[$i].'/'.$list_chr[$j]);
							//加密文件 此处文件名及路径是压缩包内的
							if ($pwd) {
								$this->unzip->setEncryptionName($Fromfilename.'/'.$list_dir[$i].'/'.$list_chr[$j], ZipArchive::EM_AES_256,$pwd);
							}
						}
					}

				}else {
					$this->unzip->addFile($Fromfilename.'/'.$list_dir[$i]);
					//加密文件 此处文件名及路径是压缩包内的
					if ($pwd) {
						$this->unzip->setEncryptionName($Fromfilename.'/'.$list_dir[$i], ZipArchive::EM_AES_256,$pwd);
					}
				}
			}
		}else{
			$this->unzip->addFile($Fromfilename);
			//加密文件 此处文件名及路径是压缩包内的
			if ($pwd) {
				$this->unzip->setEncryptionName($Fromfilename, ZipArchive::EM_AES_256,$pwd);
			}
		}
		return TRUE;

	}
/**
 * [contents_to_zip description]
 * @param  string $filename    压缩文件名
 * @param  string $zipfilename 需要向压缩文件写入的文件名
 * @param  string $content     写入文件的内容
 * @param  string $pwd         压缩密码
 * @return string              成功返回True,否则返回错误内容
 */
	public function contents_to_zip($filename,$zipfilename,$content,$pwd = ""){
		if(!$this->unzip->open($filename, ZipArchive::CREATE))
			return 'File open failed';
		if(!$this->unzip->addFromString ($zipfilename, $content))
			return 'File write failed';
		//加密文件 此处文件名及路径是压缩包内的
		if ($pwd) {
			$this->unzip->setEncryptionName($zipfilename, ZipArchive::EM_AES_256,$pwd);
		}
		return TRUE;

	}
/**
 * [unzip description]
 * @param  string $filename 被压缩文件路径名
 * @param  string $dir      解压缩所到目录
 * @param  string $pwd      解压密码
 * @return string           返回错误原因
 */
	public function unzip($filename,$dir,$pwd = ""){
		if(!file_exists($filename))
			return 'File does not exist';
		if(!$this->unzip->open($filename))
			return 'File open failed';
		if(!is_dir($dir)){
			mkdir($dir,775);
		}else{
			return 'Dir mk failed';
		}
		//设置解压密码
		if ($pwd && $this->unzip->setPassword($pwd))
        {
            if (!$this->unzip->extractTo($dir))
				return "Extraction failed (wrong password?)";
        }
		if(!$this->unzip->extractTo($dir))
			return 'File unzip failed';
		return TRUE;
	}
	public function __destruct() {
		$this->unzip->close();
	}

}

?>