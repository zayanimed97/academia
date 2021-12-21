<?= view('admin/common/header',array('page_title'=>lang('app.title_page_cours'))) ?>
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
											
											  <li class="breadcrumb-item active"><?php echo lang('app.menu_corsi')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_cours') ?></h4>
                                        <a href="<?php echo base_url('admin/corsi/add')?>" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_cours') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h5 class="mt-0"><?= lang('app.field_argomenti') ?></h5>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
														<th><?php echo lang('app.field_code')?></th>
                                                        <th><?php echo lang('app.field_title')?></th>
                                                        <th><?php echo lang('app.field_type_cours')?></th>
														<th>€</th>
														 <th><?php echo lang('app.field_nb_modulo')?></th>
														  <th><?php echo lang('app.field_time')?></th>
														  <th><?php echo lang('app.field_docente')?></th>
														  <th><?php echo lang('app.field_buy_type_2')?></th>
														  <th><?php echo lang('app.field_image')?></th>
														  <th><i class="mdi mdi-link mr-1"></i></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php 
													$type_cours=json_decode($settings['type_cours'] ?? '',true);
													foreach($list as $arg) { ?>
                                                    <tr>
                                                        <td><?= $arg['id'] ?></td>
														 <td><?= $arg['codice'] ?></td>
                                                        <td><?= $arg['sotto_titolo'] ?></td>
                                                        <td><?= $type_cours[$arg['tipologia_corsi']] ?? $arg['tipologia_corsi'];?>
														<?php if($arg['tipologia_corsi']=='aula'){
															if($arg['luoghi_label']!=""){?>
															<br/><b>(<?php echo $arg['luoghi_label']?>)</b>
															
														<?php } }?></td>
														  <td><?= $arg['price'] ?></td>
														    <td><?= $arg['nb_module'] ?></td>
															 <td><?= $arg['duration'] ?></td>
															  <td><?= $arg['docente'] ?></td>
															  <td><?php switch($arg['buy_type']){
																case 'cours':echo lang('app.field_buy_type_cours'); break; 
																case 'module':echo lang('app.field_buy_type_modulo'); break; 
																case 'date':echo lang('app.field_buy_type_date'); break; 
															  }?></td>
															 <td><?php if($arg['foto']!=""){?><img src="<?php echo base_url('uploads/corsi/'.$arg['foto'])?>" style="width:100%"><?php } ?></td>
															 <td><?php if($arg['ids_pdf']!="") echo count(explode(",",$arg['ids_pdf'])); else echo '0'?></td>
                                                        <td class="row pt-1">
                                                            <a href="<?php echo base_url('admin/corsi/edit/'.$arg['id'])?>" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </a>
															<a href="<?php echo base_url('admin/corsi/'.$arg['id'].'/modulo')?>" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-list"></i>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#delete-modal" onclick="get_del('<?php echo $arg['id']?>')" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>

                                                           
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
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.new_argomenti') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/newArgomenti" data-parsley-validate="">

                                <div class="form-group">
                                    <label for="username"><?= lang('app.field_argomenti_name') ?></label>
                                    <input class="form-control" type="text" id="username" name="name" required placeholder="<?= lang('app.field_argomenti_name') ?>">
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_add') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


           <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/corsi'), $attributes);?>
				  <input type="hidden" value="" id="deleteID" name="id">
				    <input type="hidden" value="delete" id="action" name="action">
            <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_delete_corsi') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                                <?php echo lang('app.msg_delete_corso')?>

                        </div>
						<div class="modal-footer">
							<a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></a>
							<?php $data=["name"=>"save",
												"value"=>lang('app.btn_delete'),
												'class' => 'btn btn-success'
									];
								
									echo form_submit($data,lang('app.btn_delete'));?>
							
						</div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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
    function get_del(id){
      
        $('#deleteID').val(id)
    }
</script>
<?= view('admin/common/endtag') ?>
