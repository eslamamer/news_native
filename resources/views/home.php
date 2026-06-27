<?php render("layouts.header", ['title' => trans('main.home')]);?> 
    <h1><?= trans('main.home'); ?></h1>
    <?php if(has_session('suc')) { echo session_flash('suc');} ?>
    <form 
        method="post" 
        action="<?= url('/upload'); ?>
    ">
        <label for="name">{{trans('main.name')}}</label>
        <input 
            type="text" 
            name="name" 
            value="<?= old_values('name') ?>"
            placeholder="<?= trans('main.name') ?>"  
            class="form-control" 
        />
        <?= all_errors('name') ?>
        <label for="name"><?= trans('main.email') ?></label>
        <input 
            type="text" 
            name="email" 
            value="<?= old_values('email') ?>"
            placeholder="<?= trans('main.email') ?>" 
            class="form-control" 
        />
        <?= all_errors('email') ?>
        <label for="name"><?= trans('main.age') ?></label>
        <input 
            type="text" 
            name="age" 
            value="<?= old_values('age') ?>"  
            placeholder="<?= trans('main.age') ?>"   
            class="form-control" 
        />
        <?= all_errors('age') ?> 
        <label for="name"><?= trans('main.address') ?></label>
        <input 
            type="text" 
            name="address" 
            value="<?= old_values('address') ?>"  
            placeholder="<?= trans('main.address') ?>"   
            class="form-control"
        />
        <?= all_errors('address') ?>         
        <input type="hidden" value = "post" name = "_method" />
        <input type="submit" value = "<?= trans('main.submit') ?>" class="btn btn-success"/>     
    </form>
    <!-- <form method="post" action="<?= url('upload')?>" enctype="multipart/form-data">
        <input type="file" name="image" class="form-control">
        <input type="hidden" name="_method" value="post">
        <input type="submit" value="send" class="btn btn-success">
    </form> -->
    <!-- <a href="<?= url('storage/user/2/DSC.pdf') ?>">View Image</a> -->
<?php
//var_dump(session('validate'));
render("layouts.footer");?>