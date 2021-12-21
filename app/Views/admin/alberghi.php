<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_alberghi'))) ?>
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
											<li class="breadcrumb-item active"><?php echo lang('app.menu_alberghi')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.dashboard_alberghi') ?></h4>
                                        <button type="button" data-toggle="modal" data-target="#new-argomenti-modal" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_alberghi') ?>
                                        </button>
                                    </div>
                                </div>
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
                                    <?php if(isset($error)){?>
                                       	<div class="alert alert-danger" role="alert" id="error_alert" ><?php echo $error?></div>  
										<?php } ?>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        
														<th><?php echo lang('app.field_image')?></th>
														<th><?php echo lang('app.field_luoghi')?></th>
														<th><?php echo lang('app.field_title')?></th>
														<th><?php echo lang('app.field_city')?></th>
														<th><?php echo lang('app.field_provincia')?></th>
														<th><?php echo lang('app.field_phone')?></th>
														<th><?php echo lang('app.field_active_status')?></th>
														<th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($list as $one_customer) { ?>
                                                    <tr>
                                                        
                                                       <td><?php if($one_customer['foto']!=""){?><img src="<?php echo base_url('uploads/alberghi/'.$one_customer['foto'])?>" style="width:100px"><?php }?></td>
														<td><?php echo $one_customer['luoghi']?></td>
														<td><?php echo $one_customer['nome']?></td>
														<td><?php echo $one_customer['citta']?></td>
														<td><?php echo $one_customer['provincia']?></td>
														<td><?php echo $one_customer['telefono']?></td>
														<td><?php if($one_customer['pubblica']=="1") echo lang('app.yes'); else echo lang('app.no');?></td>
                                                        <td class="row pt-1">
                                                            <button type="button" data-toggle="modal" data-target="#update-argomenti-modal" onclick="updateID(<?= $one_customer['id'] ?>)" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </button>
															<a href="#delete-modal-dialog"  class="p-1" style="height: fit-content; font-size: 1rem; color: red" data-toggle="modal" onclick="del_data('<?php echo $one_customer['id']?>')"><i class="fe-x-circle"></i></a>	

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
            <div id="new-argomenti-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.new_alberghi') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
						
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/alberghi" data-parsley-validate="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="add">
                               <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_first_name')?></label>
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'nome',
									'id'    => 'nome',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_first_name'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_luoghi')?></label>
							
                               <div class="form-group">
								<select class="form-control" name="idluogo" id="idluogo">
									<option value=""><?php echo  lang('app.field_select') ?></option>
									<?php foreach($list_luoghi as $k=>$v){?>
										<option value="<?php echo $v['id']?>"><?php echo  $v['nome'] ?></option>
									<?php }?>
								</select>
							</div>               
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_address')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'indirizzo',
									'id'    => 'indirizzo',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_address'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_city')?></label>
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'citta',
									'id'    => 'citta',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_city'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_provincia')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'provincia',
									'id'    => 'provincia',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_provincia'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_zip')?></label>
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'cap',
									'id'    => 'cap',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_zip'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_phone')?></label>
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'telefono',
									'id'    => 'telefono',
									
									'value' => $val,
									'placeholder' =>lang('app.field_phone'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_email')?></label>
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'email',
									'id'    => 'email',
									
									'value' => $val,
									'placeholder' =>lang('app.field_email'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_publica_sitoweb')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'sito',
									'id'    => 'sito',
									
									'value' => $val,
									'placeholder' =>lang('app.field_publica_sitoweb'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_testo')?></label>
							<?php $val="";
							$input = [
									
									'name'  => 'testo',
									'id'    => 'testo',
									
									'value' => $val,
									'placeholder' =>lang('app.field_testo'),
									'class' => 'form-control'
									
							];

							echo form_textarea($input);
							?>
                                              
                         </div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_gmap')?></label>
							<?php $val=""; 
							$input = [
									
									'name'  => 'gmap',
									'id'    => 'gmap',
								
									'value' => $val,
									'placeholder' =>lang('app.field_gmap'),
									'class' => 'form-control'
									
							];

							echo form_textarea($input);
							?>
                                              
                         </div>
							<label class="col-form-label " for="foto"><?php echo lang("app.field_image")?> </label>
							<div class="col-sm-12">
								<input class="form-control" type="file" id="foto" name="foto"  />
							</div>
						 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "visibile",
											'id'      => 'visibile',
											'value'   =>'1',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_active_status")?></label>
											</div>
						<div class="form-check form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "def_sede",
											'id'      => 'def_sede',
											'value'   =>'1',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_def_sede")?></label>
											</div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_add') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- update argomenti modal content -->
            <div id="update-argomenti-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.update_alberghi') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/alberghi" data-parsley-validate="" enctype="multipart/form-data">
							<input type="hidden" name="action" value="edit">
                                <input type="hidden" value="" id="updateId" name="id">
                               <div id="div_edit">
							   
							   </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_add') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
<?php $attributes = ['class' => 'form-input-flat', 'id' => 'deleteform','method'=>'post'];
		echo form_open("", $attributes);?>
			<input type="hidden" name="action" value="delete">
            <input type="hidden" value="" id="deleteId" name="id">
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_alberghi')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_alberghi')?>
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
    function updateID(id, name,status){
		 $('#updateId').val(id);
        $.ajax({  
				url:"<?php echo base_url('admin/alberghi/get_data'); ?>",
				type: 'post',
				
				data:{id:id},
				success:function(data){ 
					$("#div_edit").html(data);
					$('#edit_testo').summernote({
	   disableDragAndDrop: true,
	    lang: "it-IT",
		 height: 200,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true,
	   toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
  });
				}  
			});

       
    }
	function del_data(id){
		
		 $('#deleteId').val(id);
		
		}
</script>
<?= view('admin/common/endtag') ?>
