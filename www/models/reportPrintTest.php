<?php
require_once __DIR__ . '/Reporting/vendor/autoload.php';
require_once __DIR__ . '/Reporting/PHPJasper.php';

use PHPJasper\PHPJasper;

function report_test()
{
    $input = __DIR__ . '\Reporting\DentOnePrint.jrxml';// .jrxml, .jasper 파일 경로
    $output =  $_SERVER["DOCUMENT_ROOT"].'/Data/5/4/1/Report/DentOnePrint_4'; // Report가 생성될 경로

    $data_file = __DIR__ . '\Reporting\reportjsondata.json'; // JSON 파일
    $reso = __DIR__ . '\Reporting\malgun.jar'; // JSON 파일
//echo  $data_file;

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

    //header('Location: http://localhost/Data/5/4/1/Report/DentOnePrint.pdf');
}
//?>