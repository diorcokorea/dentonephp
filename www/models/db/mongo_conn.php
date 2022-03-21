<?php
    try
    {
//        $mongo_id = "admin";
//        $mongo_pw = "diorco1234!@#$";
//        $mongo_uri = "mongodb://".$mongo_id.$mongo_pw.":"."@192.168.0.250:27017";
        $mongo = new MongoDB\Driver\Manager("mongodb://dentone:diorco3605@192.168.0.250:27017/diorco");
        $command = new MongoDB\Driver\Command(['ping' => 1]);
    }
    catch (MongoDB\Driver\Exception\Exception $e)
    {
        $filename = basename(__FILE__);

        echo "The $filename script has experienced an error.\n";
        echo "It failed with the following exception:\n";

        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";
    }
?>