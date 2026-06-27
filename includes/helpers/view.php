<?php
    if(!function_exists('render')){
        function render(string $path, array $title = []){
            $file = config('view.path').str_replace('.', '/', $path).'.php';
            if(file_exists($file)){
                $view = $file;
            }else{
                $view = config('view.path').'404.php';
            }
            render_engine($view, $title ); 
        }
    }

    if(!function_exists('render_engine')){
        function render_engine(string $view, array $title){
            if(is_array($title) && !is_null($title)){
                    foreach($title as $key=>$value){
                        $$key = $value;
                    }
                }
            $file = file_get_contents($view);
            $file_path = explode('/', $view);
            $file_name = md5(end($file_path));
            $store_path = base_path('/../storage/views/'.$file_name);
            $file = str_replace('{{', '<?= ', $file);
            $file = str_replace('}}', '?>' , $file);
            file_put_contents($store_path, $file);
            include $store_path;
        }
    }