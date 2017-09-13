<?php
/**
 * Created by PhpStorm.
 * User: yujie.feng
 * Date: 2017/8/31
 * Time: 16:22
 */
try {
    $re = [];
    if ($_FILES['file']['error'] > 0) {
        $re['info'] = "上传文件失败";
        $re['status']=false;
    } else {
        include_once('GetCode.php');
        $coding=getCoding();
        if(move_uploaded_file($_FILES['file']['tmp_name'], iconv('utf-8',$coding,"upload" . DIRECTORY_SEPARATOR . $_FILES['file']['name']))){
            $re['info'] = "文件已经被覆盖，文件详细信息如下所示：";
            $re['name'] = $_FILES['file']['name'];
            $re['tmpName'] = $_FILES['file']['tmp_name'];
            $re['type'] = $_FILES['file']['type'];
            $re['size'] = ($_FILES['file']['size'] / 1024);
            $re['location'] = "upload" . DIRECTORY_SEPARATOR . $_FILES['file']['name'];
            $re['status']=true;
            $re['code']=$coding;
            $re['sys']=strtoupper(PHP_OS);
        }else{
            $re['info'] = "上传文件失败";
            $re['status']=false;
        }

    }
    echo json_encode($re);
} catch (Exception $exception) {
    echo "Exception:" . $exception;
}