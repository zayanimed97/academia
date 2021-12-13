<?= view('default/common/header') ?>
  
     <div class="container p-0">

            <div class="lg:flex lg:space-x-4 lg:-mx-4">
            
                <div class="lg:w-9/12 lg:space-y-6">
                    
                    <div class="tube-card">

                       

                        <div class="md:p-6 p-4">

                            <h1 class="lg:text-2xl text-xl font-semibold mb-6"> <?php echo $inf_page['title']?> </h1>
    
                            
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
								 <?php if( isset($success_register)) { ?>
								<div class="uk-alert-success" uk-alert>             
									<p><?= $success_register ?? '' ?></p>
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
							$tt=explode(",,,",$settings['contact_email']);
							foreach($tt as $kk=>$vv){?>				
                                <li>
                                    <a href="blog-read.html" class="hover:bg-gray-50 rounded-md p-2 -mx-2 block">
                                       
                                        <div class="flex items-center my-auto text-xs space-x-1.5 mt-1.5">
                                          <div><?php echo $vv?></div> 
                                         
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
						<?php	if(isset($settings['contact_phone']) && $settings['contact_phone']!=""){
							$tt=explode(",,,",$settings['contact_phone']);
							foreach($tt as $kk=>$vv){?>				
                                <li>
                                    <a href="blog-read.html" class="hover:bg-gray-50 rounded-md p-2 -mx-2 block">
                                       
                                        <div class="flex items-center my-auto text-xs space-x-1.5 mt-1.5">
                                          <div><?php echo $vv?></div> 
                                         
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
<?= view('default/common/footer') ?>
