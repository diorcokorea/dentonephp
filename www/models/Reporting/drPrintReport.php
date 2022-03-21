<?php
    include_once  $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/reportJson.php';
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/PHPJasper.php';
include_once $_SERVER["DOCUMENT_ROOT"]."/models/db/querys.php";

    use PHPJasper\PHPJasper;

    function  prescription_print($drid, $paid, $servid)
    {
        $rdata = patientpid($servid);
        $drpaid = $rdata[0];
        $shid = $rdata[1];

       report_json($drid, $paid, $servid);

        $input = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/DentOnePrint.jrxml';// .jrxml, .jasper 파일 경로
        $output = $_SERVER["DOCUMENT_ROOT"].'/Data/'.$drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report/DentOnePrint_'.$servid; // Report가 생성될 경로
        $mford = $_SERVER["DOCUMENT_ROOT"].'/Data/'.$drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report';
//        echo  $mford;
//        exit();
        mkdir($mford, 0777, true);
        $data_file = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/reportjsondata.json'; // JSON 파일
        $reso = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/malgun.jar'; // 한글폰트

        $options = [
            'format' => ['pdf'], // html, xlx 등등 몇가지 포맷이 더 있다...
            'resources' => $reso,  // 한글 폰트 변경 관련
            'db_connection' => [
                'driver' => 'json',  // sql, aws, json, 등등 데이터 드라이브 설정
                'data_file' => $data_file, // 데이터 소스 경로
                'json_query' => 'contacts' // json 읽을 처음 키값 ex(data : [] 이러면 data라고 넘겨줘야함.)
            ]
        ];

        $jasper = new PHPJasper();

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
    $purl = 'http://'.$_SERVER["HTTP_HOST"].'/Data/'.$drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report/DentOnePrint_'.$servid.'.pdf';
       // echo $purl;


       header('Location: '.$purl);
    }

    function  prescription_pdf($drid, $servid)
    {
        $rdata = patientpid($servid);
        $paid = $rdata[0];
        $shid = $rdata[1];
        report_json($drid, $paid, $servid);

        $input = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/DentOnePrint.jrxml';// .jrxml, .jasper 파일 경로
        $output = $_SERVER["DOCUMENT_ROOT"].'/Data/'.$drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report/DentOnePrint_'.$servid; // Report가 생성될 경로
        $mford = $_SERVER["DOCUMENT_ROOT"].'/Data/'.$drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report';
    //        echo  $mford;
    //        exit();
        mkdir($mford, 0777, true);
        $data_file = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/reportjsondata.json'; // JSON 파일
        $reso = $_SERVER["DOCUMENT_ROOT"].'/models/Reporting/malgun.jar'; // 한글폰트

        $options = [
            'format' => ['pdf'], // html, xlx 등등 몇가지 포맷이 더 있다...
            'resources' => $reso,  // 한글 폰트 변경 관련
            'db_connection' => [
                'driver' => 'json',  // sql, aws, json, 등등 데이터 드라이브 설정
                'data_file' => $data_file, // 데이터 소스 경로
                'json_query' => 'contacts' // json 읽을 처음 키값 ex(data : [] 이러면 data라고 넘겨줘야함.)
            ]
        ];

        $jasper = new PHPJasper();

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $purl = $drid.'/'.$paid.'/'.$servid.'/'.$shid.'/Report/DentOnePrint_'.$servid.'.pdf';

        return $purl;
        // echo $purl;
    }


?>