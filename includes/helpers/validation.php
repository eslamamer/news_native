<?php
    if(!function_exists('validate')) {
        function validate(array $attrs, array $trans = [], $http_header = 'redirect'){
            $errors = [];
            $values = [];
            foreach($attrs as $attr=>$rules){
                $attr_errors = [];
                $value = !is_null(request($attr))  ? request($attr) : ''   ;
                $values[$attr] = $value;
                
                $trans_attr = isset($trans[$attr]) ? $trans[$attr]  : $attr;
                foreach(explode('|', $rules) as $rule){
                    //var_dump($rule);
                    if($rule === 'email' &&  !filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.email'));
                    }elseif($rule === 'require' && (empty($value) || is_null($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])))){
                        $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.require'));
                    }elseif ($rule === 'integer' && filter_var($value, FILTER_VALIDATE_INT) === false) {
                        $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.integer'));
                    }elseif ($rule === 'string' && !is_string($value)) {
                        $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.string'));
                    }elseif ($rule === 'image' && (!empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false)) {
                        $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.image'));
                    }elseif(preg_match('/^in/i', $rule)){
                        $ex_rul = explode(':', $rule);
                        if(isset($ex_rul[1])){
                            $in = explode(',',$ex_rul[1]);
                            if(is_array($in) && !empty($in) && !in_array($value, $in)){
                                $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.user_type'));
                            }
                        }
                    }elseif(preg_match('/^unique/i', $rule)){
                        $table_ex = explode(':', $rule);
                        $table_feild = count($table_ex) > 1 ? explode(',', $table_ex[1]) : "";
                        $table = $table_feild[0];
                        $sql = "where ";
                        $feild = "";
                        if(count($table_feild) > 1 ){
                            $exeption = isset($table_feild[2]) ? "and id!= $table_feild[2]" : "";
                            $feild    = isset($table_feild[1]) ? $table_feild[1] : $attr ;
                            $sql     .= $feild ." = '{$values[$feild]}' ".$exeption;
                         }else{
                             $sql .= $attr ."= '{$values[$attr]}'";
                        }     
                        $user = search($table , $sql)['query'];
                        if(mysqli_num_rows($user) > 0){
                            $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.uniqe'));
                        }
                    }elseif(preg_match('/^exists/i', $rule)){
                        $table_ex = explode(':', $rule);
                        $table_feild = count($table_ex) > 1 ? explode(',', $table_ex[1]) : "";
                        $table = $table_feild[0];
                        $sql = "where ";
                        $feild = "";
                        if(count($table_feild) > 1 ){
                            $feild    = isset($table_feild[1]) ? $table_feild[1] : $attr ;
                            $sql     .= $feild ." = '{$values[$attr]}' ";
                        }else{
                            $sql .= 'id' ."= '{$values[$attr]}'";
                        }   
                        $news = search($table , $sql)['query'];
                        if(mysqli_num_rows($news) <= 0){
                            $attr_errors[]= str_replace(':attr', $trans_attr, trans('validation.exist'));
                       }
                     }
                }
                if(is_array($attr_errors) && count($attr_errors) > 0){
                $errors[$attr] = $attr_errors;
                }
            }
            if(count($errors) > 0){
                if($http_header == 'redirect'){
                    session('errors', json_encode($errors));
                    session('old', json_encode($values));
                    redirect($_SERVER['HTTP_REFERER']);
                }elseif($http_header == 'api'){
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(422);
                    echo json_encode($errors, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE); 
                    exit;
                }
                
            }else{
                    return $values;
            }
        }
    }

    if(!function_exists('errors')) {
        function errors($offset = null){
            $arr = json_decode(session('errors'), true);
            if(isset($arr[$offset])){
                $text = $arr[$offset];
                unset($arr[$offset]);
               // session_flash('errors');
                if(!empty($text)){
                    session('errors', json_encode($arr));
                }
                return is_array($text)?$text:[];
            }elseif(!empty($arr)){
                return $arr;
            }else{
                return [];
            }
        }
    }

    if(!function_exists('all_errors')){
        function all_errors(string $offset){
            $attr_error = '<div>';
            foreach(errors($offset) as $error){
                if(is_string($error)){
                    $attr_error .= "<p class='text-danger'> $error </p>";
                }
            }
            $attr_error .= '</div>';
            return $attr_error;
        }
    }

    if(!function_exists('old_values')){
        function old_values(string $req){
            $old_values = json_decode(session('old'), true);
            if(is_array($old_values) && !empty($old_values) && array_key_exists($req, $old_values)){
                return $old_values[$req];
            }
            return '';
        }
    }