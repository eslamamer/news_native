<!DOCTYPE html>
<?php
    if(has_session('lang')){
        $dir = session('lang') == 'ar' ? 'rtl' : 'ltr';
        $lang = session('lang');
     }else{
        $dir = 'ltr' ;
        $lang = 'en' ;          
    }
?>
<html lang =<?= $lang; ?> dir=<?= $dir; ?> />
<head>
    <meta charset="UTF-8">
     <?php if(session('lang') == 'en') : ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link href="{{url('assets/front/dist/css')}}/blog.css" rel="stylesheet" />
        <link href="{{url('assets/front/dist/css')}}/bootstrap.min.css" rel="stylesheet" />
    <?php else: ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css">
        <link href="{{url('assets/front/dist/css')}}/blog.rtl.css" rel="stylesheet" />
        <link href="{{url('assets/front/dist/css')}}/bootstrap.rtl.min.css" rel="stylesheet" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) && !empty($title) ? $title : 'Project' ?></title>
</head>
<body>
    <?php
        render("layouts.navbar");
        //$seg = !is_null(segment()) ? segment() :'/';
        session('lang');
        //remove_session('lang');