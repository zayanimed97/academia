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
                            <a href="#"><?php echo lang('front.title_page_user_cart')?> </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_user_cart')?> </div>
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
                       
                           <table id="basic-datatable" class="table col-span-2">
                                <thead class="border-b">
                                    <tr>
									<th>#</th>
                                       <th><?php echo lang('app.field_total')?></th>		
										<th><?php echo lang('app.field_date')?></th>
										<th><?php echo lang('app.field_status')?></th>		
										
										<th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="mt-8">
							   
								<?php if(!empty($list)){
									foreach($list as $k=>$arg){?>
									<tr>
									 <td><?= $arg['id'] ?></td>
									 <td><?= number_format($arg['total_paid'],2,',','.') ?>€</td>
									<td><?php echo date('d/m/Y',strtotime($arg['date'])) ?></td>
									 <td><?= $arg['status_label'] ?></td>
									<td class="row pt-1">
										<a href="#" class="text-purple-600"  uk-toggle="target: #cart_details" onclick="get_details('<?php echo $arg['id']?>')"><?php echo lang('front.btn_details')?></a>
									   <?php if($arg['fattureincloud']!=''){
										   $det=json_decode($arg['fattureincloud'],true);
										  
										   if(isset($det['new_id']) && $det['new_id']!=""){?>
										  
											<a class="text-purple-600" target="_blank" href="<?php echo base_url('getInvoiceFattureCloud/'.$det['new_id'])?>">
												&nbsp;|&nbsp;<?php echo lang('front.btn_invoice')?>
											</a>
									   
									   <?php } }?>
									</td>
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
<div id="cart_details" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title"><?php echo lang('front.title_modal_details_cart')?></h2>
		<div id="details_list_items" class="grid grid-cols-2 gap-3 lg:p-6 p-4">
		
		</div>
        <button class="uk-button uk-button-default uk-modal-close"  type="button"><?php echo lang('front.btn_close');?></button>
    </div>
</div>  


        </div>
  
        <?= view($view_folder.'/common/footer') ?>
           
    <?php if(isset($settings['facebook_id'])){ ?>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
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
	
	function shareFacebook_wallet(rowid, url){

			FB.ui({
                        method: 'share',
                        href: url,
                    }, response => {
                        if(typeof(response) == 'object' && Object.keys(response).length == 0){
                            let fields = {rowid: rowid, url: url, platform: 'facebook'};
                            $.ajax({
                                    url:"<?php echo base_url('/Ajax/postShared')?>",
                                    method:"POST",
                                    data:fields
                            
                                }).done(function(res) {  
													res = JSON.parse(res);
                                                  
                                                    this.flashMessage.status = res.status, 
                                                    this.flashMessage.message = res.message;
													$("#user_menu_wallet").html(res.wallet);
                                                });
                        }
                    });
	}		
	
</script>
 <?= view($view_folder.'/common/close') ?>