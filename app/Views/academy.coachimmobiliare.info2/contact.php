<?= view($view_folder.'/common/header') ?>

		<div class="uk-sticky-placeholder" style="height: 72px; margin: 0px;"></div>
		<!--  breadcrumb -->
        <div class="from-blue-500 bg-grey breadcrumb-area py-6 text-black">
            <div class="container mx-auto lg:pt-5">
                <div class="breadcrumb text-black">
                    <ul class="m-0">
                        <li>
                            <a href="<?= base_url() ?>"> <i class="icon-feather-home"></i> </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>">Home</a>
                        </li> 
                        <li class="active">
                            <a href="#"><?php echo lang('front.menu_contact')?> </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_contact')?> </div>
            </div>
        </div>

        <div class="lg:py-10 py-5" x-data="getResData">        
     		<div class="container">
				<div class="lg:w-12/12">
					<h1 class="lg:text-2xl text-xl font-semibold mb-1"> <?php echo $inf_page['title']?> </h1>
					<p class="mb-6 mt-1"><?php echo lang('front.help_text_page_contact')?></p>
				</div>
				<div class="lg:flex lg:space-x-4 lg:-mx-4">
					
                <div class="lg:w-9/12 lg:space-y-6">
                    
                    <div class="tube-card">

                        <div class="md:p-6 p-4">

                            
                            <div class="space-y-3">
                              <form method="POST" action="<?= base_url($contact_page['url']) ?>" class="grid sm:grid-cols-2 gap-x-6 gap-y-4 mt-4">
								 <?php if(isset($error) || isset($validation)){ ?>
								<div class="uk-alert-danger" uk-alert>
									<!-- <a class="uk-alert-close" uk-close></a> -->
									<p><?= $error ?? $validation ?? '' ?></p>
								</div>
								<?php } ?>
								   <?php if(isset($_SESSION['error']) ){ ?>
								<div class="uk-alert-danger" uk-alert>
									<!-- <a class="uk-alert-close" uk-close></a> -->
									<p><?= $_SESSION['error'] ?? '' ?></p>
								</div>
								<?php unset($_SESSION['error']); } ?>
								 <?php if( isset($success)) { ?>
								<div class="uk-alert-success" uk-alert>             
									<p><?= $success ?? '' ?></p>
								</div>
								<?php } ?>
              
									<div>
                                        <label for="nome" class="text-sm font-medium"> <?php echo lang('front.field_first_name')?></label>
                                        <input type="text" class="with-border" required id="nome" name="nome" data-parsley-trigger="focusout" value="<?php echo old('nome') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="cognome" class="text-sm font-medium"> <?php echo lang('front.field_last_name')?> </label>
                                        <input type="text" class="with-border"id="cognome" required id="cognome" name="cognome" data-parsley-trigger="focusout" value="<?php echo old('cognome') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="email" class="text-sm font-medium"> <?php echo lang('front.field_email')?> </label>
                                        <input type="text" class="with-border" id="email" name="email" required data-parsley-trigger="focusout" id="email" value="<?php echo old('email') ?? ''?>">
                                    </div>
                                    <div>
                                        <label for="telefono" class="text-sm font-medium"> <?php echo lang('front.field_phone')?> </label>
                                        <input type="text" class="with-border" name="telefono" id="telefono" value="<?php echo old('telefono') ?? ''?>">
                                    </div>
                
									<div>
                                        <label for="telefono" class="text-sm font-medium"> <?php echo lang('front.field_subject')?> </label>
                                        <input type="text" class="with-border" name="subject"  required data-parsley-trigger="focusout" id="subject" value="<?php echo old('subject') ?? ''?>">
                                    </div>
									<div>
									 <label for="telefono" class="text-sm font-medium"> <?php echo lang('front.field_message')?> </label>
									  <textarea class="with-border" name="message" id="message"  required data-parsley-trigger="focusout"><?php echo old('message') ?? ''?></textarea>
									</div>
								   <div class="grid grid-cols-2 md:gap-6 gap-3 md:mt-10 mt-5">
										<button class="bg-blue-600 font-semibold p-2.5 mt-5 rounded-md text-center text-white w-full" name="submit">
											<?php echo lang('front.btn_send')?>
										</button>
									</div>

								</form>
                            </div>

                        </div>

                    </div>



                </div>
                <!--  Sidebar  -->
                <div class="lg:w-80 w-full">

                    <div class="space-y-5" uk-sticky="offset:22; bottom:true ; top:30 ; animation: uk-animation-slide-top-small">

                        <div class="tube-card p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-lg -mb-0.5 font-semibold"> <?php echo lang('front.title_section_contact_ente_email')?> </h4>
                                </div>
                                <a href="#" class="text-blue-600"> <ion-icon name="refresh" class="-mt-0.5 -mr-2 hover:bg-gray-100 p-1.5 rounded-full text-lg md hydrated" role="img" aria-label="refresh"></ion-icon> </a>
                            </div>
                            <ul>
						<?php	if(isset($settings['contact_email']) && $settings['contact_email']!=""){
							$tt=json_decode($settings['contact_email'],true);
							foreach($tt as $kk=>$vv){?>				
                                <li>
                                    <a href="mail-to:<?php echo $vv['email_contact']?>" class="hover:bg-gray-50 rounded-md p-2 -mx-2 block">
                                       
                                        <div class="flex items-center my-auto text-xs space-x-1.5 mt-1.5">
                                            <div><b><?php echo $vv['email_label']?>:</b>&nbsp;<?php echo $vv['email_contact']?></div>
                                         
                                       </div> 
                                    </a>
                                </li>
                        <?php } }?>     
                            </ul>
                            
                        </div>
                        
                     <div class="tube-card p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-lg -mb-0.5 font-semibold"> <?php echo lang('front.title_section_contact_ente_phone')?> </h4>
                                </div>
                                <a href="#" class="text-blue-600"> <ion-icon name="refresh" class="-mt-0.5 -mr-2 hover:bg-gray-100 p-1.5 rounded-full text-lg md hydrated" role="img" aria-label="refresh"></ion-icon> </a>
                            </div>
                            <ul>
						<?php	if(isset($settings['contact_telephone']) && $settings['contact_telephone']!=""){
							$tt=json_decode($settings['contact_telephone'],true);
							foreach($tt as $kk=>$vv){?>				
                                <li>
                                    <a href="#" class="hover:bg-gray-50 rounded-md p-2 -mx-2 block">
                                       
                                        <div class="flex items-center my-auto text-xs space-x-1.5 mt-1.5">
                                          <div><b><?php echo $vv['phone_label']?>:</b>&nbsp;<?php echo $vv['phone_contact']?></div> 
                                         
                                       </div> 
                                    </a>
                                </li>
                        <?php } }?>     
                            </ul>
                            
                        </div>
                    </div>
                    
                </div>

            </div>
 
        </div>
                            </div>
<?= view($view_folder.'/common/footer') ?>
  
<?= view($view_folder.'/common/close') ?>

