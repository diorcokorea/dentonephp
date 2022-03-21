<?php
    include "../models/db/mongo_conn.php";
    include "../models/ebcryption.php";

    function loginCheck($rstr_id, $rstr_pw, $rstr_ip, $rstrgubun)
    {
        return login_Pro($rstr_id, $rstr_pw, $rstr_ip, $rstrgubun);
    }
?>
