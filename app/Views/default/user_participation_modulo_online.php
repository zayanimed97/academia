<?php use CodeIgniter\I18n\Time;?>
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
let options_current =new Object ;//options;
let player_current =new Object ;//player;
//window.a_href
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
                        <div class="<?php echo $total_vimeo_width?>  h-full bg-green-500"></div>
                    </div>
                    <div class="mt-2 mb-3 text-sm border-b pb-3">
                        <div> <?php  echo $total_vimeo_percent.'% '.lang('front.status_completed') ?></div>
                        <div> <?php if(!empty($last_activity)){
							$time = Time::parse($last_activity['created_at'], 'Europe/Rome', 'it_IT');
							echo lang('front.text_last_activity').' <b>'.$time->toLocalizedString('d MMM Y, H:m').'</b>'; 
						}?></div>
                    </div>
                </div>

                <div id="curriculum"> 
                    <div uk-accordion="multiple: true" class="divide-y space-y-3">
						<?php if(!empty($list_vimeo)){
							foreach($list_vimeo as $k =>$one_vimeo){
								
								?>
								
							
                        <div id="vimeo_<?php echo $one_vimeo['id']?>" class="<?php if(isset($last_opened['id']) && $one_vimeo['id']==$last_opened['id']) echo 'uk-open'; else echo 'pt-2'?>">

                            <a class="uk-accordion-title text-md mx-2 font-semibold modulo_vimeo" href="#">  
                                <!-- <div class="mb-1 text-sm font-medium"> <?php echo lang('front.field_section')?> <?php echo $k+1?> </div> -->
                                <span id="vimeo_title_<?php echo $one_vimeo['id']?>"> &nbsp;</span> 
                            </a>

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
								if(isset($inf_last_status[$one_vimeo['vimeo']])) $vimeo_position=$inf_last_status[$one_vimeo['vimeo']]['cursor_position'];
								else $vimeo_position=0;
							//echo $vimeo_position;
								//var_dump($inf_last_status[$one_vimeo['vimeo']]['cursor_position']);
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
		vimeo_id:'<?php echo $one_vimeo["vimeo"]?>',
		cuepoint_block:'<?php echo $module["cuepoint_block"]?>',
        loop: false
    };
	//console.log(options);
    var player = new Vimeo.Player('iframe_vimeo_<?php echo $one_vimeo["id"]?>', options);

    player.setVolume(1);
	player.setCurrentTime(<?php echo intval($vimeo_position) ?? 0 ?>);
	//player.setCurrentTime(<?php if(!empty($last_status) && $last_status['cursor_position']>0) echo $last_status['cursor_position']; else echo 0;?>);
//	player.setCurrentTime(<?php if(!empty($inf_last_status[$one_vimeo['vimeo']]) && $inf_last_status[$one_vimeo['vimeo']]['cursor_position']>0) echo $inf_last_status[$one_vimeo['vimeo']]['cursor_position']; else echo 0;?>);
    player.on('play', function() {
        console.log('played the video!');
		/*player.getCurrentTime().then(function(seconds) {
			console.log(seconds);
			var cursor_position=seconds;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",action:"play",cursor_position:cursor_position}
			})
			 .done(function( msg ) {
				alert(msg);
				console.log('event saved!');
			});
		});*/
		
    });
	player.getVideoTitle().then(function(title) {
		
		 $('#vimeo_title_<?php echo $one_vimeo["id"]?>').html(title);
		});
	player.getChapters().then(function(chapters) {
		//console.log(chapters);
		if(chapters.length>0){
			console.log("1");
		jQuery.each( chapters, function( i, val ) {
		//	console.log(val);
			var str="";
			let totalSeconds = val.startTime;
			let hours = Math.floor(totalSeconds / 3600);
			totalSeconds %= 3600;
			let minutes = Math.floor(totalSeconds / 60);
			let seconds = totalSeconds % 60;
	
			minutes = String(minutes).padStart(2, "0");
			hours = String(hours).padStart(2, "0");
			seconds = String(seconds).padStart(2, "0");
		
			str=minutes + ":" + seconds;
			if(hours>0) str=hours + ":"+str;
			//console.log(str);
			if(i==0 && val.startTime>0){  
				$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li onclick=\"clk_chapter('0','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\"><a href='#' ><?php echo lang('front.btn_play_video')?><span style='font-weight:normal;'><i class='fa fa-clock'></i> 00:00</span></a></li>");
			}
			if(options.cuepoint_block=='yes'){
				if(val.startTime<=<?php echo $vimeo_position?>)
					$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li id='<?php echo $one_vimeo['id']?>_cue_point_"+i+"' onclick=\"clk_chapter('"+val.startTime+"','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\" ><a class='next_chapter'>"+val.title+"<span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
				else{
					$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li id='<?php echo $one_vimeo['id']?>_cue_point_"+i+"' uk-toggle=\"target: #modal-example \"  ><a class='next_chapter'>"+val.title+"<span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
				}
			}
			else{
				
				$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li id='<?php echo $one_vimeo['id']?>_cue_point_"+i+"' onclick=\"clk_chapter('"+val.startTime+"','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\" ><a class='next_chapter'>"+val.title+"<span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
			}
		});
		}
		else{
			//console.log("2");
			//$("#list_chapter_module_<?php echo $one_vimeo['id']?>").parent().removeClass('uk-accordion-content');
				$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li onclick=\"clk_chapter('0','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\" ><a href='#' ><?php echo lang('front.btn_play_video')?><span style='font-weight:normal;'><i class='fa fa-clock'></i></span></a></li>");
			
			
			//$("#list_chapter_module_<?php echo $one_vimeo['id']?>").append("<li uk-toggle=\"target: #modal-example \" ><a href='#' ><?php echo lang('front.btn_play_video')?><span style='font-weight:normal;'><i class='fa fa-clock'></i> "+str+"</span></a></li>");
		}
		/*else{
			console.log("2",player.getVideoTitle());
			player.getDuration().then(function(duration) {
				console.log(duration)
						let totalSeconds = duration;
			let hours = Math.floor(totalSeconds / 3600);
			totalSeconds %= 3600;
			let minutes = Math.floor(totalSeconds / 60);
			let seconds = totalSeconds % 60;
	
			minutes = String(minutes).padStart(2, "0");
			hours = String(hours).padStart(2, "0");
			seconds = String(seconds).padStart(2, "0");
			var str="";
			 str=minutes + ":" + seconds;
			if(hours>0) str=hours + ":"+str;
			//console.log(str);
			//if(val.startTime<=<?php echo $vimeo_position?>)

                let sezione = $($("#list_chapter_module_<?php echo $one_vimeo['id']?>") .parent()
                                                                        .parent()
                                                                        .first('.modulo_vimeo')
                                                                        .find('.mb-1.text-sm.font-medium')[0]).text();
                let title = $($("#list_chapter_module_<?php echo $one_vimeo['id']?>") .parent()
                                                                        .parent()
                                                                        .first('.modulo_vimeo')
                                                                        .find('span')[0]).text();
				$($("#list_chapter_module_<?php echo $one_vimeo['id']?>") .parent()
                                                                                    .parent()[0])
                                                                                    .html("\<div class=\" flex items-center justify-start \">\<div class=\"one_chap_play_icon\"></div>\ <div onclick=\"clk_chapter('0','<?php echo $one_vimeo['id']?>','<?php echo $one_vimeo['vimeo']?>')\" class=\"one_chap text-md mx-2 font-semibold cursor-pointer\">\<div class=\" flex justify-between mb-1 text-sm font-medium \"><div>"+str+"</div></div>\<span id=\"vimeo_title_38\">"+ title.replace('title:', '') +"</span>\</div>\</div>\");
                                   
               

			
			});
			
		}*/
	}).catch(function(error) {
		// an error occurred
	});
	
	<?php if(isset($last_opened['id']) && $one_vimeo['id']==$last_opened['id']){?>
	 options_current =options;
	player_current =player;
	player_current.on('play', function() {
        console.log('played the video!');
			player_current.getDuration().then(function(duration_video) {
		player_current.getCurrentTime().then(function(seconds) {
			
			var cursor_position=seconds;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"play",cursor_position:cursor_position,duration_video:duration_video}
			})
			 .done(function( msg ) {
				
				console.log('event saved!');
			});
		});
		});
    });
	player_current.on('pause', function() {
        console.log('stoped the video!'+options_current.myID);
		player_current.getDuration().then(function(duration_video) {
		player_current.getCurrentTime().then(function(seconds) {
			
			var cursor_position=seconds;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"stop",cursor_position:cursor_position,duration_video:duration_video}
			})
			 .done(function( msg ) {
				//alert('stop');
				console.log('event saved!');
			});
		});
		});
    });
	
	player_current.on('ended', function() {
        console.log('end of video!');
		player_current.getDuration().then(function(duration) {
			//alert(duration);
			var cursor_position=duration;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"end",cursor_position:cursor_position,duration_video:duration}
			})
			 .done(function( msg ) {
				//alert('ended');
				console.log('event saved!');
			});
		});
		
    });
	
	setInterval(function() {
	
		player_current.getCurrentTime().then(function(seconds) {
			player_current.getChapters().then(function(chapters) {
				if(chapters.length>0){
					jQuery.each( chapters, function( i, val ) {
						if(val.startTime<=seconds){
						
							$("#"+options_current.myID+"_cue_point_"+i).removeAttr("uk-toggle");
							$("#"+options_current.myID+"_cue_point_"+i).attr('onclick',"clk_chapter('"+val.startTime+"','"+options_current.myID+"','"+options_current.vimeo_id+"')");
						}
					}).catch(function(error) {
						// an error occurred
					});
	
				}
			});
		});
}, 5000);
	
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
                    <?php if(count($pdfs) > 0) { ?>
                        <li><a href="#Materiel"><?php echo lang('front.materiel')?> </a></li>
                    <?php } ?>
                    
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
                                                    <a href="<?= base_url('user/getFile/'.$pdf['id']) ?>" class="flex items-center justify-center h-9 px-6 rounded-md bg-blue-600 text-white"> <?php echo lang('front.btn_download_attachment')?> </a>
                                                </span>
                                            </li>
                                            <?php } ?>
                                        </ul>
            
                                    </div>
                            </div> 
                        </div>
                    <?php } ?>



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

               
                <h2 class="mb-5 font-semibold text-2xl">  <?php echo lang('front.title_modal_block_video')?>  </h2>
                <p class="text-base"><?php echo lang('front.msg_modal_block_video')?> </p>
        
                <div class="text-right  pt-3 mt-3">
                    <button  class="py-2 inline-block px-8 button uk-modal-close"> <?php echo lang('front.btn_close')?> </button>
                   
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
		
		player_current.on('play', function() {
        console.log('played the video!');
			player_current.getDuration().then(function(duration_video) {
		player_current.getCurrentTime().then(function(seconds) {
			
			var cursor_position=seconds;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"play",cursor_position:cursor_position,duration_video:duration_video}
			})
			 .done(function( msg ) {
				
				console.log('event saved!');
			});
		});
		});
    });
	player_current.on('pause', function() {
        console.log('stoped the video!');
		player_current.getDuration().then(function(duration_video) {
		player_current.getCurrentTime().then(function(seconds) {
			
			var cursor_position=seconds;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"stop",cursor_position:cursor_position,duration_video:duration_video}
			})
			 .done(function( msg ) {
				//alert('stop');
				console.log('event saved!');
			});
		});
		});
    });
	
	player_current.on('ended', function() {
        console.log('end of video!');
		player_current.getDuration().then(function(duration) {
			//alert(duration);
			var cursor_position=duration;
			$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"end",cursor_position:cursor_position,duration_video:duration}
			})
			 .done(function( msg ) {
				//alert('ended');
				console.log('event saved!');
			});
		});
		
    });
	
	setInterval(function() {
	
		player_current.getCurrentTime().then(function(seconds) {
			player_current.getChapters().then(function(chapters) {
				if(chapters.length>0){
					jQuery.each( chapters, function( i, val ) {
						if(val.startTime<=seconds){
						
							$("#"+options_current.myID+"_cue_point_"+i).removeAttr("uk-toggle");
							$("#"+options_current.myID+"_cue_point_"+i).attr('onclick',"clk_chapter('"+val.startTime+"','"+options_current.myID+"','"+options_current.vimeo_id+"')");
						}
					}).catch(function(error) {
						// an error occurred
					});
	
				}
			});
		});
}, 5000);
		
	}
	
	
	$.ajax({
			  method: "POST",
			  url:"<?php echo base_url('Ajax/set_online_event'); ?>",
			  data: { id_participation: "<?php echo $inf_participation['id']?>",vimeo_id:options_current.vimeo_id,action:"start_session"}
			})
			 .done(function( msg ) {
				//alert('ended');
				console.log('event saved!');
			});
	
	
	
}
</script>
</body>

</html>