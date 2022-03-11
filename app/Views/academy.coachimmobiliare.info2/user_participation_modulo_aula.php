<?= view($view_folder.'/common/header');
$type_cours=json_decode($settings['type_cours'] ?? '',true); ?>

        <div class="bg-gradient-to-bl from-purple-600 to-purple-400 text-black lg:-mt-20 lg:pt-20">
            <div class="container p-0">
                <div class="lg:flex items-center lg:space-x-12 lg:py-14 lg:px-20 p-3">

                    <div class="lg:w-4/12">
                        <div class="w-full lg:h-52 h-40 overflow-hidden rounded-lg relative lg:mb-0 mb-4 flex items-center">
						<?php $default_image=base_url('front/assets/images/courses/img-1.jpg');
								switch($corsi['tipologia_corsi']){
									case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!="") $default_image=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") $default_image=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") $default_image=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
								?>
                            <img src="<?= $module['foto'] ? base_url('uploads/corsi/'.$module['foto']) : $default_image ?>" alt="" class="w-full h-auto">
                            <?php if($module['video_promo']) { ?>
                            <a href="#trailer-modal" class="uk-position-center" uk-toggle>
                                <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16" alt="">
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="lg:w-8/12">
                         
                        <h1 class="lg:leading-10 lg:text-3xl text-black text-xl leading-8 font-bold"><?= $module['sotto_titolo'] ?></h1>
                        <p class="lg:w-4/5 mt-4 md:text-lg md:block hidden"> <?= $module['obiettivi'] ?> </p>
        
                        <ul class="flex text-gray-300 gap-4 mt-4 mb-3">
                            <?php foreach($doctors as $doc){ ?>
                            <li class="flex items-center">
                                <div class="flex items-center gap-x-4 mb-5">
                                    <img src="<?= $doc['logo']?base_url('uploads/users/'.$doc['logo']):base_url('front/assets/images/avatars/avatar-4.jpg') ?>" alt="" class="rounded-full shadow w-12 h-12">
                                    <a href="#doctor<?= $doc['id'] ?>" uk-scroll>
                                        <h4 class="-mb-1 text-base"> <?= $doc['display_name'] ?></h4>
                                        <!-- <span class="text-sm"> Bio </span> -->
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                            <!-- <li> 
                                <div class="flex items-center gap-x-4 mb-5">
                                    <img src="<?= $doc['logo']?base_url('uploads/users/'.$doc['logo']):base_url('front/assets/images/avatars/avatar-4.jpg') ?>" alt="" class="rounded-full shadow w-12 h-12">
                                    <div>
                                        <h4 class="-mb-1 text-base"> Stella Johnson</h4>
                                        <span class="text-sm"> Bio </span>
                                    </div>
                                </div> 
                            </li> -->
                        </ul>
                        <ul class="lg:flex items-center text-black-200">
                            <li> <?= $type_cours[$module['tipologia_corsi']] ?> </li>
                            <li> <span class="lg:block hidden mx-3 text-2xl">·</span> </li>
                            <li> <?= $module['categories'] ?> </li>
                        </ul>
 
                    </div>

                </div>
            </div>
        </div>
            <div class="container p-0" x-data="getData">

                
                <div class="lg:flex lg:space-x-4 mt-4">
                    <div class="lg:w-8/12 space-y-4">
                        
                        <div class="tube-card z-20 mb-4 overflow-hidden uk-sticky" uk-sticky="cls-active:rounded-none ; media: 992 ; offset:70 ">
                            <nav class="cd-secondary-nav extanded ppercase nav-small">
                                <ul class="space-x-3" uk-scrollspy-nav="closest: li; scroll: true">
                                    <li><a href="#Descrizione" uk-scroll><?php echo lang('front.field_description')?></a></li>
                                    
									 <li><a href="#Calendar" uk-scroll><?php echo lang('front.field_calendar')?></a></li>
                                    <li><a href="#Curriculum"><?php echo lang('front.field_cv')?> </a></li>
                                   <li><a href="#Position"><?php echo lang('front.field_position')?> </a></li>
                                   <?php if(count($pdfs) > 0) { ?>
                                        <li><a href="#Materiel"><?php echo lang('front.materiel')?> </a></li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>


                        <!-- course description -->
                        <div class="tube-card p-5 lg:p-8" id="Descrizione">
        
                            <div class="space-y-6">
                                <?php if($module['description']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-3"> <?php echo lang('front.field_description')?> </h3>
                                    <p>
                                        <?= $module['description'] ?>
                                    </p>
                                </div>
                                <?php } ?>
                                <?php if($module['programa']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_programa')?> </h3>
                                    <!-- <ul class="grid md:grid-cols-2">
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Setting up the environment</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Advanced HTML Practices</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Build a portfolio website</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Responsive Designs</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Understand HTML Programming</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Code HTML</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Start building beautiful websites</li>
                                    </ul> -->

                                    <p><?= $module['programa'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($module['note']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">  <?php echo lang('front.field_note')?></h3>
                                    <?= $module['note'] ?>
                                    </ul>
                                </div>
                                <?php } ?>

                                <?php if($module['indrizzato_a']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">  <?php echo lang('front.field_indrizzato_a')?> </h3>
                                        <p><?= $module['indrizzato_a'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($module['riferimenti']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_riferimenti')?> </h3>
                                        <p><?= $module['riferimenti'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($module['avvisi']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_avvisi')?> </h3>
                                        <p><?= $module['avvisi'] ?></p>
                                </div>
                                <?php } ?>
                            </div>
        
                        </div>
						<hr/>
						 <div class="tube-card p-5 lg:p-8" id="Calendar">
						  <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_calendar')?> </h3>
							 
							<?php if(!empty($dates)){
							foreach($dates as $k=>$v){?>
							<div class="uk-container">
							<b><?php echo date('d/m/Y',strtotime($v['date'])).'</b> '.lang('front.field_de').' <b>'.date('H:i',strtotime($v['start_time'])).'</b> '.lang('front.field_a').' <b>'.date('H:i',strtotime($v['end_time']))?></b>
							 
							</div>
							<?php } } ?>
						 </div>
						<hr/>
                  


                        <div id="Curriculum" class="tube-card p-5 lg:p-8">
                            <h3 class="text-xl font-semibold lg:mb-5"> <?php echo lang('front.field_doctor_cv')?>  </h3>
                            <?php foreach($doctors as $doc){ ?>

                            <div class="flex items-center gap-x-4 mb-5" id="doctor<?= $doc['id'] ?>">
                                <img src="<?= $doc['logo']?base_url('uploads/users/'.$doc['logo']):base_url('front/assets/images/avatars/avatar-4.jpg') ?>" alt="" class="rounded-full shadow w-12 h-12">
                                <div>
                                    <h4 class="-mb-1 text-base"> <?= $doc['display_name'] ?></h4>
                                    <span class="text-sm"> <?php echo lang('front.field_instructor')?> </span>
                                </div>
                            </div>
                            <div class="mb-8">
                                <?= $doc['cv'] ?? '' ?>

                            </div>
                            <?php } ?>
        
                        </div>
<hr/>
						 <div class="tube-card p-5 lg:p-8" id="Position">
							<h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_position')?> </h3>
							<div class="bg-white shadow-sm uk-transition-toggle md:flex mb-2 pb-2">
                                <div class="md:w-1/5 md:h-24 h-40 overflow-hidden relative flex justify-center" >
                                    <img src="<?= $inf_alberghi['foto'] ? base_url('uploads/alberghi/'.$inf_alberghi['foto']) : base_url('front/assets/images/courses/img-2.jpg') ?>" alt="" class="h-full">
                                   
                                </div>
                                <div class="flex-1 px-4">
                                    <a href="<?= $inf_alberghi['sito'] ?? '#' ?>" class="font-semibold line-clamp-2 md:text-lg md:leading-relaxed">
                                        <?= $inf_alberghi['nome'] .' - '.$inf_luoghi['nome']?>
                                    </a>
                                    <!-- <div class="line-clamp-2 mt-2 md:block hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</div> -->
                                    <div class="mt-1"> <?= $inf_alberghi['indirizzo'].' '.$inf_alberghi['cap'].' '.$inf_alberghi['citta'].' ('.$inf_alberghi['provincia'].')' ?> </div>
                                     <div class="mt-1"><?php echo $inf_alberghi['telefono']?></div>
									 <div class="mt-1"><?php echo $inf_alberghi['email']?></div>
                                </div>
							</div>
							<?php if($inf_alberghi['gmap']!=""){?>
								<div class="bg-white shadow-sm uk-transition-toggle md:flex mb-2 pb-2">
									<?php echo $inf_alberghi['gmap']?>
								</div>
							<?php }  elseif($inf_alberghi['testo']!=""){?>
								<div class="bg-white shadow-sm uk-transition-toggle md:flex mb-2 pb-2">
									<?php echo $inf_alberghi['testo']?>
								</div>
							<?php } ?>
						 </div>
                         <?php if(count($pdfs) > 0) { ?>
                        <div id="Materiel" class="tube-card p-5 lg:p-8">
                            <h3 class="text-xl font-semibold lg:mb-5"> <?php echo lang('front.materiel_cours')?>  </h3>
                            
                            <div id="curriculum">
        
                                    <div class="uk-accordion-content mt-3 text-base">
            
                                        <ul class="course-curriculum-list font-medium">
                                            <?php foreach($pdfs as $pdf){ ?>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md items-center mb-4 border-b">
                                                <span class="icon-material-outline-picture-as-pdf text-xl mr-4"></span> 
                                                <span><?= $pdf['pdfname'] ?></span> 
                                                <span class="text-sm ml-auto">
                                                    <a href="<?= base_url('uploads/corsiPDF/'.$pdf['filename']) ?>" class="flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white"> <?php echo lang('front.btn_download_attachment')?> </a>
                                                </span>
                                            </li>
                                            <?php } ?>
                                        </ul>
            
                                    </div>
                            </div> 
                        </div>
                        <?php } ?>
                    </div>
                    <div class="lg:w-4/12 space-y-4">
                        
                        <div uk-sticky="top:600;offset:; offset:90 ; media: 1024">
                            <div class="tube-card p-5"> 
        
                               
                                <hr class="-mx-5 border-gray-200 my-4">
                                <h4 hidden><?php echo lang('front.field_cour_include')?></h4>
        
                                <div class="-m-5 divide-y divide-gray-200 text-sm">
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="play-outline" class="text-2xl mr-2"></ion-icon><?php echo lang('front.field_type_cours')?>: <?= $type_cours[$module['tipologia_corsi']] ?> </div>
                                    <!-- <div class="flex items-center px-5 py-3">  <ion-icon name="key-outline" class="text-2xl mr-2"></ion-icon> <?= $module['ECM'] ?? '0' ?> Credits </div> -->
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="download-outline" class="text-2xl mr-2"></ion-icon> <?= $module['duration'] ?? '0min' ?> <?php echo lang('front.field_total')?> </div>
                                    <?php if($module['inscrizione_aula']=='si'){?><div class="flex items-center px-5 py-3">  <ion-icon name="help-circle-outline" class="text-2xl mr-2"></ion-icon> <?= $module['nb_person_aula'] ?? '0' ?> <?php echo lang('front.field_participant')?> </div><?php } ?>
                                    <!-- <div class="flex items-center px-5 py-3">  <ion-icon name="medal-outline" class="text-2xl mr-2"></ion-icon> <?= count($module) ?> Moduli </div> -->
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="medal-outline" class="text-2xl mr-2"></ion-icon> <?php echo lang('front.field_attestation')?> : <?= $module['attestato'] ?> </div>
                                </div>
                                
                            </div>
                          
                        </div>
                        
                    

                        <!-- <div class="tube-card p-5"> 
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-lg -mb-0.5 font-semibold"> Related  Courses </h4>
                                </div>
                                <a href="#" class="text-blue-600"> <ion-icon name="refresh" class="-mt-0.5 -mr-2 hover:bg-gray-100 p-1.5 rounded-full text-lg"></ion-icon> </a>
                            </div>
                            <div class="p-1">
                                <a href="#" class="-mx-3 block hover:bg-gray-100 p-2 rounded-md">
                                    <div class="flex items-center space-x-3">
                                        <img src="<?= base_url('front') ?>/assets/images/courses/img-2.jpg" alt="" class="h-12 object-cover rounded-md w-12">
                                        <div class="line-clamp-2 text-sm font-medium">
                                            The Complete JavaScript From beginning to Experts for advance
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="-mx-3 block hover:bg-gray-100 p-2 rounded-md">
                                    <div class="flex items-center space-x-3">
                                        <img src="<?= base_url('front') ?>/assets/images/courses/img-4.jpg" alt="" class="h-12 object-cover rounded-md w-12">
                                        <div class="line-clamp-2 text-sm font-medium"> 
                                            The Complete JavaScript From beginning to Experts for advance
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="-mx-3 block hover:bg-gray-100 p-2 rounded-md">
                                    <div class="flex items-center space-x-3">
                                        <img src="<?= base_url('front') ?>/assets/images/courses/img-3.jpg" alt="" class="h-12 object-cover rounded-md w-12">
                                        <div class="line-clamp-2 text-sm font-medium"> 
                                            The Complete JavaScript From beginning to Experts for advance
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="#" class="hover:bg-gray-100 -mb-1.5 mt-0.5 h-8 flex items-center justify-center rounded-md text-blue-400 text-sm"> 
                                See all 
                            </a>
                        </div> -->

                    </div>
                </div>
                <div id="video-promo" uk-modal>
                <div class="uk-modal-dialog shadow-lg rounded-md">
                    <button class="uk-modal-close-default m-2.5" type="button" uk-close></button>
                    <div class="uk-modal-header  rounded-t-md">
                        <h4 class="text-lg font-semibold mb-2" x-text="moduloNamePromo + ' Video Promo'">  </h4>
                    </div>
                
                    <div class="embed-video">
                        <iframe :src="video_url" class="w-full"
                        uk-video="automute: true" frameborder="0" allowfullscreen uk-responsive></iframe>
                    </div>


                    <div class="uk-modal-body">
                        <!-- <h3 class="text-lg font-semibold mb-2">Build Responsive Websites </h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                            dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident,
                            sunt
                            in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                    </div>
                </div>
            </div>
            </div>

    <!-- video demo model -->
    <div id="trailer-modal" uk-modal>
        <div class="uk-modal-dialog shadow-lg rounded-md">
            <button class="uk-modal-close-default m-2.5" type="button" uk-close></button>
            <div class="uk-modal-header  rounded-t-md">
                <h4 class="text-lg font-semibold mb-2">  <?php echo lang('front.title_modal_video_promo')?> </h4>
            </div>
          
            <div class="embed-video">
                <iframe src="https://www.youtube.com/embed/<?= $module['video_promo'] ?>" class="w-full"
                uk-video="automute: true" frameborder="0" allowfullscreen uk-responsive></iframe>
            </div>


           
        </div>
    </div>
    
<?= view($view_folder.'/common/footer') ?>


    <?= view($view_folder.'/common/close') ?>
