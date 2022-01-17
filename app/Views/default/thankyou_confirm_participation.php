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
						<a href="#"><?php echo lang('front.title_page_thanks');?> </a>
					</li>
				</ul>
			</div>
			<div class="md:text-2xl text-base font-semibold mt-6 md:mb-6"> <?php echo lang('front.title_page_thanks');?></div>
		</div>
	</div>
     <div class="container pt-28 pb-20">

            <div class="max-w-6xl mt-lg-11 mx-auto lg:p-10 p-5 tube-card">
				
            
                <article class="space-y-2 uk-article">

    
                               <p>la tua partecipazione è confermata<br/></p>

                </article>
            

            </div>
 
        </div>
<?= view($view_folder.'/common/footer') ?>
  
<?= view($view_folder.'/common/close') ?>
