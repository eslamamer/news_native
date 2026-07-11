<?php render('admin.layouts.header', ['title' => trans('comment.comments')]);
     $comments = paginate('comments', limit:15)
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h2>{{trans('comment.comments')}}</h2>
</div>
<div class="table-responsive small">
     <table class="table table-striped table-sm">
          <thead>
               <tr>
                    <th scope="col">{{trans('comment.id')   }}</th>
                    <th scope="col">{{trans('comment.name')   }}</th>
                    <th scope="col">{{trans('comment.news')   }}</th>
                    <th scope="col">{{trans('comment.email')  }}</th>
                    <th scope="col">{{trans('comment.comment')}}</th>
                    <th scope="col">{{trans('comment.status')}}</th>
                    <th scope="col">{{trans('admin.actions')  }}</th>
               </tr>
          </thead>
          <tbody>
               <?php while($comment = mysqli_fetch_assoc($comments['data'])):?>
                    <tr>
                         <td>{{ $comment['id']     }}</td>
                         <td>{{ $comment['name']   }}</td>
                         <td>{{ $comment['news_id']}}</td>
                         <td>{{ $comment['email']  }}</td>
                         <td>{{ $comment['comment']}}</td>
                         <td>{{ trans('comments.'.$comment['status'])}}</td>
                         <td>
                              <a 
                                   class="text-decoration-none" 
                                   href="{{aurl('/comments/comment?id='.$comment['id'])}}"
                              >
                                   <i class="fa-regular fa-eye"></i>
                              </a>
                              <a 
                                   class="text-decoration-none" 
                                   href="{{aurl('/comments/edit?id='.$comment['id'])}}"
                              >
                                   <i class="fa-regular fa-pen-to-square"></i>
                              </a>
                         {{view_del(aurl('/comments/delete?id='.$comment['id']))}}
                         </td>
                    </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
    {{ $comments['render_pages'] }}
</main>
     <?php render('admin.layouts.footer'); ?>