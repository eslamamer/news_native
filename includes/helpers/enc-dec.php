<?php
    /*
    // function encrypt(mixed $data, string $key) { }
    // @param mixed $data
    // @param string $key
    // @return string
    */
//     if(!function_exists('encrypt')){
//         function encrypt(mixed $data, string $key){//key = 'your_secret_key';
//             $method     = config('cipher.method');
//             $iv_len     = openssl_cipher_iv_length($method);
//             $iv         = openssl_random_pseudo_bytes($iv_len);
//             $payload    = is_string($data) ? $data : serialize($data);
//             $cipher_raw = openssl_encrypt($payload, $method, $key, OPENSSL_RAW_DATA, $iv);
//             $hash       = hash_hmac('sha256',$cipher_raw, $key, true);
//             $encode_raw = base64_encode($iv.$hash.$cipher_raw);
//             return $encode_raw;
//         }
//     }
    
//    //string(88) "xiYAoR23RlQRuSyVWWmDojgx7fkbezVReblAuDNQzqQFMva87lcrkq4GAVi1JRW6oj7EvGzFAZtLGeWdy/zM2Q=="
//     if(!function_exists('decrypt')){
//         function decrypt(string $encrypt, string $key){
//             $method     = config('cipher.method');
//             $decode_raw = base64_decode($encrypt);
//             $iv_len     = openssl_cipher_iv_length($method);
//             $iv         = substr($decode_raw, 0, $iv_len);
//             $hash       = substr($decode_raw, $iv_len, 32);
//             $cipher_raw = substr($decode_raw, $iv_len + 32);
//             $cal_hash   = hash_hmac('sha256', $cipher_raw, $key, true);
//             if(hash_equals($hash, $cal_hash)){
//                 $decrypted = openssl_decrypt($cipher_raw, $method, $key, OPENSSL_RAW_DATA, $iv);
//                 if ($decrypted === false) {
//                     return false;
//                 }
//                 $unserialized = @unserialize($decrypted);
//                 return $unserialized === false && $decrypted !== serialize(false) ? $decrypted : $unserialized;
//             }
//             return false;
//         }
//     }
    // $encrepted = encrypt('Hello, W o r l d !', 'your_secret_key');
    // var_dump($encrepted);
    // var_dump(decrypt($encrepted, 'your_secret_key'));


/**
     * encrypt Useed To encrypt plain Text
     * @param string $value
     * @return string
     */
if(!function_exists('encrypt')){
    
    function encrypt(string $value):string{
        $cipher = config('cipher.method');
        $key = config('cipher.encryption_key');
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        $chipertext = base64_encode($iv.$hmac.$ciphertext_raw);
        return $chipertext;
    }
}

/**
     * decrypt Useed To decryption a plain Text
     * @param string $chipertext
     * @return string
     */
if(!function_exists('decrypt')){
     
    function decrypt(string $chipertext):string{
        $cipher = config('cipher.method');
        $key = config('cipher.encryption_key');
        $convert = base64_decode($chipertext);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($convert, 0, $ivlen);
        $hmac = substr($convert, $ivlen, 32);
        $ciphertext_raw = substr($convert, $ivlen+32);
        $original_text = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if(hash_equals($hmac,$calcmac)){
            return $original_text;
        }
        return '';
    }
}