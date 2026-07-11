<?php

$data = validate(
    [
        // 'news_id'     => 'require|integer|exists:news,id',
        'name'        => 'require|string',
        'email'       => 'require|email',
        'comment'     => 'require|string',
        'status'      => 'require|in:show,hide'
    ],
    [
        // 'news_id'     => trans('comments.news_id'),
        'name'        => trans('comments.name'),
        'email'       => trans('comments.email'),
        'comment'     => trans('comments.comment'),
        'status'      => trans('comments.status')
    ],
    'api' );
$id= request('id');
$comment = fetch($id, 'comments');
if(empty($comment)){
    redirect(aurl('comments'));
}
update($id, 'comments', $data);
redirect(aurl('comments'));

