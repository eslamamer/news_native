<?php
    $routes  = [];
    if(!function_exists('rout_get')){
        function rout_get(string $seg, $view = null){
          global $routes;
          $routes['get'][] = [
            "segment" => "/".ltrim($seg,"/"),
             "view"   => $view
             ];    
        }
    }

    if(!function_exists('rout_post')){
        function rout_post(string $seg, $view = null){
            global $routes;
            $routes['post'][] = [
            "segment" => "/".ltrim($seg,"/"),
            "view"    => $view
            ];    
        }
    }

    if(!function_exists('redirect')){
        function redirect(string $path){
            header('location: '.$path);
        }
    }

    if(!function_exists("view_init")){
        function view_init(){
            global $routes;
            $routes_get  = isset($routes['get']) ? $routes['get'] : [];
            $routes_post = isset($routes['post']) ? $routes['post'] : [];
            //$flage = false;
          if(!isset($_POST['_method'] )){
              foreach($routes_get as $rget){
                if(segment() == $rget['segment']){
                    render($rget['view']);
                    // $flage = true;
                    // break;
                }
                // if($flage == false && !is_null(segment()) && !in_array(segment(), array_column($routes_get, 'segment'))){
                //     render("404");
                // }
                }
            }

            if(isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 && strtolower($_POST['_method']) == 'post'){
                foreach($routes_post as $rpost){
                    if(segment() == $rpost['segment']){
                        render($rpost['view']);
                    }
                }
                if(isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(), array_column($routes_post, 'segment'))){
                        echo "<h1>404 page not found</h1>";
                }
            
            }
        }
    }

    if(!function_exists('url')){
        function url(string $segment){
            $url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on" ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'];
            $url .= "/".ltrim($segment, "/");
            return $url;
            }
        }

    if(!function_exists('aurl')){
        function aurl(string $segment){
            $url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on" ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'];
            $url .= ADMIN."/".ltrim($segment, "/");
            return $url;
        }
    }

    if(!function_exists('segment')){
        function segment(){
            $remQuaryPram = explode('?', $_SERVER['REQUEST_URI']);
            return '/' . ltrim($remQuaryPram[0], '/');
        }
    }