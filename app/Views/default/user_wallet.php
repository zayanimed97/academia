<?php require_once 'common/header.php'; use CodeIgniter\I18n\Time; ?>
<style>
    table th{
        padding-bottom: 1em;
    }
</style>
        <div class="from-blue-500 bg-grey breadcrumb-area py-6 text-black">
            <div class="container mx-auto lg:pt-5">
                <div class="breadcrumb text-black">
                    <ul class="m-0">
                        <li>
                            <a href="<?= base_url() ?>"> <i class="icon-feather-home"></i> </a>
                        </li>
                        <li class="active">
                            <a href="#"><?php echo lang('front.title_page_user_wallet')?> </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_user_wallet')?> </div>
            </div>
        </div>
  <div class="container">


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
			
            <div class="grid lg:grid-cols-2 gap-8 md:mt-12" >
               
                <div class="bg-white rounded-md col-span-2">

                    <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">	
<div class="bg-green-500 border p-4 relative rounded-md uk-alert" uk-alert=""  id="warning_alert" >
                   
                
                    <p class="text-white text-opacity-75"><?php echo lang('front.field_expired_date')." : 31/12/".date('Y')?><br/>
					<?php if(session('user_data')['wallet']>0){?><button class="flex items-center justify-center h-10 mt-8 px-6 rounded-md bg-blue-600 text-white" uk-toggle="target: #wallet_modal"><?php echo lang('front.btn_transform_wallet_to_coupon')?></button><?php } ?>
					</p>
                </div>
			 </div>
 <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">					
							<h1><?php echo lang('front.title_section_historic_wallet')?> </h1>
                           <table id="basic-datatable" class="table col-span-2">
                                <thead class="border-b">
                                    <tr>
                                       <th><?php echo lang('front.field_cour')?></th>		
										<th><?php echo lang('app.field_date')?></th>
										<th><?php echo lang('app.field_amount')?></th>		
                                    </tr>
                                </thead>
                                <tbody class="mt-8">
							   
								<?php if(!empty($list)){
									foreach($list as $k=>$arg){?>
										<tr>
											 <td><?= $arg['item'] ?></td>
											 <td><?php echo date('d/m/Y',strtotime($arg['created_at'])) ?></td>
											 <td><?= number_format($arg['discount'],2,',','.') ?>€</td>
										</tr>
									<?php }
								}
									?>
                                    </tbody>
							</table>
                       
                    </div> 
                    
                </div>
				
				
				<div class="bg-white rounded-md col-span-2">

                   
 <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">					
							<h1><?php echo lang('front.title_section_user_coupon')?> </h1>
                           <table id="basic-datatable" class="table col-span-2">
                                <thead class="border-b">
                                    <tr>
                                       <th><?php echo lang('app.field_code')?></th>
										
										<th><?php echo lang('app.field_value')?></th>
										<th><?php echo lang('app.field_start_date')?></th>
										<th><?php echo lang('app.field_end_date')?></th>
										<th><?php echo lang('front.field_used')?></th>
                                    </tr>
                                </thead>
                                <tbody class="mt-8">
							   
								<?php if(!empty($list_coupon)){
									 foreach($list_coupon as $one_customer) { ?>
                                                    <tr>
                                                         <td><?php echo $one_customer['code']?></td>
														 
															<td><?php echo $one_customer['amount']; if($one_customer['type']=='percent') echo '%'; else echo '€'?></td>
															 <td><?php echo date('d/m/Y',strtotime($one_customer['start_date']))?></td>
															  <td><?php echo  date('d/m/Y',strtotime($one_customer['end_date']))?></td>
															 <td><?php if($one_customer['used']>0) echo lang('app.yes'); else echo lang('app.no');?></td>
														
                                                    </tr>
                                                    <?php } 
								}
									?>
                                    </tbody>
							</table>
                       
                    </div> 
                    
                </div>
				
            </div>
		

        <!-- This is the modal -->
	
<div id="wallet_modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
		<form method="post">
        <h2 class="uk-modal-title"><?php echo lang('front.title_modal_wallet_to_coupon')?></h2>
		<div id="" class="grid grid-cols-1 gap-3 lg:p-6 p-4">
		<p><?php echo str_replace('{x}',number_format(session('user_data')['wallet']),lang('front.msg_transform_wallet_to_coupon'))?></p>
		</div>
        <button class="uk-button uk-button-default uk-modal-close"  type="button"><?php echo lang('front.btn_close');?></button>
		<input type="submit" name="transform" value="<?php echo lang('front.btn_save')?>">
		</form>
    </div>
</div>   


        </div>
  
        <?= view($view_folder.'/common/footer') ?>
           
    <?php if(isset($settings['facebook_id'])){ ?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '<?= $settings['facebook_id'] ?>',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v12.0'
    });
  };
</script>
<?php } ?>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

    <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
 <script>
 
	function  get_details(id_cart){
		$.ajax({
			url:"<?php echo base_url('Ajax/get_details_cart')?>",
			method:"POST",
			data:{id_cart:id_cart}
	
		}).done(function(m){
			$("#details_list_items").html(m);
		});
	}
	
	
	
</script>
 <?= view($view_folder.'/common/close') ?>