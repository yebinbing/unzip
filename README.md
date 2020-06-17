# Unzip类

## 描述
- > 在PHP-ZipArchive类的基础上进行二次封装使得方便调用(可用密码加解压文件也可暴力密码)
- > ***PHP版本***:PHP 5 >= 5.6.0, PHP 7, PECL zip >= 1.12.4
- > ***zip方法***:用于压缩文件/文件夹
- >***contents_to_zip方法***:该方法可以在Zip文件里面写入指定文件和内容
- >***unzip方法***:解压zip文件


## 联系方式

- ![](https://img.shields.io/badge/%E4%BD%9C%E8%80%85-yebinbing-brightgreen.svg)
- [![](https://img.shields.io/badge/%E5%8D%9A%E5%AE%A2-yebinbing-blueviolet)](http://www.yebinbing.win)
- [![](https://img.shields.io/badge/Github-yebinbing-green?logo=appveyor&style=flat)](https://github.com/yebinbing)

## 各平台链接
- [![](https://img.shields.io/badge/Github-unzup-green?logo=appveyor&style=flat)](https://github.com/yebinbing/unzup)
- [![](https://img.shields.io/badge/Gitee-unzup-green?logo=appveyor&style=flat)](https://gitee.com/yebinbing/unzip)
- [![](https://img.shields.io/badge/Gitlab-unzup-green?logo=appveyor&style=flat)](https://gitlab.com/yebinbing1/unzip)
## 使用方法

- **压缩文件**

- >@param  $filename     新建压缩文件的文件名，若不符合(*.zip)格式将自动添加zip后缀
- >@param  $Fromfilename 被压缩文件/文件夹的路径
- >@param  $pwd 压缩密码
- >@return             若错误返回错误信息,若压缩成功将返回 TRUE

```php
<?php
    include('unzip.class.php');
	$usezip  = new Unzip();
	$usezip->zip('file.zip','test.php');//压缩文件(无密码)
	$usezip->zip('pfile.zip','test.php','ybb');//压缩文件(有密码)
?>
```

- **解压ZIP文件**

- > @param  string $filename 被压缩文件路径名
- > @param  string $dir      解压缩所到目录
- > @param  string $pwd      解压密码
- > @return string           返回错误原因

```php
<?php
    include('unzip.class.php');
	$usezip  = new Unzip();
	$usezip->unzip('file.zip','dir');//解压file.zip到文件夹dir(无密码)
	$usezip->unzip('pfile.zip','dir','ybb');//解压file.zip到文件夹dir(有密码)
?>
```

- **Zip文件里面写入指定文件和内容**

- >@param  string $filename    压缩文件名
- >@param  string $zipfilename 需要向压缩文件写入的文件名
- >@param  string $content     写入文件的内容
- >@param  $pwd 压缩密码
- >@return string              成功返回True,否则返回错误内容

```php
<?php
    include('unzip.class.php');
	$usezip  = new Unzip();
	$usezip->contents_to_zip('file.zip','file.txt','contents');//往file.zip写入一个文件file.txt,内容为content(无密码)
	$usezip->contents_to_zip('pfile.zip','file.txt','contents','ybb');//往file.zip写入一个文件file.txt,内容为content(有密码)
?>
```

