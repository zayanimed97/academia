<?= view($view_folder.'/common/header') ?>
  
     <div class="container p-0">

            <div class="lg:flex lg:space-x-4 lg:-mx-4">
            
                <div class="lg:w-9/12 lg:space-y-6">
                    
                    <div class="tube-card">

                       

                        <div class="md:p-6 p-4">

                            <h1 class="lg:text-2xl text-xl font-semibold mb-6"> <?php echo $inf_page['title']?> </h1>
    
                            
                            <div class="space-y-3">
                                <?php echo $inf_page['content']?>
                            </div>

                        </div>

                    </div>



                </div>
            

            </div>
 
        </div>
<?= view($view_folder.'/common/footer') ?>
  
<?= view($view_folder.'/common/close') ?>
