<?php render('admin.layouts.header', ['title' => trans('admin.edit')]);
    $id = intval(request('id'));
    $comment = fetch($id, 'comments');
    if(empty($comment)){
        redirect(aurl('comments'));
    }
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('comments.comment')}} - {{trans('admin.edit')}}</h2>
        <a class="btn btn-info" href="{{aurl('comments')}}">{{trans('comments.comment')}}</a>
    </div>
    <form action="{{aurl('/comments/update?id='.$comment['id'])}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="news" id="news" value="{{$comment['news_id']}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('comment.name')}}</label>
                    <input id="name" type="text" name="name" value="{{$comment['name']}}" class="form-control mb-3" placeholder="{{trans('comment.name')}}" />
                </div>
                {{ all_errors('name'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{trans('comment.email')}}</label>
                    <input id="email" type="text" name="email" value="{{$comment['email']}}" class="form-control mb-3" placeholder="{{trans('comment.email')}}" />
                </div>
                {{ all_errors('email'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="news">{{trans('comment.news')}}</label>
                    <a href="{{aurl('news/news?id='.$comment['news_id'])}}">{{$comment['news_id']}}</a>
                </div>
                {{ all_errors('news'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">{{trans('comment.status')}}</label>
                    <select class="form-select" name="status" id="status">
                        <option value="show" {{$comment['status'] == 'show' ? 'selected' : ''}}>{{trans('comment.show')}}</option>
                        <option value="hide" {{$comment['status'] == 'hide' ? 'selected' : ''}}>{{trans('comment.hide')}}</option>
                    </select>
                </div>
                {{ all_errors('status'); }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment">{{trans('comments.comment')}}</label>
                <textarea id="comment" name="comment" class="form-control mb-3" placeholder="{{trans('comment.comment')}}">{{$comment['comment']}}</textarea>
            </div>
            {{ all_errors('comment'); }}
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('comment.save')}}"/>
    </form>
</main>
<?php render('admin.layouts.footer'); ?>