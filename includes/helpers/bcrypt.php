<?php
    if(!function_exists('pass_hash')){
        function pass_hash(string $pass){
            $options = [
                'cost' => 4,
            ];
            return password_hash($pass, PASSWORD_BCRYPT, $options);
        }
    }

    //echo (pass_hash('eslam'));

    if(!function_exists('pass_verify')){
        function pass_verify(string $pass, string $hash){
            return password_verify($pass, $hash);
        }
    }