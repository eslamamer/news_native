<?php
    session('suc', 'data sent successfully ');
    //remove_session('suc');
    redirect($_SERVER['HTTP_REFERER']);
 ?>