<?php
    #region 암호화
    #region SHA
    function SHAebcvry256($plainText)
    {
        //SHA-256
        $hashed256 = base64_encode(hash('sha256', $plainText , true));
//      echo $hashed256;
        return $hashed256;
    }

    function SHAebcvry512($plainText)
    {
        //SHA-512
        $hashed512 = base64_encode(hash('sha512', $plainText, true));
//      echo $hashed512;
        return $hashed512;
    }
    #endregion

    #region AES
    $password = 'password string';

    // 256 bit 키를 만들기 위해서 비밀번호를 해시해서 첫 32바이트를 사용합니다.
    $password = substr(hash('sha256', $password, true), 0, 32);

    // Initial Vector(IV)는 128 bit(16 byte)입니다.
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    function AESencode($plainText)
    {
        // 암호화
        $encrypted = base64_encode(openssl_encrypt($plainText, 'aes-256-cbc', $GLOBALS['password'], OPENSSL_RAW_DATA, $GLOBALS['iv']));

        return $encrypted;
    }
    function AESdecrypted($encrypted)
    {
        // 복호화
        $decrypted = openssl_decrypt(base64_decode($encrypted), 'aes-256-cbc', $GLOBALS['password'], OPENSSL_RAW_DATA, $GLOBALS['iv']);

        return $decrypted;
    }

    #endregion

    #endregion

?>