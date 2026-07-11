<?php
$data = validate(
    [
        'news_id'     => 'require|integer|exists:news,id',
        'name'        => 'require|string',
        'email'       => 'require|email',
        'comment'     => 'require|string',
    ],
    [
        'news_id'     => trans('main.news_id'),
        'name'        => trans('main.name'),
        'email'       => trans('main.email'),
        'comment'     => trans('main.comment'),
    ],
    'api' );

if (!empty($data)) {
    adding('comments', $data);
    echo api([
            'status'  => 'success',
            'message' => 'comment added'
        ]);
}
