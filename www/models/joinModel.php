<?php
    $id = isset($_POST['id'])?$_POST['id']:'';
    $pw = isset($_POST['pw'])?$_POST['pw']:'';
    $pw2 = isset($_POST['pw2'])?$_POST['pw2']:'';

    if(($id != null) || ($pw != null) || ($pw2 != null)) {
        include "../models/db/mongo_conn.php";
        include "../models/ebcryption.php";
//        $filter = ['login_id' => $id];
//        $options = [
//            'projection' => ['_id' => 0]
//        ];
//        $query = new MongoDB\Driver\Query($filter, $options);
//        $rows = $mongo->executeQuery("diorco.tb_account_dr", $query);

//        $log = current($rows->toArray());
//        if(!empty($log)) {
//            echo "Sorry. $id already exists.<br>";
//        } else {
            if($pw == $pw2)
            {
                $plainText = $pw;
                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->insert(['created_date' => date("Y-m-d H:i:s"), 'login_id'=>$id, 'login_pw'=>AESencode($pw)]);
                $mongo->executeBulkWrite('diorco.tb_account_dr', $bulk);

                header('location:'."../views/index.php");
            } else {
                echo "Sorry. Password is not matched.<br>";
            }
       // }
    }
?>
