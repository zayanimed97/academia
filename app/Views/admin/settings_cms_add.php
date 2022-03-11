<?= view('admin/common/header',array('page_title'=>lang('app.title_page_settings_cms_add'))) ?>
	  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
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
                                              <li class="breadcrumb-item"><?php echo lang('app.menu_settings')?></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/settings/cms')?>"><?php echo lang('app.menu_setting_cms')?></a></li>
											<li class="breadcrumb-item active"><?php echo lang('app.new_page')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_settings_cms_add')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                        <?php //echo $validation->listErrors()
										 if(isset($validation)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $validation->listErrors()?>
											</div>
										 <?php }?>
							 <?php //echo $validation->listErrors()
							 
										 if(isset($error)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $error?>
											</div>
										 <?php }?>
										  <?php //echo $validation->listErrors()
										 if(isset($success)){?>
										 <div class="alert alert-success m-b-20" role="alert">
											 <?php echo $success?>
											</div>
										 <?php }?>
										<?php $attributes = ['class' => 'form-input-flat', 'id' => 'aaaa','method'=>'post'];
										echo form_open_multipart( base_url().'/admin/settings/cms', $attributes);
										
										?>
										<input type="hidden" name="action" value="add">
										
                                        <div class="row">
										
											<div class="col-lg-12">
											
												
												
												<div class="row">
												
												<div class="col-md-6">
														<div class="form-group required-field">
															<label for="acc-mname">Nome della pagina <span class="text-danger">*</span></label>
														 <?php $val=""; 
													$input = [
															'type'  => 'text',
															'name'  => 'title',
															'id'    => 'title',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_title'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_menu')?> <span class="text-danger">*</span></label>
														 <?php $val=""; 
													$input = [
															'type'  => 'text',
															'name'  => 'menu_title',
															'id'    => 'menu_title',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_menu'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_sort')?> <span class="text-danger">*</span></label>
														 <?php $val="1"; 
													$input = [
															'type'  => 'number',
															'min'=>1,
															'step'=>1,
															'name'  => 'ord',
															'id'    => 'ord',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_sort'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_menu_position')?> <span class="text-danger">*</span></label>
														  <?php $input = [
												
																		'name'  => 'menu_position',
																		'id'    => 'menu_position',
																		'placeholder' =>lang('app.field_menu_position'),
																		'class' => 'form-control ',
																		'data-toggle'=>"select2"
																];
																$options=array();
																
																$options['header']=lang('app.menu_position_header');
																$options['footer']=lang('app.menu_position_footer');
																
																echo form_dropdown($input, $options,'header');
																?>
														</div>
													</div>
													<div class="col-md-3">
														<div class="checkbox form-check-inline">
															<input type="checkbox" name="is_externel" id="is_externel" value="yes" onclick="is_ext();">
															<label for="is_externel"> <?php echo lang('app.field_is_externel')?> </label>
														</div>
													</div>
													<div class="col-md-6" id="div_url" style="display:none">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_url')?> <span class="text-danger">*</span></label>
														 <?php $val=""; 
													$input = [
															'type'  => 'text',
															'name'  => 'url',
															'id'    => 'url',
														
															'value' => $val,
															'placeholder' =>lang('app.field_url'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
														</div>		
									<div class="row">
													<div class="col-md-6">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_seo_title')?> </label>
														 <?php $val=""; 
													$input = [
															'type'  => 'text',
															'name'  => 'seo_title',
															'id'    => 'seo_title',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_seo_title'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													<div class="col-md-6" >
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_seo_description')?></label>
														 <?php $val=""; 
													$input = [
															
															'name'  => 'seo_description',
															'id'    => 'seo_description',
															'rows'=>3,
															'value' => $val,
															'placeholder' =>lang('app.field_seo_description'),
															'class' => 'form-control'
															
													];

													echo form_textarea($input);
													?>
														</div>
													</div>
										</div>
												

											<div class="row" id="div_headerImage">
												<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname">Immagine copertina (dimensione consigliata: 1920x380px)</label>
														 <?php $val=""; 
													$input = [
															'type'  => 'file',
															'name'  => 'headerImage',
															'id'    => 'headerImage',
															
														
															'placeholder' =>lang('app.field_image'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
											</div>
											<div class="row mt-2" id="div_content">
												<div class="col-md-12">
													<div class="form-group">
														<label for="acc-mname"><?php echo lang('app.field_content')?> <span class="text-danger">*</span></label>
																 <?php $val=""; 
															$input = [

																	'name'  => 'html',
																	'id'    => 'summernote-basic',

																	'value' => $val,
																	'placeholder' =>lang('app.field_content'),
																	'class' => 'form-control'

															];

															echo form_textarea($input);
															?>
													</div>
												</div>
											</div>
											<div class="row mt-4" id="div_image">
												<div class="col-md-12">
													<h4 class="header-title">Facebook</h4>
													<div class="form-group required-field">
														<label for="acc-mname">Aggiungi un'<?php echo lang('app.field_image')?> (1200x628px) che permette la condivizione della homepage su Facebook</label>
														 <?php $val=""; 
													$input = [
															'type'  => 'file',
															'name'  => 'image',
															'id'    => 'image',
															
														
															'placeholder' =>lang('app.field_image'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
													</div>
												</div>
											</div>


									
												<div class="checkbox form-check-inline">
													<input type="checkbox" name="enable" id="enable" value="yes" checked>
													<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
												</div>
										

							
												<input type="submit" name="submit" value="<?php echo lang('app.btn_save')?>"  class="btn btn-success width-xs">
												
					
											</div>
											
                                        </div>
										  <?php echo form_close();?>		
                                        <!-- end row-->
									
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

<?= view('admin/common/footer') ?>

        <!-- Vendor js -->
      
        <!-- App js -->
	<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
      
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
		
       
     <script>
	 !function(n){
		 "use strict";function e(){this.$body=n("body")}
		 e.prototype.init=function(){
			 n("#summernote-basic").summernote({lang: 'it-IT',placeholder:"Write something...",height:230,callbacks:{onInit:function(e){n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")}}})
			  }
			 ,n.Summernote=new e,n.Summernote.Constructor=e}
			 (window.jQuery),function(){"use strict";window.jQuery.Summernote.init()}();
	function is_ext(){
		var x=$("#is_externel").is(':checked');
		if(x==true){ $("#div_url").show(0); $("#div_content").hide(0); $("#div_image").hide(0); $("#div_headerImage").hide(0);}
		else{ $("#div_url").hide(0); $("#div_content").show(0); $("#div_image").show(0); $("#div_headerImage").show(0);}
	}
	 </script>
		
     <?= view('admin/common/endtag') ?>