<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_pdflib'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
											<li class="breadcrumb-item "><?php echo lang('app.menu_config_corsi')?></li>
											<li class="breadcrumb-item active"><?php echo lang('app.menu_pdflib')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.dashboard_pdflib') ?></h4>
                                        <button type="button" data-toggle="modal" data-target="#new-category-modal" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_pdf') ?>
                                        </button>
                                    </div>
                                </div>
								<div><p>Qui gestisci tutti i contenuti PDF che utilizzi nella piattaforma.</p></div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<?php if(isset($success)){?>
                                       	<div class="alert alert-success" role="alert" id="error_alert" ><?php echo $success?></div>  
										<?php } ?>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?php echo lang('app.field_doc_title')?></th>
                                                        <th><?php echo lang('app.field_access')?></th>
                                                        <th><?php echo lang('app.field_active_status')?></th>
														 <th><?php echo lang('app.field_featured')?></th>
														
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($categories as $cat) { ?>
                                                    <tr>
                                                        <td><?= $cat['id'] ?></td>
                                                        <td><?= $cat['pdfname'] ?></td>
                                                       <td><?php if($cat['accesso']=='private') echo lang('app.field_access_private'); else echo lang('app.field_access_public'); ?></td>
                                                        <td><?php if($cat['enable']=='yes') echo lang('app.yes'); else echo lang('app.no'); ?></td>
														<td><?php if($cat['featured']=='yes') echo lang('app.yes'); else echo lang('app.no'); ?></td>
                                                        <td class="row pt-1">
														<a target="_blank" href="<?= base_url('user/getFile/'.$cat['id']) ?>" class="btn p-1 mr-2" style="font-size: 1rem"><i class="fa fa-download"></i></a>
                                                            <button type="button" data-toggle="modal" data-target="#update-category-modal" onclick="updateID(<?= $cat['id'] ?>, '<?= $cat['pdfname'] ?>','<?= $cat['enable'] ?>','<?= $cat['accesso'] ?>','<?= $cat['featured'] ?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </button>
															<a href="#delete-modal-dialog"  class="p-1" style="height: fit-content; font-size: 1rem; color: red" data-toggle="modal" onclick="del_data('<?php echo $cat['id']?>')"><i class="fe-x-circle"></i></a>	
															
                                                           
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div> <!-- end .table-responsive-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
               <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- add new modal content -->
            <div id="new-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.new_pdf') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/newpdflib" enctype="multipart/form-data" data-parsley-validate="">

                               <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_doc_title')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'pdfname',
									'id'    => 'pdfname',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_doc_title'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 
						
							<label class="col-form-label " for="filename"><?php echo lang("app.field_doc")?> </label>
							<div class="col-sm-12">
								<input class="form-control" type="file" id="filename" name="filename"  />
							</div>
							<div class="row col-md-12">
							 <div class="form-check form-check-inline">
											<?php 
											$chk=true;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'accesso_public',
											'value'   =>'public',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_public")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'accesso_private',
											'value'   =>'private',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_private")?></label>
											</div>
							</div>
						<div class="row  col-md-12">
						 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "status",
											'id'      => 'pdf_status',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="pdf_status"><?php echo lang("app.field_active_status")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "featured",
											'id'      => 'featured',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox11"><?php echo lang("app.field_featured")?></label>
											</div>
											
								</div>
					
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_add') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- update category modal content -->
            <div id="update-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.update_category') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/updatepdflib" enctype="multipart/form-data" data-parsley-validate="">
                                <input type="hidden" value="" id="updateId" name="catId">
                                       <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_doc_title')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'pdfname',
									'id'    => 'update_pdfname',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_doc_title'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 
						
							<label class="col-form-label " for="filename"><?php echo lang("app.field_doc")?> </label>
							<div class="col-sm-12">
								<input class="form-control" type="file" id="filename" name="filename"  />
							</div>
							<div class="row col-md-12">
							 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'update_accesso_public',
											'value'   =>'public',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_public")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "accesso",
											'id'      => 'update_accesso_private',
											'value'   =>'private',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_radio($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_access_private")?></label>
											</div>
							</div>
						<div class="row  col-md-12">
						 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "status",
											'id'      => 'update_pdf_status',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="pdf_status"><?php echo lang("app.field_active_status")?></label>
											</div>
											 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "featured",
											'id'      => 'update_featured',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox11"><?php echo lang("app.field_featured")?></label>
											</div>
											
								</div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_save') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

<?php $attributes = ['class' => 'form-input-flat', 'id' => 'deleteform','method'=>'post'];
		echo form_open("", $attributes);?>
		
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_pdf')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_row')?>
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

<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>

<script>
    function updateID(id, name,status,acesso,featured){
        $('#update_pdfname').val(name);
		if(status=='yes') var checked=true; else var checked=false;
		$('#update_pdf_status').attr('checked',checked);
		
		if(acesso=='public') $('#update_accesso_public').attr('checked',true); else $('#update_accesso_private').attr('checked',true); 
		
		
		if(featured=='yes') var checked=true; else var checked=false;
		$('#update_featured').attr('checked',checked);
        $('#updateId').val(id);
    }
	function del_data(id){
			$("#deleteform").attr('action',"<?= base_url() ?>/admin/deletepdflib/"+id);
		}
</script>
<?= view('admin/common/endtag') ?>
