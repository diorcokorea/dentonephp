<?php
// @LUCAS Live Search Bar 라이브 서치바를 위한 php 파일 추가
// patient_process_data.php

session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/models/db/maria_conn.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/regexr.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/modelsVariable_global.php";

$loginId = (int)$_SESSION['member_code'];

$fromDate = '';
$toDate = '';

if (isset($_POST['fdate'])) {
    $fromDate = $_POST['fdate'];
}

if (isset($_POST['tdate'])) {
    $toDate = $_POST['tdate'];
}

$conn = initDB();


/****************************
 * 검색어로 환자를 검색하는 부분
 ****************************/
if (isset($_POST["query"])) {

    $data = array();

    $query = $_POST["query"];
    //$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

    if(checkhangul($query) == 1)
    {
        $dCnt = 0;
        $dCnt = mb_strlen($query, 'UTF-8');
        for($i = 0 ; $i < $dCnt; $i = $i + 1)
        {
            if($i == 0)
            {
                $condition = iconv_substr( $query, $i, 1,'UTF-8');
            }
            else
            {
                $condition = $condition.'|'.iconv_substr( $query, $i, 1, 'UTF-8');
            }
        }
    }
    else
    {
        $condition = $query;
    }

    if (!empty($fromDate)) {
        $fromDate = $fromDate . ' 00:00:00';
        $toDate = $toDate . ' 23:59:59';
    }

    $query = <<<SQL
SELECT
    PAT.name AS patient_name
FROM
    tb_patient AS PAT
        LEFT OUTER JOIN
    tb_service AS SER ON SER.patient_id = PAT.patient_id
WHERE
    PAT.account_dr_id = ?
    AND (PAT.id LIKE CONCAT('%', ?, '%') OR PAT.name LIKE CONCAT('%', ?, '%'))
    AND IF('$fromDate' != '', (DATE_FORMAT(SER.created_date, '%Y-%m-%d') BETWEEN '$fromDate' AND '$toDate' OR DATE_FORMAT(SER.modified_date, '%Y-%m-%d') BETWEEN '$fromDate' AND '$toDate'), SER.created_date > '2021-01-01 00:00:00')
SQL;

    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $loginId, $condition, $condition);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $replace_string = '<b>' . $condition . '</b>';

    foreach ($result as $row) {
        $data[] = array(
            'search_result' => str_ireplace($condition, $replace_string, $row["patient_name"])
        );
    }

    echo json_encode($data);
}







$post_data = json_decode(file_get_contents('php://input'), true);

/****************************
 * 검색어를 등록하는 부분
 ****************************/
if (isset($post_data['search_query'])) {

    $search_query = $post_data['search_query'];

    $query = <<<SQL
SELECT search_id 
  FROM tb_recent_search 
 WHERE search_query  = ?
   AND account_dr_id = ?
SQL;

    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $search_query, $loginId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt->close();

        $query = <<<SQL
INSERT INTO tb_recent_search (search_query, account_dr_id) 
VALUES (?, ?)
SQL;

        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $search_query, $loginId);
        $stmt->execute();
        $stmt->close();
    }

    $output = array(
        'success' => true
    );

    echo json_encode($output);

}






/****************************
 * 저장된 검색어를 로딩하는 부분
 ****************************/
if (isset($post_data['action'])) {
    if ($post_data['action'] == 'fetch') {

        $query = <<<SQL
SELECT * 
  FROM tb_recent_search 
 WHERE account_dr_id = ?
 ORDER BY search_id DESC 
LIMIT 10
SQL;

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $loginId);
        $stmt->execute();
        $result = $stmt->get_result();

        $returnData = array();

        foreach ($result as $row) {

            $returnData[] = array(
                'id' => $row['search_id'],
                'search_query' => $row["search_query"]
            );
        }

        echo json_encode($returnData);
    }

    if($post_data['action'] == 'delete')
    {
        $search_id = $post_data["id"];

        $query = <<<SQL
DELETE 
  FROM tb_recent_search 
 WHERE search_id = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $search_id);
        $stmt->execute();

        $output = array(
            'success'	=>	true
        );

        echo json_encode($output);
    }

}

$conn->close();

/**
 * @LUCAS Live Search Bar 라이브 서치바를 위한 새로운 테이블 생성
CREATE TABLE tb_recent_search (
    search_id INT(11) NOT NULL AUTO_INCREMENT COMMENT '기본키',
    account_dr_id INT(11) NOT NULL COMMENT '로그인 ID',
    search_query VARCHAR(500) NOT NULL COMMENT '검색어' COLLATE 'utf8_unicode_ci',
    PRIMARY KEY (search_id) USING BTREE
)
COMMENT='최근 검색어 저장 테이블'
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB


 */
?>