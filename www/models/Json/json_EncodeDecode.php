<?php
    #region Json 형태 만들기
    function encode_json($data)
    {
        return str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));
    }
    #endregion

    #region Json 풀기
    function decode_json($data)
    {
        $decode = json_decode($data, true);
        //return $decode["data2"][0];        // 이중 배열 안의 값을 가져 오는 방법
        //return $decode["test"];             // 배열 값을 가져 오는 방법
        return $decode;
    }
    #endregion
?>
