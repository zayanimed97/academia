
<?= view('admin/common/header',array('page_title'=>"abandoned cart")) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<div x-data="getInfoData()">
            <div class="content-page">
                <div id="workaround"></div>
                <div class="content">
                    <!--div x-text="data.id"></div-->
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title">Carrelli abbondonati</h4>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
								<p>Lista dei contatti che non hanno proceduto con l'acquisto.<br>Clicca su <i class="fe-mail"></i> per inviare una mail di promemoria.<br></p>
								<div class="alert alert-success m-b-20" role="alert">Hai già creato il tuo email template?<br>Se non l'hai ancora fatto, vai <a href="/admin/emails">QUI</a> per personalizzare il tuo modello.</div>
                                <div class="card">
                                    <div class="card-body">
                                        <?php if(session('error') ?? false){?>
										 <div class="alert alert-danger" role="alert">
											 <?php echo session('error')?>
											</div>
										 <?php }?>
										  <?php 
										 if(session('success') ?? false){?>
										 <div class="alert alert-success" role="alert">
											 <?php echo session('success')?>
											</div>
										 <?php }?>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
														<th>ID</th>
                                                        <th><?php echo lang('app.field_first_name')?></th>
                                                        <th><?php echo lang('app.field_email')?></th>
                                                        <th><?php echo lang('app.field_date')?></th>
                                                        <th>nb prod</th>
														
														 <th>prezzo</th>

                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($cart as $c) { ?>
                                                    <tr>
														 <td><?= $c['id'] ?></td>
                                                        <td><?= $c['display_name'] ?></td>
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <p><?= $c['user_email'] ?></p>
                                                            </div></td>
                                                        <td><?= $c['updated_at'] ?></td>
														  <td><button class="btn btn-primary p-1" onclick="cartItems(<?= $c['id'] ?>)"><?= json_decode($c['cart'])->total_items ?></button></td>
														   <td><?= json_decode($c['cart'])->cart_total ?></td>
                                                            
                                                        <td class="row pt-1">
                                                            <button type="button" onclick="emailList('<?php echo $c['id']?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-mail"></i>
                                                            </button>
															
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
            <div id="list-items-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered justify-content-center">
                    <div class="modal-content" style="width: fit-content; max-width: 90vw">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"> Lista Corsi </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="items-datatable" x-ref="dataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>IMG</th>
                                            <th>Titolo</th>
                                            <th>Tipo</th>
                                            <th>Prezzo</th>
                                            <th>Coupon</th>
                                            <th>Condiviso</th>
                                            <th>Da pagare</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody id="itemsBody">
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			
			
			  <div id="modalEmail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered justify-content-center">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Email notification</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" style="width: fit-content;">
                            <?php echo lang('app.success_send_contact')?>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			
			
</div>
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
<!-- <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script> -->
<!-- <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script> -->

<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>

<script>
    $(document).ready(() => {
        $("#items-datatable").DataTable({language:{url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json',paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"} ,drawCallback: function () {$(".dataTables_paginate > .pagination").addClass("pagination-rounded");}}});

    })
	function emailList(id){
		$.ajax({
				  url:"<?php echo base_url()?>/ajax/send_email_remember_cart",
				  method:"POST",
				  data:{id:id}
				  
			}).done(function(data){
				//console.log(data);
				//alert("<?php echo lang('app.success_send_contact')?>");
			$("#modalEmail").modal('show');
			});
	}
    function cartItems(id){
        let cart = <?= json_encode($cart) ?>.find(el => el.id == id);
        cart = JSON.parse(cart.cart)
        delete cart.cart_total
        delete cart.total_items
        let html = '';
        Object.keys(cart).forEach(el => {
        console.log(typeof cart[el].coupon);
        console.log(typeof cart[el].share);
                        html += `       <tr><td>${cart[el].id.replace(cart[el].type, '')}</td>\
                                        <td><img style="height: 5rem" src="${cart[el].options.image}"/></td>\
                                        <td><a href="${cart[el].url}">${cart[el].name}</a></td>\
                                        <td>${cart[el].type}</td>\
                                        <td>${cart[el].originalPrice}</td>'\
                                        <td><div>`
                        if (typeof cart[el].coupon == 'object') {
                            
                        Object.keys(cart[el].coupon).forEach(coup => {
                            html += `<p class="m-0">${coup} : ${cart[el].coupon[coup]}</p>`
                        })
                        }

                        html += `   </div></td>\
                                    <td><div>`

                        if (typeof cart[el].share == 'object') {
                            Object.keys(cart[el].share).forEach(sh => {
                                html += `<p class="m-0">${sh} : ${cart[el].share[sh]}</p>`
                            })
                        }
                        html += `   </div></td>\
                                    <td>${cart[el].price}</td>'\
                                        </tr>`
                    });
        $('#itemsBody').html(html);
        $('#list-items-modal').modal('show');
        // $('#itemsBody').html(html);
        // fetch(`<?php echo base_url()?>/admin/listitemss/${id}`, 
        //         {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
        //         .then( el => el.text() )
        //         .then(res => {
        //             JSON.parse(res).forEach(el => {
        //                 html += `       <tr><td>${el.id}</td>\
        //                                 <td>${el.st}</td>\
        //                                 <td>${el.price_ht}</td>\
        //                                 <td>${el.date}</td>\
        //                                 </tr>`
        //             });
        //             $('#itemsBody').html(html);
        //             $('#list-items-modal').modal('show');
        //         })
    }  
</script>
<?= view('admin/common/endtag') ?>
