<?php
header("Content-Type:text/html;charset=utf-8");
try {
    $re = [];
    $re['error'] = $_FILES['file']['error'];
    include_once('GetCode.php');
    $coding=getCoding();
    if ($_FILES['file']['error'] > 0) {
        $re['info'] = "上传文件失败";
    } else {
        $re['name'] = $_FILES['file']['name'];
        $re['tmpName'] = $_FILES['file']['tmp_name'];
        $re['type'] = $_FILES['file']['type'];
        $re['size'] = ($_FILES['file']['size'] / 1024);
        $re['code']=$coding;
        $re['sys']=strtoupper(PHP_OS);
        if (file_exists(iconv('utf-8',$coding,"upload" . DIRECTORY_SEPARATOR . $_FILES['file']['name']))) {
            $re['error'] = -1;
            $re['info'] = $_FILES['file']['name'] . "已经存在！";
        } else {
            $re['info'] = "上传成功，文件详细信息如下所示：";
            $re['location'] = "upload" . DIRECTORY_SEPARATOR . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], iconv('utf-8',$coding,"upload" . DIRECTORY_SEPARATOR . $_FILES['file']['name']));
        }
    }
    echo json_encode($re);
} catch (Exception $exception) {
    echo "异常信息：" . $exception;
}