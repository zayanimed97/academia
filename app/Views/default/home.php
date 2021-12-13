<?php require_once 'common/header.php' ?>
  
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
<?php $settings['banner_home'] = (array)json_decode($settings['banner_home'] ?? "" )?>
        <!-- Slideshow -->
        <div class="uk-position-relative contents overflow-hidden lg:-mt-20" tabindex="-1"
        style="min-height: 200; max-height: 500;">
        
        <!-- <ul class="uk-slideshow-items rounded"> -->
            <!-- <li> -->
                <div class="uk-cover-container uk-inline w-full mb-8">
                    <?php if($settings['banner_home']["image"]!=""){?><img src="<?= base_url('uploads/banner/'.$settings['banner_home']["image"]) ?>" class="object-cover" alt="" uk-cover><?php } ?>
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
      
        <div class="mx-auto max-w-5xl p-4">
            
            <!--  course feature -->
            <!-- <div class="sm:my-4 my-3 flex items-end justify-between pt-3">
                <h2 class="text-2xl font-semibold"> Featured Classes   </h2> 
            </div>  -->
            
            <div class="relative -mt-3" uk-slider="finite: true">
                <div class="uk-slider-container px-1 py-3">
                    <ul class="uk-slider-items uk-child-width-1-1@m uk-grid">
                        <li>
                                    
                            <div class="bg-white  uk-transition-toggle md:flex">
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
        
                        </li>
                        <li>
        
                            <div class="bg-white  uk-transition-toggle md:flex">
                                <div class="md:w-5/12 md:h-60 h-40 overflow-hidden rounded-l-lg relative">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                    <img src="<?= base_url('front') ?>/assets/images/icon-play.svg" class="w-16 h-16 uk-position-center uk-transition-fade" alt="">
                                </div>
                                <div class="flex-1 md:p-6 p-4">
                                    <div class="font-semibold line-clamp-2 md:text-xl md:leading-relaxed"> Learn JavaScript and Express to become a professional JavaScript developer. </div>
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
                                
                        </li>
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
            <?php   $uniqueCat = array_reverse(array_values(array_column(
                                        array_reverse($category),
                                        null,
                                        'id'
                                    ))); 
                        $courses =  $CorsiModel ->where('find_in_set( '.($uniqueCat[0]['id'] ?? '').', id_categorie) > 0')
                                                ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                                ->where('banned', 'no')
                                                ->groupBy('corsi.id')
                                                ->select("corsi.*, GROUP_CONCAT(DISTINCT u.display_name) doctor_names")
                                                ->find();
                    
                ?>
            <?php if(!empty($category)) { ?>
            <div x-data="getSlideData" class="mt-8">

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
                                        <div class="card uk-transition-toggle">
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
                            <h4 class="text-lg font-semibold mb-2"> Trailer video </h4>
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
<?= view('default/common/footer') ?>

<script>
        String.prototype.trunc = 
            function(n){
                return this.substr(0,n-1)+(this.length>n?'&hellip;':'');
        };


    function getSlideData(){
        return {
            video_url: '',
            active: <?= $category[0]['id'] ?? '' ?>,
            courses: '',
            getCourses(id){
                this.active = id;
                fetch(`<?= base_url('/getCourses') ?>?category=${id}`, {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() )
                        .then(res => 
                            {
                                this.courses = '';
                                JSON.parse(res).forEach(element => {
                                    this.courses += `   <li>

                                                            <div class="card uk-transition-toggle">
                                                                <div class="card-media h-40 flex items-center" @click="showModalPromo('${element.video_promo}')">
                                                                    <div class="card-media-overly"></div>
                                                                    <img src="${element.foto ? '<?= base_url('uploads/corsi') ?>/'+element.foto : '<?= base_url('front') ?>/assets/images/courses/img-1.jpg'}" alt="" class="">
                                                                    <span class="icon-play"></span>
                                                                </div>
                                                                <a href="${'<?= base_url('/corsi') ?>'+'/'+element.url}">
                                                                    <div class="card-body p-4">
                                                                        <div class="font-semibold line-clamp-2" x-text="'${element.titolo.trunc(20)}'">  </div>
                                                                        <div class="flex space-x-2 items-center text-sm pt-3">
                                                                            <div> 13 hours  </div>
                                                                            <div> · </div>
                                                                            <div> 32 lectures </div>
                                                                        </div>
                                                                        <div class="pt-1 flex items-center justify-between">
                                                                            <div class="text-sm font-medium"> ${element.doctor_names} </div>
                                                                            <div class="text-lg font-semibold"> $14.99 </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>

                                                        </li>   `
                                })
                            }
                        )
            },
            showModalPromo(urlvid) {
                // console.log(urlvid);
                this.video_url = urlvid
                if (urlvid && urlvid != '') {
                    UIkit.modal('#video-promo').show();
                }
            },
            init(){
                <?= json_encode($courses) ?>.forEach(element => {
                    this.courses += `   <li>

                                            <div class="card uk-transition-toggle">
                                                <div class="card-media h-40 flex items-center" @click="showModalPromo('${element.video_promo}')">
                                                    <div class="card-media-overly"></div>
                                                    <img src="${element.foto ? '<?= base_url('uploads/corsi') ?>/'+element.foto : '<?= base_url('front') ?>/assets/images/courses/img-1.jpg'}" alt="" class="">
                                                    ${element.video_promo ? '<span class="icon-play"></span>' : ''}
                                                </div>
                                                <a href="${'<?= base_url('/corsi') ?>'+'/'+element.url}">
                                                    <div class="card-body p-4">
                                                        <div class="font-semibold line-clamp-2" x-text="'${element.titolo.trunc(20)}'">  </div>
                                                        <div class="flex space-x-2 items-center text-sm pt-3">
                                                            <div> 13 hours  </div>
                                                            <div> · </div>
                                                            <div> 32 lectures </div>
                                                        </div>
                                                        <div class="pt-1 flex items-center justify-between">
                                                            <div class="text-sm font-medium"> ${element.doctor_names} </div>
                                                            <div class="text-lg font-semibold"> $14.99 </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </li>   `
                });
            }
        }
    }
</script>
  
<?= view('default/common/close') ?>
