<?php
// @LUCAS Ajax를 이용한 Notification 수를 처리하는 php 파일
// alarm_status.php

session_start();
//ini_set("display_errors", "1");
include_once($_SERVER["DOCUMENT_ROOT"] . "/models/db/querys.php");

//$user_code = $_SESSION['lab_member_code']; // 기공소
$user_code = $_SESSION['member_code']; // 의사

/**
 * null | empty => 상단 전체 카운트 처리
 * statusGroup => status_id 별로 카운트 처리
 */
$alarmType = $_GET["alarmType"] ?? null;

if (empty($alarmType)) {
// 상단 알람 처리
    $alarm_array = alarm_r($user_code);
    $alarm_array_count = count($alarm_array);
    $output = array(
        'alarm_array_count' => $alarm_array_count,
        'alarm_array' => $alarm_array,
    );

    echo json_encode($output);
} else {
    // 환자 목록 알람 처리

    $conn = initDB();

    $query = <<<SQL
SELECT
       SER.status_id         AS status_id,
       COUNT(PAT.patient_id) AS count
FROM
    tb_patient AS PAT
    LEFT OUTER JOIN tb_service AS SER ON ser.patient_id = pat.patient_id
    LEFT OUTER JOIN tb_alarm AS ALM ON ALM.service_id = ser.service_id AND ALM.type_id = 1
WHERE PAT.account_dr_id = ?
AND SER.service_id = ALM.service_id
AND PAT.account_dr_id = ALM.reciver_id
AND SER.status_id IS NOT null
GROUP BY SER.status_id
SQL;

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();

    $data = array();

    foreach ($result as $row) {
        $data[] = array(
            'status_id' => $row["status_id"],
            'count'     => $row["count"],
        );
    }

    echo json_encode($data);
}


/**
 *
 * $user_code =  $_SESSION['lab_member_code'];
 * patient_tab_count_r($tabMenu['status_id'], $user_code, null, null, '')
 *
 *
 * SELECT
 * SER.status_id,
 * Count(PAT.patient_id) AS count
 * FROM
 * tb_patient AS PAT
 * LEFT OUTER JOIN
 * tb_service AS SER ON ser.patient_id = pat.patient_id
 * LEFT OUTER JOIN
 * tb_alarm AS ALM ON ALM.service_id = ser.service_id AND ALM.type_id = 1
 * WHERE
 * PAT.account_dr_id = 1
 * AND (SER.service_id = ALM.service_id)
 * AND PAT.account_dr_id = ALM.reciver_id
 * AND SER.status_id IS NOT null
 * GROUP BY SER.status_id
 *
 * status_id = 1 => 1, 22
 * status_id = 2 => 20, 21
 * status_id = 3 => 2, 3
 * status_id = 4 => 7
 * status_id = 5 => 12, 13, 14
 * status_id = 6 => 8,9,10,11
 * status_id = 7 => 15
 * status_id = 8 => 16, 17
 * status_id = 9 => 5, 6, 18
 * status_id = 10 => 19
 *
 */

?>