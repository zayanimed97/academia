<?= view($view_folder.'/common/header');
$type_cours=json_decode($settings['type_cours'] ?? '',true);
use CodeIgniter\I18n\Time;
 ?>
<style>
    button[disabled]{
        background-color: grey !important;
    }
</style>
        <div class="bg-gradient-to-bl from-purple-600 to-purple-400 text-black lg:-mt-20 lg:pt-20">
            <div class="container p-0">
                <div class="lg:flex items-center lg:space-x-12 lg:py-14 lg:px-20 p-3">

                    <div class="lg:w-4/12">
                        <div class="w-full lg:h-52 h-40 overflow-hidden rounded-lg relative lg:mb-0 mb-4 flex items-center">
						<?php $default_image=base_url('front/assets/images/courses/img-4.jpg');
								switch($corsi['tipologia_corsi']){
									case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!="") $default_image=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") $default_image=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") $default_image=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
								?>
                            <img src="<?= $corsi['foto'] ? base_url('uploads/corsi/'.$corsi['foto']) : $default_image ?>" alt="" class="w-full h-auto">
                            <?php if($corsi['video_promo']) { ?>
                            <a href="#trailer-modal" class="uk-position-center" uk-toggle>
                                <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16" alt="">
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="lg:w-8/12">
                         
                        <h1 class="lg:leading-10 lg:text-3xl text-black text-xl leading-8 font-bold"><?= $corsi['sotto_titolo'] ?></h1>
                        <p class="lg:w-4/5 mt-4 md:text-lg md:block hidden"> <?= $corsi['obiettivi'] ?> </p>
        
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
                                    <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-4.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                    <div>
                                        <h4 class="-mb-1 text-base"> Stella Johnson</h4>
                                        <span class="text-sm"> Bio </span>
                                    </div>
                                </div> 
                            </li> -->
                        </ul>
                        <ul class="lg:flex items-center text-black-200">
                            <li> <?= $type_cours[$corsi['tipologia_corsi']] ?? $corsi['tipologia_corsi']  ?> </li>
                            <li> <span class="lg:block hidden mx-3 text-2xl">·</span> </li>
                            <li> <?= $corsi['categories'] ?> </li>
                            <li> <span class="lg:block hidden mx-3 text-2xl">·</span> </li>
                            <li> <?= $corsi['nomeargomento'] ?></li>
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
                                    <!-- <li><a href="#Contenuto" uk-scroll>Contenuto del corso</a></li>  -->
                                    <li><a href="#Moduli" uk-scroll><?php  if($corsi['tipologia_corsi']=='eBook') echo lang('front.field_tab_ebook'); else echo lang('front.field_tab_modulo')?></a></li>
                                    <li><a href="#Curriculum"><?php echo lang('front.field_cv')?> </a></li>
                                    <!-- <li><a href="#reviews">Reviews</a></li> -->
                                </ul>
                            </nav>
                        </div>


                        <!-- course description -->
                        <div class="tube-card p-5 lg:p-8" id="Descrizione">
        
                            <div class="space-y-6">
                                <?php if($corsi['descizione']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-3"> <?php echo lang('front.field_description')?> </h3>
                                    <p>
                                        <?= $corsi['descizione'] ?>
                                    </p>
                                </div>
                                <?php } ?>
                                <?php if($corsi['programa']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_programa')?></h3>
                                    <!-- <ul class="grid md:grid-cols-2">
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Setting up the environment</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Advanced HTML Practices</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Build a portfolio website</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Responsive Designs</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Understand HTML Programming</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Code HTML</li>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i>Start building beautiful websites</li>
                                    </ul> -->

                                    <p><?= $corsi['programa'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($corsi['note']){ ?>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1"> <?php echo lang('front.field_note')?></h3>
                                    <?= $corsi['note'] ?>
                                    </ul>
                                </div>
                                <?php } ?>

                                <?php if($corsi['indrizzato_a']){ ?>
                                <div>
                                    <h3>  <?php echo lang('front.field_indrizzato_a')?>  </h3>
                                        <p><?= $corsi['indrizzato_a'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($corsi['riferimenti']){ ?>
                                <div>
                                    <h3>  <?php echo lang('front.field_riferimenti')?>  </h3>
                                        <p><?= $corsi['riferimenti'] ?></p>
                                </div>
                                <?php } ?>

                                <?php if($corsi['avvisi']){ ?>
                                <div>
                                    <h3> <?php echo lang('front.field_avvisi')?> </h3>
                                        <p><?= $corsi['avvisi'] ?></p>
                                </div>
                                <?php } ?>
                            </div>
        
                        </div>
        
                        <!-- course Curriculum -->
                        <!-- <div id="curriculum">
                            <h3 class="mb-4 text-xl font-semibold lg:mb-5"> Course Curriculum </h3>
                            <ul uk-accordion="multiple: true" class="tube-card p-4 divide-y space-y-3">
        
                                <li class="uk-open">
                                    <a class="uk-accordion-title text-md mx-2 font-semibold" href="#">  <div class="mb-1 text-sm font-medium"> Section 1 </div> Html Introduction </a>
                                    <div class="uk-accordion-content mt-3 text-base">
            
                                        <ul class="course-curriculum-list font-medium">
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> Introduction <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> What is HTML <span class="text-sm ml-auto"> 5 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                What is a Web page? <span class="text-sm ml-auto"> 8 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Your First Web Page 
                                                <a href="#trailer-modal" class="bg-gray-200 ml-4 px-2 py-1 rounded-full text-xs" uk-toggle=""> Preview </a>
                                                <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Brain Streak <span class="text-sm ml-auto"> 5 min </span>
                                            </li>
                                        </ul>
            
                                    </div>
                                </li>
                                <li class="pt-2">
                                    <a class="uk-accordion-title text-md mx-2 font-semibold" href="#"> <div class="mb-1 text-sm font-medium"> Section 2 </div> Your First webpage  </a>
                                    <div class="uk-accordion-content mt-3 text-base">
            
                                        <ul class="course-curriculum-list font-medium">
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> Headings
                                                <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> Paragraphs
                                                <span class="text-sm ml-auto"> 5 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Emphasis and Strong Tag 
                                                <span class="text-sm ml-auto"> 8 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Brain Streak 
                                                <a href="#trailer-modal" class="bg-gray-200 ml-4 px-2 py-1 rounded-full text-xs" uk-toggle=""> Preview </a>
                                                <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Live Preview Feature
                                                <span class="text-sm ml-auto"> 5 min </span>
                                            </li>
                                        </ul>
            
                                    </div>
                                </li>
                                <li class="pt-2">
                                    <a class="uk-accordion-title text-md mx-2 font-semibold" href="#"> <div class="mb-1 text-sm font-medium"> Section 3 </div> Build Complete Webste  </a>
                                    <div class="uk-accordion-content mt-3 text-base">
            
                                        <ul class="course-curriculum-list font-medium">
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> The paragraph tag
                                                <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon> The break tag
                                                <span class="text-sm ml-auto"> 5 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Headings in HTML
                                                <span class="text-sm ml-auto"> 8 min </span>
                                            </li>
                                            <li class=" hover:bg-gray-100 p-2 flex rounded-md">
                                                <ion-icon name="play-circle" class="text-2xl mr-2"></ion-icon>
                                                Bold, Italics Underline 
                                                <a href="#trailer-modal" class="bg-gray-200 ml-4 px-2 py-1 rounded-full text-xs" uk-toggle=""> Preview </a>
                                                <span class="text-sm ml-auto"> 4 min </span>
                                            </li>
                                        </ul>
            
                                    </div>
                                </li>
                            </ul>
                        </div> -->
        
                        <!-- course Faq --> 
                        <!-- <div class="tube-card p-5 lg:p-8" id="faq"> 
                            <h3 class="text-lg font-semibold mb-3 lg:mb-5"> Course Faq </h3> 
                            <ul uk-accordion="multiple: true" class="divide-y space-y-3">
                                <li class="bg-gray-100 px-4 py-3 rounded-md uk-open">
                                    <a class="uk-accordion-title font-semibold text-base" href="#"> Html Introduction </a>
                                    <div class="uk-accordion-content mt-3">
                                        <p> The primary goal of this quick start guide is to introduce you to
                                            Unreal
                                            Engine 4`s (UE4) development environment. By the end of this guide,
                                            you`ll
                                            know how to set up and develop C++ Projects in UE4. This guide shows
                                            you
                                            how
                                            to create a new Unreal Engine project, add a new C++ class to it,
                                            compile
                                            the project, and add an instance of a new class to your level. By
                                            the
                                            time
                                            you reach the end of this guide, you`ll be able to see your
                                            programmed
                                            Actor
                                            floating above a table in the level. </p>
                                    </div>
                                </li>
                                <li class="bg-gray-100 px-4 py-3 rounded-md">
                                    <a class="uk-accordion-title font-semibold text-base" href="#"> Your First webpage</a>
                                    <div class="uk-accordion-content mt-3">
                                        <p> The primary goal of this quick start guide is to introduce you to
                                            Unreal
                                            Engine 4`s (UE4) development environment. By the end of this guide,
                                            you`ll
                                            know how to set up and develop C++ Projects in UE4. This guide shows
                                            you
                                            how
                                            to create a new Unreal Engine project, add a new C++ class to it,
                                            compile
                                            the project, and add an instance of a new class to your level. By
                                            the
                                            time
                                            you reach the end of this guide, you`ll be able to see your
                                            programmed
                                            Actor
                                            floating above a table in the level. </p>
                                    </div>
                                </li>
                                <li class="bg-gray-100 px-4 py-3 rounded-md">
                                    <a class="uk-accordion-title font-semibold text-base" href="#"> Some Special Tags </a>
                                    <div class="uk-accordion-content mt-3">
                                        <p> The primary goal of this quick start guide is to introduce you to
                                            Unreal
                                            Engine 4`s (UE4) development environment. By the end of this guide,
                                            you`ll
                                            know how to set up and develop C++ Projects in UE4. This guide shows
                                            you
                                            how
                                            to create a new Unreal Engine project, add a new C++ class to it,
                                            compile
                                            the project, and add an instance of a new class to your level. By
                                            the
                                            time
                                            you reach the end of this guide, you`ll be able to see your
                                            programmed
                                            Actor
                                            floating above a table in the level. </p>
                                    </div>
                                </li>
                                <li class="bg-gray-100 px-4 py-3 rounded-md">
                                    <a class="uk-accordion-title font-semibold text-base" href="#"> Html Introduction </a>
                                    <div class="uk-accordion-content mt-3">
                                        <p> The primary goal of this quick start guide is to introduce you to
                                            Unreal
                                            Engine 4`s (UE4) development environment. By the end of this guide,
                                            you`ll
                                            know how to set up and develop C++ Projects in UE4. This guide shows
                                            you
                                            how
                                            to create a new Unreal Engine project, add a new C++ class to it,
                                            compile
                                            the project, and add an instance of a new class to your level. By
                                            the
                                            time
                                            you reach the end of this guide, you`ll be able to see your
                                            programmed
                                            Actor
                                            floating above a table in the level. </p>
                                    </div>
                                </li>
                            </ul>
        
                        </div> -->
        
                        <!-- course Announcement -->
                        
                        <!-- course Reviews -->
                        <!-- <div id="reviews" class="tube-card p-5 lg:p-8">
                            <h3 class="text-xl font-semibold lg:mb-5"> Reviews (4610) </h3> 
                            <div class="flex space-x-5 mb-8">
                                <div class="lg:w-1/4 w-full">
                                    <div class="bg-blue-100 p-6 rounded-md border border-blue-200 text-center shadow-xs">
                                        <h1 class="leading-none text-6xl"> 4.8</h1>
                                        <div class="flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                        <h5 class="text-lg mb-0 mt-2 text-blue-800"> Course Rating</h5>
                                    </div>
                                </div>
                                <div class="w-2/4 hidden lg:flex flex-col justify-center">
            
                                    <div class="space-y-5">
                                        <div class="w-full h-3 rounded-lg bg-gray-300 shadow-xs relative">
                                            <div class="w-11/12 h-3 rounded-lg bg-gray-800"> </div>
                                        </div>
                                        <div class="w-full h-3 rounded-lg bg-gray-300 shadow-xs relative">
                                            <div class="w-4/5 h-3 rounded-lg bg-gray-800"> </div>
                                        </div>
                                        <div class="w-full h-3 rounded-lg bg-gray-300 shadow-xs relative">
                                            <div class="w-3/5 h-3 rounded-lg bg-gray-800"> </div>
                                        </div>
                                        <div class="w-full h-3 rounded-lg bg-gray-300 shadow-xs relative">
                                            <div class="w-3/6 h-3 rounded-lg bg-gray-800"> </div>
                                        </div>
                                        <div class="w-full h-3 rounded-lg bg-gray-300 shadow-xs relative">
                                            <div class="w-1/3 h-3 rounded-lg bg-gray-800"> </div>
                                        </div>
                                    </div>
            
                                </div>
                                <div class="w-1/4 hidden lg:flex flex-col justify-center">
                                    <div class="space-y-1">
                                        <div class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="ml-2"> 95 %</span>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="ml-2"> 85 %</span>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="ml-2"> 60 %</span>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="ml-2"> 50 %</span>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-orange-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="ml-2"> 35 %</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-4 my-5">
                    
                                <div class="bg-gray-50 border flex gap-x-4 p-4 relative rounded-md">
                                    <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-4.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                    <div class="flex justify-center items-center absolute right-5 top-6 space-x-1 text-yellow-500">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                    </div>
                                    <div>
                                        <h4 class="text-base m-0 font-semibold"> Stella Johnson</h4>
                                        <span class="text-gray-700 text-sm"> 14th, April 2021 </span>
                                        <p class="mt-3 md:ml-0 -ml-16">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam ut laoreet dolore
                                            magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        </p>
                                    </div>
                                </div>
                            
                                <div class="bg-gray-50 border flex gap-x-4 p-4 relative rounded-md">
                                    <div class="flex justify-center items-center absolute right-5 top-6 space-x-1 text-yellow-500">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star" class="text-gray-300"></ion-icon>
                                    </div>
                                    <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-2.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                    <div>
                                        <h4 class="text-base m-0 font-semibold"> Alex Dolgove</h4>
                                        <span class="text-gray-700 text-sm"> 16th, May 2021 </span>
                                        <p class="mt-3 md:ml-0 -ml-16">
                                            elit, sed diam ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim ipsum dolor sit
                                            amet, consectetuer adipiscing elit 
                                        </p>
                                    </div>
                                </div>
        
                                <div class="bg-gray-50 border flex gap-x-4 p-4 relative rounded-md lg:ml-16">
                                    <div class="flex justify-center items-center absolute right-5 top-6 space-x-1 text-yellow-500">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star" class="text-gray-300"></ion-icon>
                                    </div>
                                    <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-3.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                    <div>
                                        <h4 class="text-base m-0 font-semibold"> Trap Nation</h4>
                                        <span class="text-gray-700 text-sm"> 16th, May 2021 </span>
                                        <p class="mt-3 md:ml-0 -ml-16">
                                            elit, sed diam ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim ipsum dolor sit
                                            amet, consectetuer adipiscing elit 
                                        </p>
                                    </div>
                                </div>
                            
                            </div>
        
                            <div class="flex justify-center mt-9">
                                <a href="#" class="bg-gray-50 border hover:bg-gray-100 px-4 py-1.5 rounded-full text-sm">More Comments ..</a>
                            </div>
        
                        </div> -->
                        <!-- <div class="tube-card p-5 lg:p-8">
                            <h3 class="text-xl font-semibold lg:mb-5"> Corso Complete </h3>
                            <div class="uk-transition-toggle md:flex">
                                <div class="md:w-5/12 md:h-60 h-40 overflow-hidden rounded-l-lg relative">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-6.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                    <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16 uk-position-center uk-transition-fade" alt="">
                                </div>
                                <div class="flex-1 md:p-6 p-4">
                                    <div class="font-semibold line-clamp-2 md:text-xl md:leading-relaxed">Learn How to Build Responsive Web Design Essentials HTML5 CSS3 and Bootstrap </div>
                                    <div class="line-clamp-2 mt-2 md:block hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</div>
                                    <div class="font-semibold mt-3"> John Michael </div>
                                    <div class="mt-1 flex items-center justify-between">
                                        <div class="flex space-x-2 items-center text-sm pt-2">
                                            <div> 13 hours </div>
                                            <div>·</div>
                                            <div> 32 lectures </div>
                                        </div>
                                        <div class="text-lg font-semibold"> $14.99 </div>
                                    </div>
                                </div> 
                            </div>
                        </div> -->
                        <div class="tube-card p-5 lg:p-8" id="Moduli">
                            <h3 class="text-xl font-semibold lg:mb-5"> <?php  if($corsi['tipologia_corsi']=='eBook') echo lang('front.field_tab_ebook'); else echo lang('front.field_tab_modulo')?> </h3>
                            <?php foreach($module as $mod){ if(strlen(trim($mod['id'])) > 0 ){ if($corsi['buy_type'] != 'date'){ ?>
                            <div class="bg-white shadow-sm uk-transition-toggle md:flex mb-2 pb-2">
                                <div class="md:w-1/5 md:h-24 h-40 overflow-hidden relative flex justify-center" @click="<?= $mod['video_promo']  ? 'videoPromo(\'https://www.youtube.com/embed/'.$mod['video_promo'].'\', \''.$mod['sotto_titolo'].'\')' : ''?>">
                                    <img src="<?= $mod['foto'] ? base_url('uploads/corsi/'.$mod['foto']) : base_url('front/assets/images/courses/img-2.jpg') ?>" alt="" class="h-full">
                                    <?php if($mod['video_promo']) {?>
                                    <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16 uk-position-center uk-transition-fade" alt="">
                                    <?php } ?>
                                </div>
                                <div class="flex-1 px-4">
                                    <a href="<?= base_url('/modulo/'.$mod['url']) ?>" class="font-semibold line-clamp-2 md:text-lg md:leading-relaxed"><?= $mod['sotto_titolo'] ?> </a>
                                    <!-- <div class="line-clamp-2 mt-2 md:block hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</div> -->
                                    <div class="font-semibold mt-1"> <?= $mod['display_name'] ?> </div>
                                    <div class="mt-1 flex items-center justify-between text-md">
                                        <div class="flex space-x-2 items-center text-sm pt-2">
                                            <div> <?php 
											
											if($mod['tipologia']!=""){ echo $type_cours[$mod['tipologia']] ?? $mod['tipologia'] ; } 
                                            else{echo $type_cours[$corsi['tipologia_corsi']] ?? $corsi['tipologia_corsi']; }?> </div>
                                            <div>·</div>
                                            <div> <?= $corsi['categories'] ?> </div>
                                            <div>·</div>
                                            <div> <?= $mod['duration'] ?: 'indefinite' ?> </div>
                                            <div>·</div>
                                            <div> <?= $mod['nb_person_aula'] ?: 'not applicable' ?> </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="flex justify-between flex-col p-2">
                                    <?php if($mod['prezzo']){ ?>
                                        <div class="text-xl font-semibold w-full text-center"> <?= $mod['prezzo'] ?></div>
                                    <?php } ?>
                                    <?php if($corsi['buy_type'] == 'module') {?>
                                        <template x-if="((('<?= $corsi['buy_type'] ?>' == 'date' && select.modulo<?= $mod['id'] ?> != null) || ('<?= $corsi['buy_type'] ?>' == 'module')) && !inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>'))">
                                            <button type="button" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" @click="addToCart('<?= $mod['id'] ?>', '<?= $mod['prezzo'] ?>', '', '<?= $mod['url'] ?>', 'modulo')"> <?php echo lang('front.btn_add_cart')?> </button>
                                        </template>

                                        <template x-if="inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>')">
                                            <a href="<?= base_url('/order/checkout') ?>" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" x-text="inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>')"> </a>
                                        </template>
                                    <?php } ?>
                                </div> 
                                
                            </div>
                            <?php } if($corsi['buy_type'] == 'date') { foreach($dates as $date) { if(strtotime(date('Y-m-d H:i:s')) < strtotime($date['date']. ' '. $date['end_time'] . ':00')){ ?>


                            <div class="bg-white shadow-sm uk-transition-toggle md:flex mb-2 pb-2">
                                
                                <div class="flex-1 px-4">
                                    <div class="font-semibold line-clamp-2 md:text-lg md:leading-relaxed"> <span class="text-green-500"><?= Time::parse($date['date'], 'Europe/Rome', 'it_IT')->toLocalizedString('d MMMM Y') ?></span> - ORARIO: <?= $date['start_time'] ?> -  <?= $date['end_time'] ?></div>
                                    <!-- <div class="line-clamp-2 mt-2 md:block hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</div> -->
                                    <div class="font-semibold mt-1"> <?= $mod['sotto_titolo'] ?> </div>
                                    <div class="mt-1"> A cura di: <?= $mod['display_name'] ?></div>
                                </div>
                                <div class="flex justify-between flex-col p-2">
                                    <?php if($mod['prezzo']){ ?>
                                        <div class="text-xl font-semibold w-full text-center"> <?= $mod['prezzo'] ?></div>
                                    <?php } ?>
                                        <template x-if="!inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>')">
                                            <button type="button" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" @click="addToCart('<?= $mod['id'] ?>', '<?= $mod['prezzo'] ?>', '', '<?= $mod['url'] ?>', 'modulo', <?= $date['id'] ?>)"> <?php echo lang('front.btn_add_cart')?> </button>
                                        </template>

                                        <template x-if="inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>')">
                                            <button @click="location.href='<?= base_url('/order/checkout') ?>'" :disabled="inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>', '<?= $date['id'] ?>') == 'disabled'" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" x-text="inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>', '<?= $date['id'] ?>') == 'disabled' ? '<?php echo lang('front.btn_add_cart')?>' : inCart('<?= $corsi['id'] ?>', '<?= $mod['id'] ?>')"> </button>
                                        </template>
                                </div> 
                                
                            </div>


                            <?php }}}}} ?>
                        </div>


                        <div id="Curriculum" class="tube-card p-5 lg:p-8">
                            <h3 class="text-xl font-semibold lg:mb-5"> <?php echo lang('front.field_doctor_cv')?> </h3>
                            <?php foreach($doctors as $doc){ ?>

                            <div class="flex items-center gap-x-4 mb-5" id="doctor<?= $doc['id'] ?>">
                                <img src="<?= $doc['logo']?base_url('uploads/users/'.$doc['logo']):base_url('front/assets/images/avatars/avatar-4.jpg') ?>" alt="" class="rounded-full shadow w-12 h-12">
                                <div>
                                    <h4 class="-mb-1 text-base"> <?= $doc['display_name'] ?></h4>
                                    <span class="text-sm"> <?php echo lang('front.field_instructor')?> </span>
                                </div>
                            </div>
                            <div class="mb-8">
                                <?= $doc['cv'] ?>
                            </div>
                            <?php } ?>
        
                        </div>

                    </div>
                    <div class="lg:w-4/12 space-y-4">
                        
                        <div uk-sticky="top:600;offset:; offset:90 ; media: 1024">
                            <div class="tube-card p-5"> 
        
                                <div class="grid grid-cols-2 gap-4">
                                   
                                    <div class="flex flex-col space-y-2">
                                        <div class="text-3xl font-semibold"> <?= $corsi['prezzo'] ?></div>
                                        <!--div> Students </div-->
                                        <ion-icon name="people-circle" class="text-lg" hidden></ion-icon>
                                    </div>
                                    <!-- <div class="mt-4">
                                        <a href="#" class="flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white"> Locandina </a>
                                    </div> -->
                                </div>
                                <hr class="-mx-5 border-gray-200 my-4">
                                <h4 hidden> <?php echo lang('front.field_cour_include')?></h4>
        
                                <div class="-m-5 divide-y divide-gray-200 text-sm">
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="play-outline" class="text-2xl mr-2"></ion-icon><?php echo lang('front.field_type_cours')?> : <?= $type_cours[$corsi['tipologia_corsi']] ?? $corsi['tipologia_corsi'] ?> </div>
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="key-outline" class="text-2xl mr-2"></ion-icon> <?= $corsi['ECM'] ?? '0' ?> <?= $settings['credits'] ?? 'crediti'?> </div>
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="download-outline" class="text-2xl mr-2"></ion-icon> <?= $corsi['duration'] ?? '0min' ?> <?php echo lang('front.field_total')?> </div>
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="help-circle-outline" class="text-2xl mr-2"></ion-icon> <?= $corsi['nb_person_aula'] ?? '0' ?> <?php echo lang('front.field_participant')?> </div>
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="medal-outline" class="text-2xl mr-2"></ion-icon> <?= count($module) ?> <?php if($corsi['tipologia_corsi']=='eBook') echo lang('front.field_tab_ebook'); else echo lang('front.field_modules')?> </div>
                                    <div class="flex items-center px-5 py-3">  <ion-icon name="medal-outline" class="text-2xl mr-2"></ion-icon> <?php echo lang('front.field_attestation')?>: <?= $corsi['attestato'] ?> </div>
                                    <?php if(strlen($corsi['difficulte']) > 0){ ?>
                                        <div class="flex items-center px-5 py-3">  <ion-icon name="speedometer-outline" class="text-2xl mr-2"></ion-icon> Difficoltà : <?= $corsi['difficulte'] ?> </div>
                                    <?php } ?>
                                </div>
                                
                            </div>
                            <?php if($corsi['buy_type'] != 'date') { ?>
                                <template x-if="!inCart('<?= $corsi['id'] ?>', '')">
                                    <div class="mt-4">
                                        <button type="button" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" @click="addToCart('<?= $corsi['id'] ?>', '<?= $corsi['prezzo'] ?>', '<?= $corsi['buy_type'] ?>', '<?= $corsi['url'] ?>', 'corsi')"> <?php echo lang('front.btn_add_cart')?></button>
                                    </div>
                                </template>

                                <template x-if="inCart('<?= $corsi['id'] ?>', '')">
                                    <div class="mt-4">
                                        <a href="<?= base_url('/order/checkout') ?>" class="w-full flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white" x-text="inCart('<?= $corsi['id'] ?>', '')"></a>
                                    </div>
                                </template>
                            <?php } ?>

                            <?php if($corsi['pdf']){ ?>
                                <div class="mt-4">
                                    <a href="<?= base_url('user/getFile/'.$corsi['pdf']) ?>" class="flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white"> <?php echo lang('front.btn_download_attachment')?> </a>
                                </div>
                            <?php } ?>
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
                <h4 class="text-lg font-semibold mb-2"> Trailer video </h4>
            </div>
          
            <div class="embed-video">
                <iframe src="https://www.youtube.com/embed/<?= $corsi['video_promo'] ?>" class="w-full"
                uk-video="automute: true" frameborder="0" allowfullscreen uk-responsive></iframe>
            </div>


            <div class="uk-modal-body">
                <h3 class="text-lg font-semibold mb-2">Build Responsive Websites </h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore
                    eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident,
                    sunt
                    in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>
    
<?= view($view_folder.'/common/footer') ?>

<script>
    function getData() {
        return {
            video_url: '',
            moduloNamePromo: '',

            videoPromo(v, name){
                this.moduloNamePromo = name
                this.video_url = v
                if (v && v != '') {
                    UIkit.modal('#video-promo').show();
                }
            },
        }
    }
</script>
    <?= view($view_folder.'/common/close') ?>
