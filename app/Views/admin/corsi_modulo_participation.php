<?= view('admin/common/header',array('page_title'=>lang('app.title_page_participation'))) ?>
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
											 <li class="breadcrumb-item"><a href="<?php echo base_url('admin/corsi')?>"><?php echo lang('app.menu_corsi')?></a></li>
											  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/modulo')?>"><?php echo lang('app.menu_corsi_modulo')?></a></li>
											 <li class="breadcrumb-item active"><?php echo lang('app.menu_participation')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_participation') ?></h4>
										
                                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						<div class="row">
							<div class="alert alert-primary col-12" role="alert">
  <h4 class="alert-heading"><?php echo $inf_modulo['titolo']?></h4>
  <p> 
	<ul>
		<li><b><?php echo lang('app.field_subtitle')?>: </b><?php echo $inf_modulo['sotto_titolo']?></li>
		<li><b><?php echo lang('app.field_type_cours')?>: </b><?php echo $inf_corsi['tipologia_corsi']?></li>
		<!--li><b><?php echo lang('app.field_type_formation')?>: </b><?php echo $inf_corsi['tipologia_formazione']?></li-->
		<li><b><?php echo lang('app.field_doctors')?>: </b><?php echo $inf_doctor?></li>
		<?php if($inf_modulo['free']=='yes'){?><li><b><?php echo lang('app.field_free_cours')?>: </b><?php echo lang('app.yes')?></li>
		<?php } else{?>
		<li><b><?php echo lang('app.field_buy_type')?>: </b><?php if($inf_corsi['buy_type']=='cours') echo lang('app.field_buy_type_cours'); elseif($inf_corsi['buy_type']=='module')  echo lang('app.field_buy_type_modulo'); else echo lang('app.field_buy_type_date');?></li>
		<?php } ?>
	</ul>
  </p>
  
</div>
						</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                     
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
														<th><?php echo lang('app.field_last_name')?></th>	
														<th><?php echo lang('app.field_first_name')?></th>	  
														 <th><?php echo lang('app.field_credentiel')?></th>
														<th><?php echo lang('app.field_cart')?></th>		
														<th><?php echo lang('app.field_date_inscrit')?></th>														
                                                       <?php if($inf_corsi['buy_type']=='date'){?>
													   <th><?php echo lang('app.field_date_session')?></th>	
													   <?php } ?>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($list as $k=>$arg) { ?>
                                                    <tr>
														  <td><?= ($k+1) ?></td>
                                                        <td><?= $arg['participante'] ?></td>
                                                        <td><?= $arg['participant_cognome'] ?></td>
                                                        <td><?= $arg['credentiel'] ?></td>
														<td><?= $arg['quota'] ?></td>
														<td><?php echo date('d/m/Y',strtotime($arg['date'])) ?></td>
														 <?php if($inf_corsi['buy_type']=='date'){?>
                                                        <td><?php echo date('d/m/Y',strtotime($arg['date_session'])) ?></td>
														 <?php } ?>
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

             <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/corsi/'.$inf_corsi['id'].'/modulo'), $attributes);?>
				  <input type="hidden" value="" id="deleteID" name="id">
				    <input type="hidden" value="delete" id="action" name="action">
            <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.title_modal_delete_corsi_modulo') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                                <?php echo lang('app.msg_delete_corso_modulo')?>

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
