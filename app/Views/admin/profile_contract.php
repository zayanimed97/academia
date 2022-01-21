<?= view('admin/common/header',array('page_title'=>lang('app.title_page_profile_contract'))) ?>

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
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_contract')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile_contract')?></h4>
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
                                            <?php $tab=json_decode($inf_package['package'],true);
														if(!isset($tab['extra'])) $tab['extra']=array();?>
                                                <div class="row">
                                                       
                                                           <div class="col-12">
														   <div class="form-group row mb-3">
																<label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_expired_date')?> <span class="text-danger">*</span></label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="expired_date" id="expired_date" value="<?php echo date('d/m/Y',strtotime($inf_package['expired_date']))?>"  disabled>
																</div>
															</div>
														</div>
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_type_cours')?> <span class="text-danger">*</span></label>
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="aula" value="aula" <?php if(in_array('aula',$tab['type_cours'])) echo 'checked'?> disabled>
																			<label for="aula"> aula </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="online" value="online" disabled  <?php if(in_array('online',$tab['type_cours'])) echo 'checked'?>>
																			<label for="online"> online </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="type_cours[]" id="webinar" value="webinar" disabled  <?php if(in_array('webinar',$tab['type_cours'])) echo 'checked'?>>
																			<label for="webinar"> webinar </label>
																		</div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
															 <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"><?php echo lang('app.field_package_extra')?></label>
                                                                    <div class="col-md-9">
                                                                        <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="test" value="test" disabled <?php if(in_array('test',$tab['extra'])) echo 'checked'?>>
																			<label for="test"> <?php echo lang('app.field_test').' & '.lang('app.field_test_quality')?> </label>
																		</div>
																		
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="certificat" value="certificat" disabled <?php if(in_array('certificat',$tab['extra'])) echo 'checked'?>>
																			<label for="certificat"> <?php echo lang('app.field_attesto')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="coupon" value="coupon" disabled <?php if(in_array('coupon',$tab['extra'])) echo 'checked'?>>
																			<label for="coupon"> <?php echo lang('app.field_coupon')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="share" value="share" disabled <?php if(in_array('share',$tab['extra'])) echo 'checked'?>>
																			<label for="share"> <?php echo lang('app.field_share')?> </label>
																		</div>
																		 <div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="wallet" value="wallet" disabled <?php if(in_array('wallet',$tab['extra'])) echo 'checked'?>>
																			<label for="wallet"> <?php echo lang('app.field_wallet')?> </label>
																		</div>
																		<div class="checkbox form-check-inline">
																			<input type="checkbox" name="extra[]" id="fatturecloud" value="fatturecloud" disabled <?php if(in_array('fatturecloud',$tab['extra'])) echo 'checked'?>>
																			<label for="fatturecloud"> <?php echo lang('app.field_fatture_cloud')?> </label>
																		</div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                               </div> <!-- end row -->
                                                   
                                                
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
	console.log(fields);
	$.ajax({
				  url:"<?php echo base_url('ProfileController/update')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				
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
