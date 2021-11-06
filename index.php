<style type="text/css">
        body{
            background-image: url(http://api.ghser.com/random/pe.php);
/*background-repeat属性定义了图像的平铺模式*/
            background-repeat: no-repeat;
/*这个时候就会不重复平铺*/
             background-size:100%;
/* 指定背景图片大小 */
background-attachment: fixed;
/* 设置背景图像是否固定或者随着页面的其余部分滚动。 */
        }
        .file {
            position: relative;/*绝对定位!*/
            display: inline-block;/*设置为行内元素*/
            background: #D0EEFF;
            border: 1px solid #99D3F5;
            border-radius: 4px;
            padding: 4px 12px;
            overflow: hidden;
            color: #1E88C7;
            text-decoration: none;
            text-indent: 0;
            line-height: 20px;
            display:flex;
            flex-direction:column;
            justify-content:space-around;
            items-align:center;
        }
        .file_input {
          height: 50px;
          line-height: 50px;
          vertical-align: middle;
          background: #FAFBFD;
          border:1px solid #d4d4d4;
}
        .file_hover {
            height: 50px;
            background: #AADDFF;
            border-color: #78C3F3;
            color: #004974;
            text-decoration: none;
        }
</style>
<form action="" enctype="multipart/form-data" method="post"
name="uploadfile" class="file"><h1>上传图片：</h1><input type="file" name="upfile" class="file_input" /><br>
<input type="submit" class="file_hover" value="上传" /><title>图片上传</title></form><title>图片上传</title></form>
<?php
//print_r($_FILES["upfile"]);
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
$upfile=$_FILES["upfile"];
//获取数组里面的值
$name=$upfile["name"];//上传文件的文件名
$type=$upfile["type"];//上传文件的类型
$size=$upfile["size"];//上传文件的大小
$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径
//判断是否为图片
switch ($type){
case 'image/pjpeg':$okType=true;
break;
case 'image/jpeg':$okType=true;
break;
case 'image/gif':$okType=true;
break;
case 'image/png':$okType=true;
break;
}

if($okType){
/**
* 0:文件上传成功<br/>
* 1：超过了文件大小，在php.ini文件中设置<br/>
* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
* 3：文件只有部分被上传<br/>
* 4：没有文件被上传<br/>
* 5：上传文件大小为0
*/
$error=$upfile["error"];//上传后系统返回的值
echo "================<br/>";
echo "上传文件名称是：".$name."<br/>";
echo "上传文件类型是：".$type."<br/>";
echo "上传文件大小是：".$size."<br/>";
echo "上传后系统返回的值是：".$error."<br/>";
echo "上传文件的临时存放路径是：".$tmp_name."<br/>";

echo "开始移动上传文件<br/>";
//把上传的临时文件移动到up目录下面
move_uploaded_file($tmp_name,'up/'.$name);
$destination="up/".$name;
echo "================<br/>";
echo "上传信息：<br/>";
if($error==0){
echo "文件上传成功啦！";
echo "<br>图片预览:<br>";
echo "<img width='95%' src=".$destination.">";
//echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
}elseif ($error==1){
echo "超过了文件大小，在php.ini文件中设置";
}elseif ($error==2){
echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
}elseif ($error==3){
echo "文件只有部分被上传";
}elseif ($error==4){
echo "没有文件被上传";
}else{
echo "上传文件大小为0";
}
}else{
echo "请上传jpg,gif,png等格式的图片！";
}
}
?>
