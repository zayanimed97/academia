<?php require_once 'common/header.php' ?>
<div x-data="getSlideData">
<?php   $uniqueCat = array_reverse(array_values(array_column(
                                        array_reverse($category),
                                        null,
                                        'id'
                                    ))); 
        $courses =  $CorsiModel ->where("find_in_set( '".($uniqueCat[0]['id'] ?? '')."', id_categorie) > 0")
                                ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                ->where('corsi.banned', 'no')
                                ->groupBy('corsi.id')
                                ->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id', 'left')
                                ->where('corsi.id_ente', $selected_ente['id'])
                                ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                ->groupBy('corsi.id')->having('count(cm.id) > 0')
                                ->select("  corsi.video_promo, 
                                            corsi.foto, 
                                            corsi.url, 
                                            corsi.sotto_titolo, 
                                            corsi.tipologia_corsi, 
                                            corsi.prezzo, 
                                            corsi.id, 
                                            corsi.buy_type, 
                                            corsi.obiettivi, 
                                            corsi.have_def_price, 
                                            corsi.free, 
                                            corsi.duration, 
                                            MAX(prezz.prezzo) as max_price, 
                                            MIN(prezz.prezzo) as min_price, 
                                            GROUP_CONCAT(DISTINCT u.display_name) doctor_names, 
                                            count(DISTINCT cm.id) as modulo_count,
                                            corsi.ids_professione
                                        ")
                                ->find();


        $featured = $CorsiModel ->where("corsi.featured = 'yes'")
                                ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                ->where('corsi.banned', 'no')
                                ->groupBy('corsi.id')
                                ->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id', 'left')
                                ->where('corsi.id_ente', $selected_ente['id'])
                                ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                ->groupBy('corsi.id')->having('count(cm.id) > 0')
                                ->select("  corsi.video_promo, 
                                            corsi.foto, 
                                            corsi.url, 
                                            corsi.sotto_titolo, 
                                            corsi.tipologia_corsi, 
                                            corsi.prezzo, 
                                            corsi.id, 
                                            corsi.buy_type, 
                                            corsi.obiettivi, 
                                            corsi.have_def_price, 
                                            corsi.free, 
                                            corsi.duration, 
                                            MAX(prezz.prezzo) as max_price, 
                                            MIN(prezz.prezzo) as min_price, 
                                            GROUP_CONCAT(DISTINCT u.display_name) doctor_names, 
                                            count(DISTINCT cm.id) as modulo_count,
                                            corsi.ids_professione
                                        ")
                                ->find();
        $idsCorsi = array_map(function ($el){return $el['id'];}, array_merge($courses, $featured));
        $discountsCorsi = $CorsiPrezzoProfModel->whereIn('id_corsi', $idsCorsi ?: ['impossible value']);
        if (session('user_data')['profile']['professione'] ?? false) {
            $discountsCorsi->where('id_professione', session('user_data')['profile']['professione'] ?? '');
        }
        $discountsCorsi = $discountsCorsi->find();
        foreach ($courses as $key => &$course) {
            // get profs for this course
            $discounts($course, $discountsCorsi ?? []);
        }
        foreach ($featured as $key => &$course) {
            // get profs for this course
            $discounts($course, $discountsCorsi ?? []);
        }
?>
<style>
    
    .card .card-media img{
        height: auto;
        object-fit: initial;
        position: initial;
    }

    .sottotitolo{
        text-overflow: ellipsis;
    }
  </style>
        <?php $settings['banner_home'] = (array)json_decode($settings['banner_home'] ?? "" );
        if(!empty($settings['banner_home'])){?>
        <!-- Slideshow -->
        <div class="uk-position-relative contents overflow-hidden lg:-mt-20" tabindex="-1"
        style="min-height: 200; max-height: 500;">       
        <!-- <ul class="uk-slideshow-items rounded"> -->
            <!-- <li> -->
                <div class="uk-cover-container uk-inline w-full mb-8">
                    <?php if($settings['banner_home']["image"]!=""){?><img src="<?= base_url('uploads/banner/'.$settings['banner_home']["image"]) ?>" style="max-width: 100vw" class="object-cover" alt="" uk-cover><?php } ?>
                    <div class="container relative p-20 lg:mt-12 h-full uk-overlay"> 
                        <div  class="flex flex-col justify-center h-full w-full space-y-3">
                            <h1  class="lg:text-4xl text-2xl text-black font-semibold"> <?= $settings['banner_home']["title"] ?? ''?> </h1>
                            <p  class="text-base text-black font-medium pb-4 lg:w-1/2"> <?= $settings['banner_home']["subtitle"] ?? '' ?> </p>
                            <a  href="<?= $settings['banner_home']["url"] ?? '' ?>" class="bg-opacity-90 bg-blue-600 py-2.5 rounded-md text-base text-black text-center w-32"><?= $settings['banner_home']["btn_label"] ?? lang('front.link_go') ?> </a> 
                        </div>
                    </div>
                </div>
            <!-- </li>  -->
        <!-- </ul>  -->
        </div> 
        <?php } ?>     
        <div class="container p-4">
            
            <!--  course feature -->
            <div class="sm:my-4 my-3 flex items-end justify-between pt-3 pb-6">
                <h2 class="text-2xl font-semibold"> Creazioneimpresa Academy<br>Benvenuti nella Accademia delle Startup e PMI innovative  </h2>
            </div> 
            <?php if(isset($_SESSION['success'])){ ?>
                <div class="bg-green-500 border p-4 relative rounded-md uk-alert" uk-alert="">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                    <h3 class="text-lg font-semibold text-white">Success</h3>
                    <p class="text-white text-opacity-75"><?=$_SESSION['success']?></p>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['cancelled'])){ ?>
                <div class="bg-yellow-500 border p-4 relative rounded-md uk-alert" uk-alert="">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                    <h3 class="text-lg font-semibold text-white">Cancelled</h3>
                    <p class="text-white text-opacity-75"><?=$_SESSION['cancelled']?></p>
                </div>
            <?php } ?>
            <div class="tube-card relative p-6 -mt-3" uk-slider="finite: true">
                <div class="uk-slider-container px-1 py-3">
                    <ul class="uk-slider-items uk-child-width-1-1@m uk-grid">
                    <?php foreach($featured as $c){
                        $default_image=base_url('front/assets/images/courses/img-4.jpg');
                        switch($c['tipologia_corsi']){
                            case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!="") $default_image=base_url('uploads/'.$settings['default_img_online']); break;
                            case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") $default_image=base_url('uploads/'.$settings['default_img_aula']); break;
                            case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") $default_image=base_url('uploads/'.$settings['default_img_webinar']); break;
                        }?> 
                        <li>
                                    
                            <div class="bg-white  uk-transition-toggle md:flex">
                                <div class="md:w-5/12 md:h-60 h-40 overflow-hidden relative">
                                    <img src="<?= $c['foto'] ? base_url('uploads/corsi/'.$c['foto']) : $default_image ?>" alt="" class="w-full h-full absolute inset-0 object-cover">
                                    <?php if($c['video_promo']) {?>
                                        <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16 uk-position-center uk-transition-fade" alt="" @click="showModalPromo('https://www.youtube.com/embed/<?= $c['video_promo'] ?>', '<?= $c['sotto_titolo'] ?>')">
                                    <?php } ?>
                                </div>
                                <div class="flex-1 md:p-6 p-4">
                                    <a href="<?= base_url('corsi/'.$c['url']) ?>" class="font-semibold line-clamp-2 md:text-xl md:leading-relaxed"><?= ellipsize($c['sotto_titolo'], 35) ?> </a>
                                    <div class="line-clamp-2 mt-2 md:block hidden"><?= ellipsize($c['obiettivi'], 120) ?></div>
                                    <div class="font-semibold mt-3 text-sm"> <?= $c['doctor_names'] ?> </div>
                                    <div class="mt-1 flex items-center justify-between">
                                        <div class="flex space-x-2 items-center text-sm pt-2">
                                            <div> <a href="<?= base_url('corsi') ?>?tipo=<?=$c['tipologia_corsi']?>"><?= $type_cours[$c['tipologia_corsi']] ?? $c['tipologia_corsi']?></a> </div>
                                            <div>·</div>
                                            <div> <?= $c['modulo_count'].' modul'. ($c['modulo_count'] > 1 ? 'i': 'o')?> </div>
                                            <?php if(strlen($c['duration']) > 0){ ?>
                                                <div>·</div>
                                                <div> <?= $c['duration']?> </div>
                                            <?php } ?>
                                        </div>
                                        <div class="pt-2">
                                            <?= $c['prezzo'] ?>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                            <template x-if="inCart('<?= $c['id'] ?>', '')">
                                                <a href="<?= base_url('/order/checkout') ?>" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-black text-center text-base h-8 border" x-text="inCart('<?= $c['id'] ?>', '')"> </a>
                                            </template>

                                            <template x-if="!inCart('<?= $c['id'] ?>', '')">
                                                <button @click="addToCart('<?= $c['id'] ?>', '<?= $c['prezzo'] ?>', '<?= $c['buy_type'] ?>','<?= $c['url'] ?>' ,'corsi')" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-white text-center text-base h-8 hover:text-white hover:bg-blue-700" <?= strlen($c['prezzo']) == 0 ? 'disabled' : '' ?>> <?= strlen($c['prezzo']) == 0 ? lang('front.title_non_disponible') : ($c['buy_type'] != 'date' ?lang('front.btn_add_cart') :lang('front.btn_add_cart_date')) ?> </button>
                                            </template>
                                            <a class="bg-transparent flex items-center justify-center rounded-full text-sm w-8 h-8 dark:bg-gray-800 dark:text-white border-solid border" href="#" uk-slider-item="next"> <i class="icon-feather-heart"></i></a>
                                        </div>
                                </div> 
                            </div>
        
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                
                <a class="absolute bg-white uk-position-center-left -ml-3 flex items-center justify-center p-2 rounded-full shadow-md text-xl w-11 h-11 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
                <a class="absolute bg-white uk-position-center-right -mr-3 flex items-center justify-center p-2 rounded-full shadow-md text-xl w-11 h-11 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>

            </div>


            <!--  slider courses --> 
            <!-- <div class="sm:my-4 my-3 flex items-end justify-between pt-3">
                    <h2 class="text-2xl font-semibold"> Popular Classes  </h2>
                <a href="#" class="text-blue-500 sm:block hidden"> See all </a>
            </div> 

            <div class="mt-3">

                <h4 class="py-3 border-b font-semibold text-grey-700  mx-1 mb-4" hidden> <ion-icon name="star"></ion-icon> Featured today </h4>

                <div class="relative" uk-slider="finite: true">
        
                    <div class="uk-slider-container px-1 py-3">
                        <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-2@s uk-grid-small uk-grid">
                            
                            <li>

                                <a href="course-intro.html" class="uk-link-reset">
                                    <div class="bg-white  uk-transition-toggle">
                                        <div class="w-full h-40 overflow-hidden rounded-t-lg relative">
                                            <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                            <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-12 h-12 uk-position-center uk-transition-fade" alt="">
                                        </div>
                                        <div class="p-4">
                                            <div class="font-semibold line-clamp-2"> Learn JavaScript and Express to become a professional
                                            JavaScript developer. </div>
                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                <div>  13 hours  </div>
                                                <div>·</div>
                                                <div> 32 lectures </div>
                                            </div>
                                            <div class="pt-1 flex items-center justify-between">
                                                <div class="text-sm font-semibold"> John Michael </div>
                                                <div class="text-lg font-semibold"> $14.99 </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </li>
                            <li>

                                <a href="course-intro.html" class="uk-link-reset">
                                    <div class="bg-white  uk-transition-toggle">
                                        <div class="w-full h-40 overflow-hidden rounded-t-lg relative">
                                            <img src="<?= base_url('front') ?>/assets/images/courses/img-2.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                            <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-12 h-12 uk-position-center uk-transition-fade" alt="">
                                        </div>
                                        <div class="p-4">
                                            <div class="font-semibold line-clamp-2">Learn Angular Fundamentals From beginning to advance </div>
                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                <div>  26 hours  </div>
                                                <div>·</div>
                                                <div> 26 lectures </div>
                                            </div>
                                            <div class="pt-1 flex items-center justify-between">
                                                <div class="text-sm font-semibold"> Stella Johnson </div>
                                                <div class="text-lg font-semibold"> $18.99  </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>

                            </li>
                            <li>

                                <a href="course-intro.html" class="uk-link-reset">
                                    <div class="bg-white  uk-transition-toggle">
                                        <div class="w-full h-40 overflow-hidden rounded-t-lg relative">
                                            <img src="<?= base_url('front') ?>/assets/images/courses/img-3.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                            <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-12 h-12 uk-position-center uk-transition-fade" alt="">
                                        </div>
                                        <div class="p-4">
                                            <div class="font-semibold line-clamp-2">Responsive Web Design Essentials HTML5 CSS3 Bootstrap </div>
                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                <div>  18 hours  </div>
                                                <div>·</div>
                                                <div> 42 lectures </div>
                                            </div>
                                            <div class="pt-1 flex items-center justify-between">
                                                <div class="text-sm font-semibold"> Monroe Parker </div>
                                                <div class="text-lg font-semibold"> $11.99 </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </li> 
                            <li>

                                <a href="course-intro.html" class="uk-link-reset">
                                    <div class="bg-white  uk-transition-toggle">
                                        <div class="w-full h-40 overflow-hidden rounded-t-lg relative">
                                            <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                            <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-12 h-12 uk-position-center uk-transition-fade" alt="">
                                        </div>
                                        <div class="p-4">
                                            <div class="font-semibold line-clamp-2"> Learn JavaScript and Express to become a professional
                                JavaScript developer. </div>
                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                <div> 32 hours  </div>
                                                <div>·</div>
                                                <div>  lec 4 </div>
                                            </div>
                                            <div class="pt-1 flex items-center justify-between">
                                                <div class="text-sm font-semibold"> Jesse Stevens </div>
                                                <div class="text-lg font-semibold"> $29.99 </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </li>

                        </ul>

                        <a class="absolute bg-white top-1/4 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
                        <a class="absolute bg-white top-1/4 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>

                    </div>
                </div>
            
            </div> -->
            
            <?php if(!empty($category)) { ?>
            <div class="mt-8">

                <!-- title -->
                <div class="mb-2">
                    <!-- <div class="text-xl font-semibold">  The world's largest selection of courses  </div> -->
                    <h2 class="text-2xl font-semibold"><?php echo lang('front.title_cours_by_categ')?>  </h2>
                    <!-- <div class="text-sm mt-2">  Choose from 130,000 online video courses with new additions published every month </div> -->
                </div>

                
                <!-- nav -->
                <nav class="cd-secondary-nav border-b md:m-0 -mx-4 nav-small">
                    <ul uk-tab>
                        <?php foreach($uniqueCat as $cat) { ?>
                            <li :class="active == <?= $cat['id'] ?> ? 'active' : ''" ><a href="#" @click="getCourses('<?= $cat['id'] ?>')" class="lg:px-2"> <?= $cat['titolo'] ?> </a></li>
                        <?php } ?>
                    </ul>
                </nav>

                <!--  slider -->
                <div class="mt-3">

                    <h4 class="py-3 border-b font-semibold text-grey-700  mx-1 mb-4" hidden> <ion-icon name="star"></ion-icon> Featured today </h4>

                    <div class="relative" uk-slider="finite: true">
                            
                        <div class="uk-slider-container px-1 py-3">
                            
                            <ul class="uk-slider-items uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-small uk-grid" x-html="courses">
                                

                                <!-- <li>

                                    <a href="course-intro.html" class="uk-link-reset">
                                        <div class="card uk-transition-toggle flex-1">
                                            <div class="card-media h-40">
                                                <div class="card-media-overly"></div>
                                                <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="" class="">
                                                <span class="icon-play"></span>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="font-semibold line-clamp-2" x-html="course.titolo">  </div>
                                                <div class="flex space-x-2 items-center text-sm pt-3">
                                                    <div> 13 hours  </div>
                                                    <div> · </div>
                                                    <div> 32 lectures </div>
                                                </div>
                                                <div class="pt-1 flex items-center justify-between">
                                                    <div class="text-sm font-medium"> John Michael </div>
                                                    <div class="text-lg font-semibold"> $14.99 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </li> -->

                                

                            </ul>

                            <!-- slide icons -->
                            <a class="absolute bg-white top-1/4 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
                            <a class="absolute bg-white top-1/4 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>

                        </div>
                    </div>

                </div>
                <div id="video-promo" uk-modal>
                    <div class="uk-modal-dialog shadow-lg rounded-md">
                        <button class="uk-modal-close-default m-2.5" type="button" uk-close></button>
                        <div class="uk-modal-header  rounded-t-md">
                            <h4 class="text-lg font-semibold mb-2" x-text="sotto_titolo"></h4>
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
            <?php } ?>
            

        </div>
</div>
<?= view($view_folder.'/common/footer') ?>

<script>
        String.prototype.trunc = 
            function(n){
                return this.substr(0,n-1)+(this.length>n?'&hellip;':'');
        };


    function getSlideData(){
        return {
            video_url: '',
            sotto_titolo: '',
            active: <?= $category[0]['id'] ?? 'null' ?>,
            courses: '',
            getCourses(id){
                this.active = id;
                fetch(`<?= base_url('/getCourses') ?>?category=${id}`, {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() )
                        .then(res => 
                            {
                                this.courses = '';
                                let type_cours = <?= json_encode($type_cours) ?>;
                
                                JSON.parse(res).forEach(element => {
                                let default_image= '<?= base_url('front/assets/images/courses/img-4.jpg') ?>';
                                switch(element.tipologia_corsi){
                                    case 'online': if(<?=(($settings['default_img_online'] ?? '')!="") ? 1 : 0?>) {default_image='<?=base_url('uploads/'.($settings['default_img_online'] ??''))?>'}; break;
                                    case 'aula': if(<?=(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") ? 1 : 0?>) default_image='<?= base_url('uploads/'.($settings['default_img_aula']??''))?>'; break;
                                    case 'webinar': if(<?=(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") ? 1 : 0?>) default_image='<?=base_url('uploads/'.($settings['default_img_webinar'] ?? ''))?>'; break;
                                }
                                    this.courses += `   <li>

                                                                <div class="card uk-transition-toggle flex-1 flex flex-col justify-between">
                                                                    <div class="card-media h-auto flex items-center" @click="showModalPromo('https://www.youtube.com/embed/${element.video_promo}', '${element.sotto_titolo}')">
                                                                        <div class="card-media-overly"></div>
                                                                        <img src="${element.foto ? '<?=base_url('uploads/corsi/')?>/'+element.foto : default_image}" alt="" class="">
                                                                            ${element.video_promo ? '<span class="icon-play"></span>' : ''}
                                                                            
                                                                    </div>
                                                                        <div class="card-body p-4">
                                                                            <a href="${'<?=base_url('corsi')?>/'+element.url}">

                                                                                <div class="font-semibold line-clamp-2"> ${element.sotto_titolo.trunc(20)}</div>
                                                                            </a>
                                                                                
                                                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                                                <div><a href="<?= base_url('corsi') ?>?tipo=${element.tipologia_corsi}">${type_cours[element.tipologia_corsi] ? type_cours[element.tipologia_corsi] : element.tipologia_corsi} </a> </div>
                                                                                <div>·</div>
                                                                                <div> ${element.modulo_count+ ' modul'+ (element.modulo_count > 1 ? 'i': 'o')} </div>
                                                                                ${(element.duration &&  element.duration.length > 0) ?
                                                                                    '<div>·</div><div>' +element.duration+ '</div>' : ''}
                                                                            </div>
                                                                            <div class="pt-1 flex items-center justify-between">
                                                                                <div class="text-sm font-semibold"> ${element.doctor_names}  </div>
                                                                                <div class="text-lg font-semibold"> ${element.prezzo} </div>
                                                                            </div>

                                                                            <div class="flex justify-between items-center mt-2">
                                                                                <template x-if="inCart(${element.id}, ${element.id})">
                                                                                    <a href="<?= base_url('/order/checkout') ?>" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-black text-center text-base h-8 border" x-text="inCart('${element.id}, ${element.id})"> </a>
                                                                                </template>

                                                                                <template x-if="!inCart(${element.id}, ${element.id})">
                                                                                    <button @click="addToCart(${element.id}, '${element.prezzo}', '${element.buy_type}', '${element.url}', 'corsi')" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-white text-center text-base h-8 hover:text-white hover:bg-blue-700" ${element.prezzo.length == 0 ? 'disabled' : ''}> ${element.prezzo.length == 0 ? '<?=lang('front.title_non_disponible')?>' : element.buy_type != 'date' ? '<?=lang('front.btn_add_cart') ?>' : '<?=lang('front.btn_add_cart_date') ?>'} </button>
                                                                                </template>
                                                                                <a class="bg-transparent flex items-center justify-center rounded-full text-sm w-8 h-8 dark:bg-gray-800 dark:text-white border-solid border" href="#" uk-slider-item="next"> <i class="icon-feather-heart"></i></a>
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                        </li>   `
                                });
                            }
                        )
            },
            showModalPromo(urlvid,sotto_titolo) {
                // console.log(urlvid);
                this.sotto_titolo = sotto_titolo
                this.video_url = urlvid
                if (urlvid && urlvid != '') {
                    UIkit.modal('#video-promo').show();
                }
            },
            init(){
                let type_cours = <?= json_encode($type_cours) ?>;
                
                <?= json_encode($courses) ?>.forEach(element => {
                let default_image= '<?= base_url('front/assets/images/courses/img-4.jpg') ?>';
                switch(element.tipologia_corsi){
                    case 'online': if(<?=(($settings['default_img_online'] ?? '')!="") ? 1 : 0?>) {default_image='<?=base_url('uploads/'.($settings['default_img_online'] ??''))?>'}; break;
                    case 'aula': if(<?=(isset( $settings['default_img_aula']) && $settings['default_img_aula']!="") ? 1 : 0?>) default_image='<?= base_url('uploads/'.($settings['default_img_aula']??''))?>'; break;
                    case 'webinar': if(<?=(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!="") ? 1 : 0?>) default_image='<?=base_url('uploads/'.($settings['default_img_webinar'] ?? ''))?>'; break;
                }
                    this.courses += `   <li>

                                                <div class="card uk-transition-toggle flex-1 flex flex-col justify-between">
                                                    <div class="card-media h-auto flex items-center" @click="showModalPromo('https://www.youtube.com/embed/${element.video_promo}', '${element.sotto_titolo}')">
                                                        <div class="card-media-overly"></div>
                                                        <img src="${element.foto ? '<?=base_url('uploads/corsi/')?>/'+element.foto : default_image}" alt="" class="">
                                                            ${element.video_promo ? '<span class="icon-play"></span>' : ''}
                                                            
                                                    </div>
                                                        <div class="card-body p-4">
                                                            <a href="${'<?=base_url('corsi')?>/'+element.url}">

                                                                <div class="font-semibold line-clamp-2"> ${element.sotto_titolo.trunc(20)}</div>
                                                            </a>
                                                            <div class="flex space-x-2 items-center text-sm pt-3">
                                                                <div><a href="<?= base_url('corsi') ?>?tipo=${element.tipologia_corsi}">${type_cours[element.tipologia_corsi] ? type_cours[element.tipologia_corsi] : element.tipologia_corsi} </a> </div>
                                                                <div>·</div>
                                                                <div> ${element.modulo_count+ ' modul'+ (element.modulo_count > 1 ? 'i': 'o')} </div>
                                                                ${(element.duration && element.duration.length> 0) ?
                                                                '<div>·</div><div>' +element.duration+ '</div>' : ''}
                                                            </div>
                                                            <div class="pt-1 flex items-center justify-between">
                                                                <div class="text-sm font-semibold"> ${element.doctor_names}  </div>
                                                                <div class="text-lg font-semibold"> ${element.prezzo} </div>
                                                            </div>
                                                            

                                                            <div class="flex justify-between items-center mt-2">
                                                                <template x-if="inCart(${element.id}, ${element.id})">
                                                                    <a href="<?= base_url('/order/checkout') ?>" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-black text-center text-base h-8 border" x-text="inCart(${element.id}, ${element.id})"> </a>
                                                                </template>

                                                                <template x-if="!inCart(${element.id}, ${element.id})">
                                                                    <button @click="addToCart(${element.id}, '${element.prezzo}', '${element.buy_type}', '${element.url}', 'corsi')" class="bg-blue-600 flex justify-center items-center w-9/12 rounded-md text-white text-center text-base h-8 hover:text-white hover:bg-blue-700" ${element.prezzo.length == 0 ? 'disabled' : ''}> ${element.prezzo.length == 0 ? '<?=lang('front.title_non_disponible')?>' : element.buy_type != 'date' ? '<?=lang('front.btn_add_cart') ?>' : '<?=lang('front.btn_add_cart_date') ?>'} </button>
                                                                </template>
                                                                <a class="bg-transparent flex items-center justify-center rounded-full text-sm w-8 h-8 dark:bg-gray-800 dark:text-white border-solid border" href="#" uk-slider-item="next"> <i class="icon-feather-heart"></i></a>
                                                            </div>
                                                        </div>
                                                </div>

                                        </li>   `
                });
            }
        }
    }
</script>
  
<?= view($view_folder.'/common/close') ?>
