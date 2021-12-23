<?php require_once 'common/header.php' ?>
  <div class="container">

            <h3 class="text-2xl font-medium mb-5"> <?php echo lang('front.title_page_user_participation')?> </h3>

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
			
            <div class="grid lg:grid-cols-3 gap-8 md:mt-12" >
               
                <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">

                    <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">
					
                       
                           <table id="basic-datatable" class="table">
							   <tr>
									<th><?php echo lang('front.field_modulo')?></th>
									<th><?php echo lang('front.field_date_inscrit')?></th>
									<th><?php echo lang('front.field_type_cours')?></th>
									<th><?php echo lang('front.field_date_session')?></th>
								</tr>
								<?php if(!empty($list)){
									foreach($list as $k=>$v){?>
									 <tr>
										<td><a href="<?php echo base_url('user/participation/'.$v['id'])?>"><?php echo $v['title']?></a></td>
										<td><?php echo date('d/m/Y',strtotime($v['date']))?></td>
										<td><?php echo $type_cours[$v['tipologia_corsi']] ?? $v['tipologia_corsi']?></td>
										<td><?php if($v['session_date']!="") echo date('d/m/Y',strtotime($v['session_date']))?></td>
									</tr>
									<?php }
								}
									?>
							</table>
                       
                    </div> 
                    
                </div>
            </div>
		

          


        </div>
  
        <?= view($view_folder.'/common/footer') ?>
           
    
    <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
 <script>
 
	
	
	
</script>
 <?= view($view_folder.'/common/close') ?>