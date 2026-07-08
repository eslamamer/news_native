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
    'api'
);
//var_dump($data);
if (!empty($data)) {
    adding('comments', $data);
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    echo json_encode(
        [
            'status'  => 'success',
            'message' => 'comment added'
        ],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
}
   // redirect($_SERVER['HTTP_REFERER']);
