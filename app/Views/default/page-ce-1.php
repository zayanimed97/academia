<?= view($view_folder.'/common/header') ?>
	<div class="uk-sticky-placeholder" style="height: 72px; margin: 0px;"></div>
	<!--  breadcrumb -->
	<div class="uk-position-relative contents overflow-hidden lg:-mt-20" tabindex="-1">       

		<div class="lg:pt-28 container relative">
			<img src="https://academy.creazioneimpresa.it/uploads/banner/banner-academy-risorse-free-header.jpg" class="object-cover uk-cover" style="max-width: 100%; height: 382px; width: 1280px;" alt="" uk-cover="">
			<div class="container relative p-20 lg:mt-12 h-full uk-overlay"> 
				<div class="flex flex-col justify-center h-full w-full space-y-3">
					<h1 class="lg:text-4xl text-2xl text-black font-semibold"> Risorse Free </h1>
					<p class="text-base text-black font-medium pb-4 lg:w-1/2"> </p>
					<!--a href="" class="bg-opacity-90 bg-blue-600 py-2.5 rounded-md text-base text-black text-center w-32">Lista Corsi </a--> 
				</div>
			</div>
		</div>
     </div> 
     <div class="container">
		 <div class="pt-28 pb-20">
			 <h1 class="text-2xl font-semibold mb-5">  </h1>

                <div class="grid lg:grid-cols-4 grid-cols-2 gap-3 mb-5">
        
                    <a href="https://www.youtube.com/watch?v=EWCSFrrrtnQ&list=PL4SnrkTsBHJCziydUoAShDPdfFjH1MHei" class="col-span-2 row-span-2" target="_blank"> 
                        <div class="bg-gray-200 rounded-md overflow-hidden relative w-full lg:h-full h-60 shadow-sm">
                            <img src="<?= base_url('front') ?>/assets/images/pillole-di-costituzione.jpg" class="w-full h-full object-cover" alt="">  
                        </div>
                    </a>
                    
                    
                    <a href="https://www.youtube.com/watch?v=kU5IXRLmkvw&list=PL4SnrkTsBHJAyrRsk_jIlXhQYPN-f3T6f" class="col-span-2 row-span-2" target="_blank"> 
                        <div class="bg-gray-200 rounded-md overflow-hidden relative w-full lg:h-full h-60 shadow-sm">
                            <img src="<?= base_url('front') ?>/assets/images/caffe-del-mercoledi.jpg" class="w-full h-full object-cover" alt="">    
                        </div>
                    </a>
                </div>
            </div>
      </div>
<?= view($view_folder.'/common/footer') ?>
  
<?= view($view_folder.'/common/close') ?>

