<?= view('admin/common/header',array('page_title'=>lang('app.title_page_profile_contact'))) ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
                                            <li class="breadcrumb-item"><?php echo lang('app.menu_profile_setting')?></li>
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_contact')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile_contact')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row" x-data="{ private: '<?= (($user['type'] ?? "") == "private") ? 'private' : 'company' ?>'}">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                     	<div class="alert alert-danger" role="alert" id="error_alert" style="display:none"></div>   

                                        <form method="post" action="<?= base_url('admin/profile/'. $profile_menu) ?>"  id='add_ente_form'>
										<input type="hidden" name="profile_menu" value="<?php echo $profile_menu?>">
                                            
                                                          <div class="row" >
                                                            <div class="col-12 col-md-6 repeater-email">
                                                                <div data-repeater-list="mail">
                                                                <?php  if($contact_email!=""){
																	foreach(json_decode($contact_email,true ) as $email) { ?>
                                                                    <div class="form-group row mb-3" data-repeater-item>
																	  <div class="col-md-5">
                                                                        <label class="col-12 col-form-label" for="email_contact"> <?php echo lang('app.field_email')?></label>

                                                                         <input type="text" name="email_contact" class="form-control" value="<?= $email['email_contact'] ?>">
                                                                       
																	</div>
																		 <div class="col-md-5">
                                                                         <label class="col-12 col-form-label" for="email_label"> <?php echo lang('app.field_label')?></label>
                                                                            <input type="text" name="email_label" class="form-control" value="<?= $email['email_label'] ?>">
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center mt-4">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                <?php echo lang('app.btn_delete')?>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                <?php } }
																else{?>
                                                                     <div class="form-group row mb-3" data-repeater-item>
																	   <div class="col-md-5">
                                                                        <label class="col-12 col-form-label" for="email_contact"> <?php echo lang('app.field_email')?></label>
                                                                      
                                                                            <input type="text" name="email_contact" class="form-control">
																		</div>
                                                                     <div class="col-md-5">
                                                                         <label class="col-12 col-form-label" for="email_label"> <?php echo lang('app.field_label')?></label>
                                                                         <input type="text" name="email_label" class="form-control">
																	</div>
																	 <div class="col-md-2 col-sm-12 form-group d-flex align-items-center mt-4">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                <?php echo lang('app.btn_delete')?>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-primary" data-repeater-create type="button">
                                                                              <?php echo lang('app.btn_add')?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 repeater-phone">
                                                                <div  data-repeater-list="phone">
                                                                <?php 
																if($contact_telephone!=""){
																	//var_dump($contact_telephone);
																foreach(json_decode($contact_telephone,true ) as $phone) { ?>

                                                                    <div class="form-group row mb-3" data-repeater-item>
																	 <div class="col-md-5">
                                                                        <label class="col-12 col-form-label" for="phone_contact"> <?php echo lang('app.field_phone')?> </label>
                                                                       
                                                                        
                                                                            <input type="text"  name="phone_contact" class="form-control" value="<?= $phone['phone_contact'] ?>">
                                                                        </div>
																		 <div class="col-md-5">
																		  <label class="col-12 col-form-label" for="email_label"> <?php echo lang('app.field_label')?></label>
                                                                         <input type="text" name="phone_label" class="form-control" value="<?= $phone['phone_label'] ?>">
																		 </div>
                                                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center mt-4">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                  <?php echo lang('app.btn_delete')?>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                <?php } }
																else{?>
                                                                          <div class="form-group row mb-3" data-repeater-item>
																		  <div class="col-md-5">
                                                                        <label class="col-12 col-form-label" for="phone_contact"> <?php echo lang('app.field_phone')?> </label>
                                                                     
                                                                            <input type="text"  name="phone_contact" class="form-control" >
                                                                        </div>
																		 <div class="col-md-5">
																		  <label class="col-12 col-form-label" for="email_label"> <?php echo lang('app.field_label')?></label>
                                                                         <input type="text" name="phone_label" class="form-control">
																		 </div>
                                                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center mt-4">
                                                                            <button class="btn btn-danger" data-repeater-delete type="button">
                                                                                  <?php echo lang('app.btn_delete')?>
                                                                            </button>
                                                                        </div>
                                                                    </div>
																<?php } ?>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-primary" data-repeater-create type="button">
                                                                              <?php echo lang('app.btn_add')?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                        </div>
                                                   
                                                
                                                  
                                                            <button type="button" name="submit" class="btn btn-secondary" onclick="save_ente();"><?php echo lang('app.btn_save')?></button>
                                                      

                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                        </div> 
                        <!-- end row -->

                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                  <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- Center modal content -->
            <div class="modal fade" id="loading" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered justify-content-center">
                    <div class="modal-content" style="width: auto; background: transparent">
                        <div class="spinner-border avatar-lg text-primary m-2" role="status"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

	<div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-success">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-checkmark h1 text-white"></i>
                                                            <h4 class="mt-2 text-white"><?php echo lang('app.success_add')?></h4>
                                                           
																<a href="#" class="btn btn-light my-2 "  data-dismiss="modal" aria-hidden="true"><?php echo lang('app.btn_continue')?></a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
<?= view('admin/common/footer') ?>

        <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>
        
        <!-- Plugins js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>

        <!-- Init js-->
        <script>
            // form repeater Initialization
            $('.repeater-email').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });

            $('.repeater-phone').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
            });

            function handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.provincia = res)
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">'
                }
            }

            function handleCountryFattura(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=fattura_provincia&selected=<?= $user['fattura_provincia'] ?>`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => this.fattura_provincia = res)
                }
                else {
                    this.fattura_provincia = '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">'
                    this.fattura_comuni = '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">'
                }
            }

            function getResData(){
                return {
                    stato: '<?= $user['residenza_stato'] ?>', 
                    comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control">', 
                    provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control">',

                    fattura_stato: '<?= $user['fattura_stato'] ?>', 
                    fattura_comuni: '<input type="text" id="fattura_comune" name="fattura_comune" class="form-control">', 
                    fattura_provincia : '<input type="text" id="fattura_provincia" name="fattura_provincia" class="form-control">',
                    init(){
                        Promise.allSettled([
                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; resolve()})
                            } return resolve();}),


                            new Promise((resolve, reject) => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; resolve()})
                            } return resolve();}),

                            
                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106') {
                                // $('#loading').modal('show');

                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['fattura_provincia'] ?>&name=fattura_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_provincia = res; resolve()})
                            } return resolve();}),

                            new Promise((resolve, reject) => {if ('<?= $user['fattura_stato'] ?>' == '106' && '<?= $user['fattura_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['fattura_provincia'] ?>&selected=<?= $user['fattura_comune'] ?>&name=fattura_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.fattura_comuni = res; resolve()})
                            } return resolve();})
                        ])
                        
                        .then(() => {
                            // $('#loading').modal('hide');
                            console.log('complete');
                        })
                    }
                }
                }
				
function save_ente(){
	var fields = $( "#add_ente_form" ).serializeArray();
	
	$.ajax({
				  url:"<?php echo base_url('ProfileController/update')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
			//	console.log(data);
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#error_alert").html(obj.validation);
					$("#error_alert").show('slow');
				
				}
				else{
					$("#error_alert").hide('slow');
					$( "#success-alert-modal" ).modal('show');
				//	return true;
				}
			});
}

        </script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-wizard.init.js"></script>

<?= view('admin/common/endtag') ?>
