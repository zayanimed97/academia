<?= view('admin/common/header',array('page_title'=>lang('app.title_page_settings_cms'))) ?>
  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_setting_cms')?></li>
                                          
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_settings_cms')?>
									<a href="<?php echo base_url('admin/settings/cms/add')?>" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_page') ?>
                                        </a>
									</h4>
									 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                       
							 <?php 
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
										
										
                                         <table id="scroll-horizontal-datatable" class="table w-100 nowrap" >
                                            <thead>
                                                <tr>
                                                   
                                                 
															
															<th data-sorting="disabled"></th>
															<th><?php echo lang('app.field_type')?></th>
															<th><?php echo lang('app.field_menu')?></th>
															<th><?php echo lang('app.field_title')?></th>
															<th><?php echo lang('app.field_seo_title')?></th>
															<th><?php echo lang('app.field_seo_description')?></th>
															<th><?php echo lang('app.field_sort')?></th>
															<th><?php echo lang('app.field_active_status')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php foreach($list as $k=>$one_customer){?>
													<tr class="odd gradeX">
														
														 <td>
														
														<a href="<?php echo base_url('admin/settings/cms/edit/'.$one_customer['id'])?>" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </a>
														<?php if( $one_customer['type']=='dynamic'){ ?>
														 <a data-toggle="modal" data-target="#delete-modal-dialog" onclick="del_data('<?php echo $one_customer['id']?>')" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>

														<?php } ?>
														</td>
														<td><?php if( $one_customer['type']=='static') echo lang('app.field_static'); else echo lang('app.field_dynamic');?></td>
														<td><?php echo $one_customer['menu_title']?></td>
														<td><?php echo $one_customer['title']?></td>
														<td><?php echo $one_customer['seo_title']?></td>
														<td><?php echo $one_customer['seo_description']?></td>
														<td><?php echo $one_customer['ord']?></td>
														<td><?php if( $one_customer['enable']=='yes') echo lang('app.yes'); else echo lang('app.no');?></td>  
													   
													</tr>
												<?php } ?>
                                                
                                            </tbody>
										</table>
                                        <!-- end row-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
						 <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
										<h3><?php echo lang('app.title_section_copyrigh')?></h3>
										 <form method="post" action="<?= base_url('admin/settings/cms/') ?>"  id='add_ente_form'>
											<input type="hidden" name="action" value="copyright">
											<div class="row">
												
												<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_copyright')?> <span class="text-danger">*</span></label>
														 <?php $val=$settings['copyright'] ?? ''; 
													$input = [
															'type'  => 'text',
															'name'  => 'copyright',
															'id'    => 'copyright',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_title'),
															'class' => 'form-control'
															
													];

													echo form_textarea($input);
													?>
														</div>
													</div>
											</div>
											    <button type="submit" name="submit" class="btn btn-secondary" ><?php echo lang('app.btn_save')?></button>
										 </form>
									</div>
								</div>
							</div>
							
							<div class="col-6">
                                <div class="card">
                                    <div class="card-body">
										<h3><?php echo lang('app.title_section_cours_type')?></h3>
										 <form method="post" action="<?= base_url('admin/settings/cms/') ?>"  id='add_ente_form'>
											<input type="hidden" name="action" value="cours_type">
											<div class="row">
												
												<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname">Aula <span class="text-danger">*</span></label>
														 <?php 
														 $det=json_decode($settings['type_cours'] ?? "",true);
														 $val=$det['aula'] ?? 'Aula'; 
													$input = [
															'type'  => 'text',
															'name'  => 'aula',
															'id'    => 'aula',
															'required'=>true,
															'value' => $val,
															
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													
													<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname">Webinar <span class="text-danger">*</span></label>
														 <?php 
														 $det=json_decode($settings['type_cours'] ?? "",true);
														 $val=$det['webinar'] ?? 'Webinar'; 
													$input = [
															'type'  => 'text',
															'name'  => 'webinar',
															'id'    => 'webinar',
															'required'=>true,
															'value' => $val,
															
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													
													<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname">Online <span class="text-danger">*</span></label>
														 <?php 
														 $det=json_decode($settings['type_cours'] ?? "",true);
														 $val=$det['online'] ?? 'Online'; 
													$input = [
															'type'  => 'text',
															'name'  => 'online',
															'id'    => 'online',
															'required'=>true,
															'value' => $val,
															
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
											</div>
											    <button type="submit" name="submit" class="btn btn-secondary" ><?php echo lang('app.btn_save')?></button>
										 </form>
									</div>
								</div>
							</div>
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
		<?php $attributes = ['class' => 'form-input-flat', 'id' => 'myform','method'=>'post'];
		echo form_open('', $attributes);?>
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id_to_delete" id="id_to_delete">
		
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_page')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_page')?>
						  </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo lang('app.btn_delete')?></button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><?php echo lang('app.btn_close')?></button>
                            </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
		
		
		
		
           <?php echo form_close();?>	
		
		
      <?= view('admin/common/footer') ?>
   
    
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
		
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		  <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
		  <!-- third party js -->
       
		 
        <!-- App js -->
		 <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
		 <script>
	 !function(n){
		 "use strict";function e(){this.$body=n("body")}
		 e.prototype.init=function(){
			 n("#copyright").summernote({lang: 'it-IT',placeholder:"Write something...",height:230,callbacks:{onInit:function(e){n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")}}})
			  }
			 ,n.Summernote=new e,n.Summernote.Constructor=e}
			 (window.jQuery),function(){"use strict";window.jQuery.Summernote.init()}();
	 </script>
        <script>
	
		$(document).ready(function(){
			$("#scroll-horizontal-datatable").DataTable({scrollX:!0,
			language:{
					url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json',
				paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"},
			
			},
				drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}
			});
			$("#nascita_data").flatpickr({
				"altInput":true,
				"altFormat":"j F, Y",
				"dateFormat":"Y-m-d",
				"locale": "it"
			});
		});
		function del_data(id){
			$("#id_to_delete").val(id);
		}
		  function list_booking(id){
		 $("#booking_form_item_id").val(id);
		 $("#booking_form").submit();
	 }
		</script>
   <?= view('admin/common/endtag') ?>