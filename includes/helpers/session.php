<?php
//     if(!function_exists('session')){
//         function session(string $key, mixed $value = null){
//             if(!is_null($value)){
//                 $_SESSION[$key] = $value;//encrypt($value, '555');
//             }
//             return isset($_SESSION[$key])? $_SESSION[$key] : ""; //decrypt($_SESSION[$key],'555') : "";
//         }
//     }

//     if(!function_exists('has_session')){
//         function has_session(string $key): bool{
//             return isset($_SESSION[$key]);
//         }
//     }

//    if(!function_exists('session_flash')){
//         function session_flash(string $key, mixed $value = null){
//             if(!is_null($value)){
//                 // Encrypt before storing so session() can decrypt it correctly
//                 $_SESSION[$key] = $value;//encrypt($value, '555');
//             }
//             // Decrypt before returning, consistent with how session() reads
//             $session = isset($_SESSION[$key]) ? $_SESSION[$key] : ""; //decrypt($_SESSION[$key], '555') : null;
//             remove_session($key);
//             return $session;
//         }
//     }

//     if(!function_exists('remove_session')){
//         function remove_session(string $key):void{
//             if (isset($_SESSION[$key])) {
//             unset($_SESSION[$key]);
//         }        }
//     }

//     if(!function_exists('remove_all_sessions')){
//         function remove_all_sessions(){
//             session_destroy();
//         }   
//     }


/**
 * Get or set a session value.
 *
 * @param string $key The key of the session value.
 * @param mixed|null $value The value to set for the session key.
 * @return mixed The decrypted session value or an empty string if not found.
 */
if (!function_exists('session')) {
    function session(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }
}

/**
 * Check if a session key exists.
 *
 * @param string $key The key to check in the session.
 * @return mixed True if the key exists, false otherwise.
 */
if (!function_exists('has_session')) {
    function has_session(string $key): mixed
    {
        return isset($_SESSION[$key]);
    }
}

/**
 * Get or set a flash session value.
 *
 * @param string $key The key of the flash session value.
 * @param mixed|null $value The value to set for the flash session key.
 * @return mixed The flash session value.
 */
if (!function_exists('session_flash')) {
    function session_flash(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = encrypt($value);
        }
        $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
        remove_session($key);
        return $session;
    }
}

/**
 * Forget a specific session key.
 *
 * @param string $key The key to forget in the session.
 * @return void
 */
if (!function_exists('remove_session')) {
    function remove_session(string $key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}

/**
 * Delete all session data.
 * @return void
 */
if (!function_exists('remove_all_sessions')) {
    function remove_all_sessions()
    {
        session_destroy();
    }
}