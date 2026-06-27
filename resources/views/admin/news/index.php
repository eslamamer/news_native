<?php render('admin.layouts.header', ['title' => trans('news.news')]);
     $join      = "join categories on news.cat_id  = categories.id 
                   join users      on news.user_id = users.id";

     $col       = "news.id         as id,
                   users.id        as userid,
                   users.name      as auther,
                   categories.id   as catid,
                   categories.name as catname,
                   news.image,
                   news.title,
                   news.content,
                   news.created_at,
                   news.updated_at";
     $news_list =  paginate('news',$join, $col, 2); 
 
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h2>{{trans('news.news')}}</h2>
     <a class="btn btn-primary" href="{{aurl('/news/create')}}">{{trans('admin.create')}}</a>
</div>
<div class="table-responsive small">
     <table class="table table-striped table-sm">
          <thead>
               <tr>
                    <th scope="col">{{trans('news.id')}}</th>
                    <th scope="col">{{trans('news.title')}}</th>
                    <th scope="col">{{trans('news.image')}}</th>
                    <th scope="col">{{trans('news.content')}}</th>
                    <th scope="col">{{trans('news.created_at')}}</th>
                    <th scope="col">{{trans('news.updated_at')}}</th>
                    <th scope="col">{{trans('news.auther')}}</th>
                    <th scope="col">{{trans('cat.name')}}</th>
                    <th scope="col">{{trans('admin.actions')}}</th>
               </tr>
          </thead>
          <tbody>
               <?php while($news = mysqli_fetch_assoc($news_list['data'])):?>
               <tr>
                    <td><?= $news['id']  ?></td>
                    <td><?= $news['title']?></td>
                    <td>{{isset($news['image']) ? view_img(icon_url($news['image'])) : ""}}</td>
                    <td><?= $news['content']  ?></td>
                    <td><?= $news['created_at']?></td>
                    <td><?= $news['updated_at']  ?></td>
                    <td><?= $news['auther']?></td>
                    <td><?= $news['catname'] ?></td>
                    <td>
                         <a 
                              class="text-decoration-none" 
                              href="{{aurl('/news/news?id='.$news['id'])}}"
                         >
                              <i class="fa-regular fa-eye"></i>
                         </a>
                         <a 
                              class="text-decoration-none" 
                              href="{{aurl('/news/edit?id='.$news['id'])}}"
                         >
                              <i class="fa-regular fa-pen-to-square"></i>
                         </a>
                         {{view_del(aurl('/news/delete?id='.$news['id']))}}
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
    {{ $news_list['render_pages'] }}
</main>
     <?php render('admin.layouts.footer'); ?>