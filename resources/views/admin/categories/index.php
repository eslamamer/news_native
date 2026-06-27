<?php render('admin.layouts.header', ['title' => trans('cat.categories')]);
     $categories = paginate('categories', limit:2)
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h2>{{trans('cat.categories')}}</h2>
     <a class="btn btn-primary" href="{{aurl('/categories/create')}}">{{trans('admin.create')}}</a>
</div>
<div class="table-responsive small">
     <table class="table table-striped table-sm">
          <thead>
               <tr>
                    <th scope="col">{{trans('cat.id')}}</th>
                    <th scope="col">{{trans('cat.name')}}</th>
                    <th scope="col">{{trans('cat.icon')}}</th>
                    <th scope="col">{{trans('cat.description')}}</th>
                    <th scope="col">{{trans('admin.actions')}}</th>
               </tr>
          </thead>
          <tbody>
               <?php while($cat = mysqli_fetch_assoc($categories['data'])):?>
                    <tr>
                    <td><?= $cat['id']  ?></td>
                    <td><?= $cat['name']?></td>
                    <td>{{view_img(icon_url($cat['icon']))}}</td>
                    <td><?= $cat['description']?></td>
                    <td>
                         <a 
                              class="text-decoration-none" 
                              href="{{aurl('/categories/category?id='.$cat['id'])}}"
                         >
                              <i class="fa-regular fa-eye"></i>
                         </a>
                         <a 
                              class="text-decoration-none" 
                              href="{{aurl('/categories/edit?id='.$cat['id'])}}"
                         >
                              <i class="fa-regular fa-pen-to-square"></i>
                         </a>
                        {{view_del(aurl('/categories/delete?id='.$cat['id']))}}
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
    {{ $categories['render_pages'] }}
</main>
     <?php render('admin.layouts.footer'); ?>