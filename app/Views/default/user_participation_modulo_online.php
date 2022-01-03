<!DOCTYPE html>
<html lang="en">

<head> 

    <!-- Basic Page Needs
    ================================================== -->
    <title><?php echo $seo_title ?? 'AuleDigitale'?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="<?php echo $seo_description ?? 'AuleDigitale Corso plateform'?>">

    <!-- Favicon -->
   <?php if(($settings['faveicon_website'] ?? null)!==null){?>
	 <link href="<?= base_url('uploads/'.$settings['faveicon_website']) ?>" rel="icon" type="image/png">
	<?php }else{?>
    <link href="<?= base_url('front') ?>/assets/images/favicon.png" rel="icon" type="image/png">
	<?php } ?>

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/icons.css">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/uikit.css">
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
let players=new Array;
</script>
</head>


<body class="bg-white">

    <div id="wrapper" class="course-watch">  
        
        <!-- sidebar -->
        <div class="sidebar">
           
            <!-- slide_menu for mobile -->
            <span class="btn-close-mobi right-3 left-auto" uk-toggle="target: #wrapper ; cls: is-active"></span>

            <!-- back to home link -->
            <div class="flex justify-between lg:-ml-1 mt-1 mr-2">
                <a href="<?php echo base_url('user/participation')?>" class="flex items-center text-blue-500">
                    <ion-icon name="chevron-back-outline" class="md:text-lg text-2xl"></ion-icon>  
                    <span class="text-sm md:inline hidden"> <?php echo lang('front.menu_back')?></span>
                </a>
            </div>

            <!-- title -->
            <h1 class="lg:text-2xl text-lg font-bold mt-2 line-clamp-2"> <?php echo $module['sotto_titolo']?> </h1>
 
            <!-- sidebar list -->
            <div class="sidebar_inner is-watch-2" data-simplebar>

                <div class="lg:inline hidden">
                    <div class="relative overflow-hidden rounded-md bg-gray-200 h-1 mt-4">
                        <div class="w-2/4 h-full bg-green-500"></div>
                    </div>
                    <div class="mt-2 mb-3 text-sm border-b pb-3">
                        <div> 46% Complete</div>
                        <div> Last activity on April 20, 2021</div>
                    </div>
                </div>

                <div id="curriculum"> 
                    <div uk-accordion="multiple: true" class="divide-y space-y-3">
						<?php if(!empty($list_vimeo)){
							foreach($list_vimeo as $k =>$one_vimeo){
								
								?>
								
							
                        <div id="vimeo_<?php echo $one_vimeo['id']?>" class="<?php if(isset($last_opened['id']) && $one_vimeo['id']==$last_opened['id']) echo 'uk-open'; else echo 'pt-2'?>">
                            <a class="uk-accordion-title text-md mx-2 font-semibold" href="#">  <div class="mb-1 text-sm font-medium"> <?php echo lang('front.field_section')?> <?php echo $k+1?> </div><span id="vimeo_title_<?php echo $one_vimeo['id']?>"> &nbsp;</span> </a>
                            <div class="uk-accordion-content mt-3">
                             
                                <ul class="course-curriculum-list" id="list_chapter_module_<?php echo $one_vimeo['id']?>">
                                   
                                </ul>
    
                            </div>
                        </div>
							<?php }
						}?>
						<?php /*
                        <div class="pt-2">
                            <a class="uk-accordion-title text-md mx-2 font-semibold" href="#"> <div class="mb-1 text-sm font-medium"> Section 2 </div> Your First webpage  </a>
                            <div class="uk-accordion-content mt-3">
    
                                <ul class="course-curriculum-list">
                                    <li>
                                        <a href="#modal-example" uk-toggle>
                                             Headings
                                            <span> 4 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#modal-example" uk-toggle>
                                             Paragraphs
                                            <span> 5 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#modal-example" uk-toggle>
                                            Emphasis and Strong Tag
                                            <span> 8 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#modal-example" uk-toggle>
                                            Brain Streak
                                            <span> 4 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#modal-example" uk-toggle>
                                            Live Preview Feature
                                            <span> 5 min </span>
                                        </a>
                                    </li>
                                </ul>
    
                            </div>
                        </div>
                        <div class="pt-2">
                            <a class="uk-accordion-title text-md mx-2 font-semibold" href="#"> <div class="mb-1 text-sm font-medium"> Section 3 </div> Build Complete Webste  </a>
                            <div class="uk-accordion-content mt-3">
    
                                <ul class="course-curriculum-list font-medium">
                                    <li>
                                        <a href="#">
                                             The paragraph tag
                                            <span class="hidden"> 4 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                             The break tag
                                            <span class="hidden"> 5 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Headings in HTML
                                            <span class="hidden"> 8 min </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Bold, Italics Underline
                                            <span class="hidden"> 4 min </span>
                                        </a>
                                    </li>
                                </ul>
    
                            </div> */?>
                        </div>
                    </div>
                </div>

             <?php /*   <div class="mt-5">
                    <h3 class="mb-4 text-lg font-semibold"> Quizzes</h3>
                    <ul>
                        <li><a href="#"> <ion-icon name="timer-outline" class="side-icon"></ion-icon>   Taking small eco-friendly steps </a></li> 
                        <li><a href="#"> <ion-icon name="timer-outline" class="side-icon"></ion-icon>   Making your house eco-friendly </a></li> 
                        <li><a href="#"> <ion-icon name="timer-outline" class="side-icon"></ion-icon>   Building and renovating for eco-friendly homes </a></li> 
                        <li><a href="#"> <ion-icon name="log-in-outline" class="side-icon"></ion-icon> Taking small eco-friendly  </a>
                            <ul>
                                <li><a href="#"> Making your house </a></li>
                                <li><a href="#"> Building and renovating </a></li>
                                <li><a href="#"> Taking small </a></li>
                            </ul>
                        </li> 
                    </ul>
    
                </div>
*/?>
            </div>

            <!-- overly for mobile -->
            <div class="side_overly" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></div>
            

        <!-- Main Contents -->
        <div class="main_content">

            <div class="relative">

                <ul class="uk-switcher relative z-10" id="video_tabs">

                    <li class="video_tabs_li">
                        <!-- to autoplay video uk-video="automute: true" -->
						<?php if(!empty($list_vimeo)){
							foreach($list_vimeo as $k =>$one_vimeo){
								
								?>
                        <!--div class="embed-video" id="current_video">
                            <iframe src="https://www.youtube.com/embed/9gTw2EDkaDQ" frameborder="0"
                                uk-video="automute: true" allowfullscreen uk-responsive></iframe>
                        </div-->
						<div class="embed-video" id="iframe_vimeo_<?php echo $one_vimeo['id']?>" <?php if(!isset($last_opened['id']) || $one_vimeo['id']!=$last_opened['id']){?>style="display:none"<?php } ?>></div>
							<script>
							 var options = {
        url: 'https://vimeo.com/<?php echo $one_vimeo["vimeo"]?>',
		myID:'<?php echo $one_vimeo["id"]?>',
     //   width: 640,
        loop: false
    };

    var player = new Vimeo.Player('iframe_vimeo_<?php echo $one_vimeo["id"]?>', options);

    player.setVolume(1);
	player.setCurrentTime(0);

    player.on('play', function() {
        console.log('played the video!');
    });
	player.getVideoTitle().then(function(title) {
		
		 $('#vimeo_title_<?php echo $one_vimeo["id"]?>').html('title:'+title);
		});
	player.getChapters().then(function(chapters) {
		if(chapters.length>0){
		jQuery.each( chapters, function( i, val ) {
			let totalSeconds = val.startTime;
			let hours = Math.floor(totalSeconds / 3600);
			totalSeconds %= 3600;
			let minutes = Math.floor(totalSeconds / 60);
			let seconds = totalSeconds % 60;
	
			minutes = String(minutes).padStart(2, "0");
			hours = String(hours).padStart(2, "0");
			seconds = String(seconds).padStart(2, "0");
		
			var str=minutes + ":" + seconds;
			if(hours>0) str=hours + ":"+str;
			$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li onclick=\"clk_chapter('"+val.startTime+"','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\" ><a class='next_chapter'>"+val.title+"<span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
		});
		}
		else{
			player.getDuration().then(function(duration) {
						let totalSeconds = duration;
			let hours = Math.floor(totalSeconds / 3600);
			totalSeconds %= 3600;
			let minutes = Math.floor(totalSeconds / 60);
			let seconds = totalSeconds % 60;
	
			minutes = String(minutes).padStart(2, "0");
			hours = String(hours).padStart(2, "0");
			seconds = String(seconds).padStart(2, "0");
		
			var str=minutes + ":" + seconds;
			if(hours>0) str=hours + ":"+str;
				$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li onclick=\"clk_chapter('0','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\"><a href='#' ><?php echo lang('front.btn_play_video')?><span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
			});
			
		}
	}).catch(function(error) {
		// an error occurred
	});
	
	<?php if(isset($last_opened['id']) && $one_vimeo['id']==$last_opened['id']){?>
	let options_current =options;
	 let player_current =player;
	
	<?php } ?>
	players[<?php echo $one_vimeo["id"]?>]=new Array(player,options);
	
	
							</script>
						<?php } }?>
                    </li>
                <?php /*    <li>
                        <div class="embed-video">
                            <iframe src="https://www.youtube.com/embed/dDn9uw7N9Xg" frameborder="0" allowfullscreen
                                uk-responsive></iframe>
                        </div>
                    </li>
                    <li>
                        <div class="embed-video">
                            <iframe src="https://www.youtube.com/embed/CGSdK7FI9MY" frameborder="0" allowfullscreen
                                uk-responsive></iframe>
                        </div>
                    </li>
                    <li>
                        <div class="embed-video">
                            <iframe src="https://www.youtube.com/embed/4I1WgJz_lmA" frameborder="0" allowfullscreen
                                uk-responsive></iframe>
                        </div>
                    </li>
                    <li>
                        <div class="embed-video">
                            <iframe src="https://www.youtube.com/embed/dDn9uw7N9Xg" frameborder="0" allowfullscreen
                                uk-responsive></iframe>
                        </div>
                    </li>
                    <li>
                        <div class="embed-video">
                            <iframe src="https://www.youtube.com/embed/CPcS4HtrUEU" frameborder="0" allowfullscreen
                                uk-responsive></iframe>
                        </div>
                    </li>
*/?>
                </ul>
 
                <div class="bg-gray-200 w-full h-full absolute inset-0 animate-pulse"></div>

            </div>
           
            <nav class="cd-secondary-nav border-b md:p-0 lg:px-6 bg-white " uk-sticky="cls-active:shadow-sm ; media: @s">
                <ul uk-switcher="connect: #course-tabs; animation: uk-animation-fade">
                    <li><a href="#" class="lg:px-2">   <?php echo lang('front.field_description')?> </a></li>
                    <li><a href="#" class="lg:px-2"> <?php echo lang('front.field_cv')?>  </a></li>
                    
                </ul>
            </nav>
            
            <div class="container">
            
                <div class="max-w-2xl lg:py-6 mx-auto uk-switcher" id="course-tabs">
            
                    <!--  Overview -->
                    <div>
                    
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

                    <!--  Announcements -->
                    <div>
                       <h3 class="text-xl font-semibold lg:mb-5"> <?php echo lang('front.field_doctor_cv')?>  </h3>
                            <?php foreach($doctors as $doc){ ?>

                            <div class="flex items-center gap-x-4 mb-5" id="doctor<?= $doc['id'] ?>">
                                <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-4.jpg" alt="" class="rounded-full shadow w-12 h-12">
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

               



                </div>
            </div>

 
            </div>
        </div> 

        <!-- This is the modal -->
        <div id="modal-example" class="lg:ml-80" uk-modal>
            <div class="uk-modal-dialog uk-modal-body rounded-md shadow-xl">
                 
                <button class="absolute block top-0 right-0 m-6 rounded-full bg-gray-100 leading-4 p-1 text-2xl uk-modal-close" type="button">
                    <i class="icon-feather-x"></i>
                </button>

                <div class="text-sm mb-2">  Section 2  </div>
                <h2 class="mb-5 font-semibold text-2xl">  Your First webpage  </h2>
                <p class="text-base">Do You want to skip the rest of this chapter and chumb to next chapter.</p>
        
                <div class="text-right  pt-3 mt-3">
                    <a href="#" class="py-2 inline-block px-8 rounded-md hover:bg-gray-200 uk-modal-close"> Stay </a>
                    <a href="#" class="button"> Continue </a>
                </div>
            </div>
        </div>  

        
    </div>

          
    <!-- Javascript
    ================================================== -->
     <script src="<?= base_url('front') ?>/assets/js/uikit.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/tippy.all.min.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/simplebar.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/custom.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
	
	<script>
	<?php /*if(isset($last_opened)){?>
	let options_current = {
        url: 'https://vimeo.com/<?php echo $last_opened["vimeo"]?>',
		myID:'<?php echo $last_opened["id"]?>',
     //   width: 640,
        loop: false
    };

    let player_current = new Vimeo.Player('current_video', options_current);
console.log(player_current);
    player_current.setVolume(1);
	player_current.setCurrentTime(0);

    player_current.on('play', function() {
        console.log('played the video!');
    });
	
	
	
	<?php } */?>
$(".video_tabs_li").show(0);

function clk_chapter(t,id_row,id_vimeo=null){
	
	console.log(players);
	if(id_row==options_current.myID){
		player_current.setCurrentTime(t).then(function(seconds) {
			// seconds = the actual time that the player seeked to
		}).catch(function(error) {
			switch (error.name) {
				case 'RangeError':
					// the time was less than 0 or greater than the video’s duration
					break;

				default:
					// some other error occurred
					break;
			}
		});
	}
	else{
	
		player_current.pause();
		$(".embed-video").hide(0);
		$("#iframe_vimeo_"+id_row).show(0);
		player_current=players[id_row][0];
		options_current=players[id_row][1];
		player_current.setCurrentTime(t).then(function(seconds) {
			// seconds = the actual time that the player seeked to
		}).catch(function(error) {
			switch (error.name) {
				case 'RangeError':
					// the time was less than 0 or greater than the video’s duration
					break;

				default:
					// some other error occurred
					break;
			}
		});
	}
	//alert(id_modulo);
	//console.log(options_current.myID);
	/*
	if(id_modulo==options_current.myID){
				player_current.setCurrentTime(t).then(function(seconds) {
			// seconds = the actual time that the player seeked to
		}).catch(function(error) {
			switch (error.name) {
				case 'RangeError':
					// the time was less than 0 or greater than the video’s duration
					break;

				default:
					// some other error occurred
					break;
			}
		});
	}
	else{ 
	$("#current_video").html("");
	$("#current_video").attr('data-vimeo-initialized','false');
		let options2 = {
        url: 'https://vimeo.com/'+id_vimeo,
		myID:id_modulo,
     //   width: 640,
        loop: false
    };

    let player2 = new Vimeo.Player('current_video', options2);
console.log(player2);
    player2.setVolume(1);
	player2.setCurrentTime(0);

    player2.on('play', function() { 
        console.log('played the video!');
    });
	//$("#current_video").html(player2.iframe.outerHtml);
	}
	*/
}
</script>
</body>

</html>


