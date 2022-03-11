<?php require_once 'common/header.php'; use CodeIgniter\I18n\Time; ?>
<style>
    table th{padding-bottom: 1em;}
	.table th{padding: 0.5em;}
	.table td{padding-right: 0.5em;padding-left: 0.5em;}
	.uk-accordion-title {border-bottom: 1px solid #e5e5e5;}
	.uk-accordion-title:hover {color: #03b5d2;text-decoration: none;border-bottom: 1px solid #e5e5e5;}
	.uk-accordion-title .title {padding: 1em 1.5em 1em 0;text-align: left;width: 100%;color: #7288a2;font-size: 1.15rem;}
	.uk-accordion-title[aria-expanded='true'] {border-bottom: 1px solid #03b5d2;}
	.uk-accordion-title[aria-expanded='true'] {color: #03b5d2;}

</style>

        <div class="from-blue-500 bg-grey breadcrumb-area py-6 text-black">
            <div class="container mx-auto lg:pt-5">
                <div class="breadcrumb text-black">
                    <ul class="m-0">
                        <li>
                            <a href="<?= base_url() ?>"> <i class="icon-feather-home"></i> </a>
                        </li>
                        <li class="active">
                            <a href="#"><?php echo lang('front.title_page_user_participation')?> </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_user_participation')?> </div>
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
<?php if(!empty($list)){?>
                    <div class="grid  gap-3 lg:p-6 p-4">					
                         <div uk-accordion="multiple: false" class="space-y-3">
						 <?php $type_cours=json_decode($settings['type_cours'] ?? '',true);
						 foreach($list as $id_corsi=>$ll){?> 
								<div  class="pt-2">
									<a class="uk-accordion-title text-md mx-2 font-semibold" href="#">  <div class="mb-1 text-sm font-medium title flex">
									<?php $default_image=base_url('front/assets/images/courses/img-4.jpg');
								switch($ll[0]['tipologia_corsi']){
									case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!="") $default_image=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") $default_image=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") $default_image=base_url('uploads/'.$settings['default_img_webinar']); break;
								}?>
								<img style="display:inline;width:100px;margin-right: 20px;" src="<?= $ll[0]['inf_corsi']['foto'] ? base_url('uploads/corsi/'.$ll[0]['inf_corsi']['foto']) : $default_image ?>" alt="" class="">
								<div class="flex justify-between items-center w-full">
									<span><?php	 echo $ll[0]['corso_title'] ?? ('Corso #'.$id_corsi)?></span>
									<div>
									<span><?php echo $type_cours[$ll[0]['tipologia_corsi']] ?? $ll[0]['tipologia_corsi']?></span>
									</div>
								</div>
								
								
								</div> </a>
									<div class="uk-accordion-content mt-0 mx-2" style="background-color:#f3f6f7;">
									  <table id="basic-datatable" class="table col-span-2 w-full">
											<thead class="border-b">
												<tr>
													<th><?php echo lang('front.field_modulo')?></th>
													<th><?php echo lang('front.field_date_inscrit')?></th>
													<th><?php echo lang('front.field_type_cours')?></th>
													<th><?php echo lang('front.field_date_session')?></th>
													<th><?php echo lang('front.field_type_payment')?></th>

													<th></th>
												</tr>
											</thead>
											<tbody class="mt-8">
													<?php
												foreach($ll as $k=>$v){?>
												 <tr>
													<td class="py-6 border-b flex items-center">
													<img style="display:inline;width:100px;margin-right: 20px;" src="<?= $v['foto'] ? base_url('uploads/corsi/'.$v['foto']) : $default_image ?>" alt="" class="">
														<!--span class="icon-material-outline-shopping-cart text-lg mr-4"></span-->
														<a class="text-purple-600" href="<?php echo base_url('user/participation/'.$v['id'])?>">
															<?php echo $v['title']?>
														</a>
													</td>

													<td class="py-6 border-b"><?php echo Time::parse($v['date'], 'Europe/Rome', 'it_IT')->toLocalizedString('d MMMM Y')?></td>
													<td class="py-6 border-b"><?php echo $type_cours[$v['tipologia_corsi']] ?? $v['tipologia_corsi']?></td>
													<td class="py-6 border-b"><?php if($v['session_date']!="") echo Time::parse($v['session_date'], 'Europe/Rome', 'it_IT')->toLocalizedString('d MMMM Y')?></td>
													<td class="py-6 border-b"><?php echo $v['payment_method']?></td>
													<?php if($ll[0]['tipologia_corsi'] == 'eBook'){ ?>
														<td class="py-6 border-b">
															<div>
																<a class="button flex items-center" href="<?php echo base_url('user/participation/'.$v['id'])?>"><span class="icon-feather-download mr-4"></span><span><?php echo lang('front.btn_download_attachment')?></span></a>
															</div>
														</td>
													<?php } else if($ll[0]['tipologia_corsi'] == 'online'){ ?>
														<td class="py-6 border-b">
															<div>
																<a class="button flex items-center" href="<?php echo base_url('user/participation/'.$v['id'])?>"><span class="icon-feather-play mr-4"></span><span><?php echo lang('front.btn_play_video')?></span></a>
															</div>
														</td>
													<?php } else { ?>
														<td class="py-6 border-b">
															<div>
																<a class="button flex items-center" href="<?php echo base_url('user/participation/'.$v['id'])?>"><span><?php echo lang('front.btn_login')?></span></a>
															</div>
														</td>
													<?php } ?>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
						 <?php } ?>
						 </div>
<?php } ?>
                        
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