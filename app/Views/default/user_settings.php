<?php require_once 'common/header.php' ?>
  <div class="container">

            <h3 class="text-2xl font-medium mb-5"> <?php echo lang('front.title_page_user_settings')?> </h3>

           <div class="bg-yellow-500 border p-4 relative rounded-md uk-alert" uk-alert="" id="error_alert" style="display:none">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                   
                    <p class="text-white text-opacity-75" id="error_text"></p>
                </div>
             
                <div class="bg-green-500 border p-4 relative rounded-md uk-alert" uk-alert=""  id="success_alert" style="display:none">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                
                    <p class="text-white text-opacity-75"  id="success_text"></p>
                </div>
          
            <!-- Basic information -->
			 <form method="POST"  id="profile_form" onsubmit="return valid_user();">
            <div class="grid lg:grid-cols-2 gap-8 md:mt-12" >
               
                <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">

                    <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">
					
                       
                        <div class="col-span-2">
                            <label for="email"> Email </label>
                            <input type="text" placeholder="" id="email" name="email" class="shadow-none with-border" value="<?= $user['email'] ?>">
                        </div>
						<div>
                            <label for="last-name"><?php echo lang('front.field_password')?></label>
                            <input type="password" placeholder="" id="password" name="password" class="shadow-none with-border" >
                        </div>
						<div>
                            <label for="last-name"><?php echo lang('front.field_confirm_password')?></label>
                            <input type="password" placeholder="" id="confirm_password" name="confirm_password" class="shadow-none with-border">
                        </div>
						
						
						 <div class="flex justify-center col-span-2">
                                        
                                        <button name="submit" type="submit"  class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white w-1/3">
                                            <span class="md:block hidden"><?php echo lang('front.btn_save')?></span><span class="md:hidden block"><?php echo lang('front.btn_save')?></span>
                                            <i class="icon-feather-chevron-right ml-1"></i>
                                        </button>
                                    </div>
						
                     
                       
                       
                    </div> 
                    
                </div>
            </div>
		</form>

          


        </div>
  
        <?= view($view_folder.'/common/footer') ?>
           
    
    <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
 <script>
 
	
	
	function valid_user(){
		$("#success_alert").hide('slow');
		$("#error_alert").hide('slow');
		var fields = $( "#profile_form" ).serializeArray();
		$.ajax({
				  url:"<?php echo base_url('user/setting_submit')?>",
				  method:"POST",
				 data:fields
				  
			}).done(function(data){
				
			var obj=JSON.parse(data);
			//console.log(obj);
				if(obj.error==true){
					$("#error_text").html(obj.validation);
					$("#error_alert").show('slow');
				
					return false;
				}
				else{ 
					$("#success_text").html("<?php echo lang('front.success_update')?>");
					$("#success_alert").show('slow');
					$("#password").val();
					$("#confirm_password").val();
					return false;
				}
			
			});
			return false;
	}
</script>
 <?= view($view_folder.'/common/close') ?>