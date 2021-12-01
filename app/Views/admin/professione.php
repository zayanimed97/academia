<?= view('admin/common/header',array('page_title'=>lang('app.dashboard_professione'))) ?>
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
											<li class="breadcrumb-item active"><?php echo lang('app.menu_professione')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.dashboard_professione') ?></h4>
                                        <button type="button" data-toggle="modal" data-target="#new-professione-modal" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_professione') ?>
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
        
                                        <h5 class="mt-0"><?= lang('app.field_professione') ?></h5>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                       <th><?php echo lang('app.field_title')?></th>
                                                        <th><?php echo lang('app.field_code')?></th>
                                                        <th><?php echo lang('app.field_active_status')?></th>
														 <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($professione as $prof) { ?>
                                                    <tr>
                                                        <td><?= $prof['idprof'] ?></td>
                                                        <td><?= $prof['professione'] ?></td>
                                                        <td><?= $prof['codice'] ?></td>
														 <td><?php if($prof['status']=='enable') echo lang('app.yes'); else echo lang('app.no'); ?></td>
                                                        <td class="row pt-1">
                                                            <button type="button" data-toggle="modal" data-target="#update-professione-modal" onclick="updateID(<?= $prof['idprof'] ?>, '<?= $prof['professione'] ?>', '<?= $prof['codice'] ?>', '<?= $prof['status'] ?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </button>

                                                            <a href="<?= base_url() ?>/admin/deleteProfessione/<?= $prof['idprof'] ?>" class="p-1 mr-2" style="height: fit-content; font-size: 1rem; color: red">
                                                                <i class="fe-x-circle"></i>
                                                            </a>

                                                            <a href="<?= base_url() ?>/admin/discipline/<?= $prof['idprof'] ?>" class="p-1" style="height: fit-content; font-size: 1rem">
                                                                <i class="fe-arrow-right"></i>
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
            <div id="new-professione-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.new_professione') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/newProfessione" data-parsley-validate="">

                                <div class="form-group">
                                    <label for="username"><?= lang('app.field_title') ?></label>
                                    <input class="form-control" type="text" id="username" name="name" required placeholder="<?= lang('app.field_title') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="codice"><?= lang('app.field_code') ?></label>
                                    <input class="form-control" type="text" id="codice" name="codice" required placeholder="<?= lang('app.field_code') ?>">
                                </div>
								<div class="form-group">
								  <div class="checkbox form-check-inline">
										<input type="checkbox" name="enable" id="enable" value="yes" checked>
										<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
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


            <!-- update professione modal content -->
            <div id="update-professione-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.update_professione') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" method="post" action="<?= base_url() ?>/admin/updateProfessione" data-parsley-validate="">
                                <input type="hidden" value="" id="updateId" name="catId">
                                <div class="form-group">
                                    <label for="updatename"><?= lang('app.field_title') ?></label>
                                    <input class="form-control" type="text" id="updatename" name="name" required placeholder="<?= lang('app.field_title') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="updatecodice"><?= lang('app.field_code') ?></label>
                                    <input class="form-control" type="text" id="updatecodice" name="codice" required placeholder="<?= lang('app.field_code') ?>">
                                </div>
<div class="form-group">
								  <div class="checkbox form-check-inline">
										<input type="checkbox" name="enable" id="updateenable" value="yes" checked>
										<label for="enable"> <?php echo lang('app.field_active_status')?> </label>
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
    function updateID(id, name, codice,status){
        $('#updatename').val(name);
        $('#updatecodice').val(codice);
		if(status=='enable') var checked=true; else var checked=false;
		$('#updateenable').attr('checked',checked);
        $('#updateId').val(id);
    }
</script>
<?= view('admin/common/endtag') ?>
