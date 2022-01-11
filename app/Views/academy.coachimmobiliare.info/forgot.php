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
           
            <form method="POST" action="<?= base_url('/forgotPassword') ?>" class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
			 <?php if(isset($validation)){ ?>
            <div class="uk-alert-danger" uk-alert>
                <!-- <a class="uk-alert-close" uk-close></a> -->
                <p><?= $validation ?? '' ?></p>
            </div>
            <?php } ?>
			   <?php if(isset($_SESSION['error']) ){ ?>
            <div class="uk-alert-danger" uk-alert>
                <!-- <a class="uk-alert-close" uk-close></a> -->
                <p><?= $_SESSION['error'] ?? '' ?></p>
            </div>
            <?php unset($_SESSION['error']); } ?>
			 <?php if( isset($success_register)) { ?>
            <div class="uk-alert-success" uk-alert>             
                <p><?= $success_register ?? '' ?></p>
            </div>
            <?php } ?>
			<?php //echo $validation->listErrors()
    if(isset($error)){?>
   <div class="uk-alert-danger" uk-alert>
        <p><?php echo $error?></p>
    </div>
<?php }?>
<?php //echo $validation->listErrors()
    if(isset($success)){?>
    <div class="uk-alert-success" uk-alert>             
        <p><?php echo $success?></p>
    </div>
<?php }?>
                <h1 class="lg:text-2xl text-xl font-semibold mb-6"> <?php echo lang('front.title_page_forgot')?> </h1>
				<p class="mb-6" style="font-size: 13px;line-height: 17px;"><?php echo lang('front.help_text_page_forgot')?></p>

                <div>
                    <label class="mb-0" for="username"> <?php echo lang('front.field_email')?> </label>
                    <input type="text" name="email" id="username" placeholder="Email" class="with-border bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                </div>
               

                <div>
                    <button name="recuperate" class="bg-blue-600 font-semibold p-2.5 mt-5 rounded-md text-center text-white w-full">
                        <?php echo lang('front.btn_recover')?></button>
                </div>

                <div class="flex justify-between">
                    <a href="<?= base_url('/user/login') ?>"> <?php echo lang('front.help_have_account')?> </a>
                    <a href="<?= base_url('/register') ?>"  class="txtlinkcolor-primary"> <?php echo lang('front.help_havnot_account')?> </a>
                </div>

               


            </form>

        </div>

    </div>
<?= view($view_folder.'/common/footer') ?>
<?= view($view_folder.'/common/close') ?>
