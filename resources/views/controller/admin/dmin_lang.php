<?php
    if(in_array(request('lang'), ['en', 'ar'])){
        set_lang(request('lang'));
        redirect($_SERVER['HTTP_REFERER']);
    }