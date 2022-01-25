<?= view($view_folder.'/common/header') ?>
  
<style>
    .border{
        /* border-width: 1px !important; */
        border: 1px solid rgb(229, 231, 235) !important;
    }
    .parsley-errors-list{
        color: red;
        font-size: .75 rem;
    }
</style>
    <div>

        <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
           
          
			 <?php if(isset($validation)){ ?>
            <div class="uk-alert-danger" uk-alert>
                <!-- <a class="uk-alert-close" uk-close></a> -->
                <p><?= $validation ?? '' ?></p>
            </div>
            <?php } ?>
			   
			
<?php //echo $validation->listErrors()
    if(isset($success)){?>
    <div class="uk-alert-success" uk-alert>             
        <p><?php echo $success?></p>
    </div>
<?php }?>
                <h1 class="lg:text-2xl text-xl font-semibold mb-6"> <?php echo lang('front.title_page_reset')?> </h1>
<?php //echo $validation->listErrors()
    if(isset($error)){?>
   <div class="uk-alert-danger" uk-alert>
        <p><?php echo $error?></p>
    </div>
<?php } else{?>
  <form method="POST" action="<?=  base_url().'/ResetPassword/'.$email."/".$token?>" class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
                <div>
                    <label class="mb-0" for="username"> <?php echo lang('front.field_password')?> </label>
                    <input type="text" name="password" id="password" placeholder="password" class="with-border bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                </div>
                <div>
                    <label class="mb-0" for="username"> <?php echo lang('front.field_confirm_password')?> </label>
                    <input type="text" name="confirm_password" id="confirm_password" placeholder="<?php echo lang('front.field_confirm_password')?>" class="with-border bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                </div>

                <div>
                    <button name="reset" class="bg-blue-600 font-semibold p-2.5 mt-5 rounded-md text-center text-white w-full">
                        <?php echo lang('front.btn_reset')?></button>
                </div>

                <div class="flex justify-between">
                    <a href="<?= base_url('/user/login') ?>"> <?php echo lang('front.help_have_account')?> </a>
                    <a href="<?= base_url('/register') ?>"> <?php echo lang('front.help_havnot_account')?> </a>
                </div>

               


            </form>
<?php } ?>
        </div>

    </div>
<?= view($view_folder.'/common/footer') ?>
<?= view($view_folder.'/common/close') ?>
