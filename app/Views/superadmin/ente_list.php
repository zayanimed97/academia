<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
       <title>Admin | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<?= csrf_meta() ?>
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">
		  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  
    <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		    <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

           <?php echo view('superadmin/header')?>

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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											 <li class="breadcrumb-item active"><?php echo lang('app.menu_ente')?></li>
                                          
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_list_ente')?></h4>
									
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
					<?php /*	<div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                      
                                        <div class="col-lg-12">
                                           <?php $attributes = ['class' => 'form-input-flat', 'id' => 'form-event','method'=>'post'];
										echo form_open_multipart( '', $attributes);?>
										   <div class="form-row">
										    <div class="form-group col-md-4">
													<label>ID</label>
													<input type="text" id="id" name="id" class="form-control" placeholder="ID N°" value="<?php if(isset($search_form) && $search_form['id']!="") echo $search_form['id']?>">
												</div>
                                            <div class="form-group col-md-4">
                                               <label class="control-label"><?php echo lang('app.field_user')?></label>
            
													<select class="form-control select2" data-toggle="select2"  name="user_id" id="event-title">
                                                    <option value="">Select</option>
													<?php if(!empty($list_users)){
														foreach($list_users as $k=>$v){?>
													 <option value="<?php echo $v['id']?>" <?php if(isset($search_form) && $search_form['user_id']==$v['id']) echo 'selected'?>><?php echo $v['name']?></option>
													<?php } }?>
													</select>
                                            </div>
											 
											 
                                           
										</div>
										  
										 <div class="form-row">
											<div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="search"><?php echo lang('app.btn_search')?></button>
											  <a href="<?php echo base_url('superadmin/ente')?>" class="btn btn-light waves-effect" name="search"><?php echo lang('app.btn_clear')?></a>
											</div>
											</div>
                                         <?php echo form_close();?>	
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div> <!-- end card-box -->
                            </div><!-- end col-->
                        </div>		*/?>
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
										
										
                                         <table id="scroll-horizontal-datatable" class="table w-100 nowrap" >
                                            <thead>
                                                <tr>
                                                   
                                                    <th>ID</th>
                                                   <th>&nbsp;</th>
													  <th><?php echo lang('app.field_server_name')?></th>
													<th>Email</th>

                                                   <th><?php echo lang('app.field_ente')?></th>
												    <th><?php echo lang('app.field_type')?></th>
												   <th><?php echo lang('app.field_expired_date')?></th>
												   <!--th><?php echo lang('app.menu_package')?></th-->
												   <th><?php echo lang('app.field_attivo')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($list)){
												foreach($list as $k=>$v){
													
														?>
                                                <tr>
                                                   
                                                    <td><?php echo $v['id']?></td>
													<td>
													<button href="#profile-modal-dialog" class="btn btn-xs btn-info" data-toggle="modal" onclick="get_profile('<?php echo $v['id']?>')"><i class="fa fa-user"></i></button>	
													<a href="<?php echo base_url('superadmin/ente/edit/'.$v['id'])?>" class="btn btn-xs btn-primary" ><i class="fa fa-edit"></i></a>
													<button href="#delete-modal-dialog" class="btn btn-xs btn-danger" data-toggle="modal" onclick="del_data('<?php echo $v['id']?>')"><i class="fa fa-trash"></i></button>	
													
													</td>
													<td><?php echo $v['domain_ente']?></td>
													<td><?php echo $v['email']?><br/><?php echo $v['mobile']?><br/><a href="<?php echo base_url('superadmin/loginAs/'.$v['id'])?>"><?php echo lang('app.btn_login')?></a></td>
													
													
													<td><?php echo $v['ente']?></td>
													<td><?php echo $v['type']?></td>
													<td><?php echo date('d/m/Y',strtotime($v['expired_date']))?></td>
                                                    <!--td><?php echo $v['package']?></td-->
													<td><?php if($v['active']=='yes'){?><span class="badge bg-soft-success text-success p-1"><?php echo lang('app.yes')?></span> <?php } else{?> <span class="badge bg-soft-danger text-danger p-1"><?php echo lang('app.no')?></span><?php } ?></td>
                                                </tr>
											<?php } }?>
                                                
                                            </tbody>
										</table>
                                        <!-- end row-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
               <?php echo view('superadmin/footer');?>
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
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_ente')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_user')?>
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
		
		<div class="modal fade"id="profile-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_profile_ente')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4" id="div_profile">
                       
                        
                    </div>
					 <div class="modal-footer">
						<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><?php echo lang('app.btn_close')?></button>
					 </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
		   
        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/vendor.min.js"></script>
		
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
			 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>

        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		  

        <!-- Init js-->
        <script src="../assets/js/pages/form-pickers.init.js"></script>
		  <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		 
		  <!-- third party js -->
       
		 <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
        <!-- App js -->
		 <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
		<script>
		!function(i){"use strict";function e(){}e.prototype.init=function(){
			
			i("#range-datepicker").flatpickr({mode:"range",altFormat:"F j, Y",dateFormat:"d/m/Y","locale": 'it'}),
			i("#inline-datepicker").flatpickr({inline:!0}),
			i("#basic-timepicker").flatpickr({enableTime:!0,noCalendar:!0,dateFormat:"H:i"}),
			i("#24hours-timepicker").flatpickr({enableTime:!0,noCalendar:!0,dateFormat:"H:i",time_24hr:!0}),
			i("#minmax-timepicker").flatpickr({enableTime:!0,noCalendar:!0,dateFormat:"H:i",minDate:"16:00",maxDate:"22:30"}),
			i("#preloading-timepicker").flatpickr({enableTime:!0,noCalendar:!0,dateFormat:"H:i",defaultDate:"01:45"}),
			i("#basic-colorpicker").colorpicker(),
			i("#hexa-colorpicker").colorpicker({format:"auto"}),
			i("#component-colorpicker").colorpicker({format:null}),
			i("#horizontal-colorpicker").colorpicker({horizontal:!0}),
			i("#inline-colorpicker").colorpicker({color:"#DD0F20",inline:!0,container:!0}),
			i(".clockpicker").clockpicker({donetext:"Done"}),
			i("#single-input").clockpicker({placement:"bottom",align:"left",autoclose:!0,default:"now"}),
			i("#check-minutes").click(function(e){e.stopPropagation(),
			i("#single-input").clockpicker("show").clockpicker("toggleView","minutes")})},
			i.FormPickers=new e,i.FormPickers.Constructor=e}
			(window.jQuery),function(){"use strict";window.jQuery.FormPickers.init()}();
		</script>
        <script>
		!function(t){
			"use strict";
			function e(){
				
			}
			e.prototype.initSelect2=function(){t('[data-toggle="select2"]').select2()},
		//	e.prototype.initMaxLength=function(){t("input#defaultconfig").maxlength({warningClass:"badge badge-success",limitReachedClass:"badge badge-danger"}),t("input#thresholdconfig").maxlength({threshold:20,warningClass:"badge badge-success",limitReachedClass:"badge badge-danger"}),t("input#alloptions").maxlength({alwaysShow:!0,separator:" out of ",preText:"You typed ",postText:" chars available.",validate:!0,warningClass:"badge badge-success",limitReachedClass:"badge badge-danger"}),t("textarea#textarea").maxlength({alwaysShow:!0,warningClass:"badge badge-success",limitReachedClass:"badge badge-danger"}),t("input#placement").maxlength({alwaysShow:!0,placement:"top-left",warningClass:"badge badge-success",limitReachedClass:"badge badge-danger"})},
		//	e.prototype.initSelectize=function(){t("#selectize-tags").selectize({persist:!1,createOnBlur:!0,create:!0}),t("#selectize-select").selectize({create:!0,sortField:{field:"text",direction:"asc"},dropdownParent:"body"}),t("#selectize-maximum").selectize({maxItems:3}),t("#selectize-links").selectize({theme:"links",maxItems:null,valueField:"id",searchField:"title",options:[{id:1,title:"Coderthemes",url:"https://coderthemes.com/"},{id:2,title:"Google",url:"http://google.com"},{id:3,title:"Yahoo",url:"http://yahoo.com"}],render:{option:function(e,a){return'<div class="option"><span class="title">'+a(e.title)+'</span><span class="url">'+a(e.url)+"</span></div>"},item:function(e,a){return'<div class="item"><a href="'+a(e.url)+'">'+a(e.title)+"</a></div>"}},create:function(e){return{id:0,title:e,url:"#"}}}),t("#selectize-confirm").selectize({delimiter:",",persist:!1,onDelete:function(e){return confirm(1<e.length?"Are you sure you want to remove these "+e.length+" items?":'Are you sure you want to remove "'+e[0]+'"?')}}),t("#selectize-optgroup").selectize({sortField:"text"}),t("#selectize-programmatic").selectize({options:[{class:"mammal",value:"dog",name:"Dog"},{class:"mammal",value:"cat",name:"Cat"},{class:"mammal",value:"horse",name:"Horse"},{class:"mammal",value:"kangaroo",name:"Kangaroo"},{class:"bird",value:"duck",name:"Duck"},{class:"bird",value:"chicken",name:"Chicken"},{class:"bird",value:"ostrich",name:"Ostrich"},{class:"bird",value:"seagull",name:"Seagull"},{class:"reptile",value:"snake",name:"Snake"},{class:"reptile",value:"lizard",name:"Lizard"},{class:"reptile",value:"alligator",name:"Alligator"},{class:"reptile",value:"turtle",name:"Turtle"}],optgroups:[{value:"mammal",label:"Mammal",label_scientific:"Mammalia"},{value:"bird",label:"Bird",label_scientific:"Aves"},{value:"reptile",label:"Reptile",label_scientific:"Reptilia"}],optgroupField:"class",labelField:"name",searchField:["name"],render:{optgroup_header:function(e,a){return'<div class="optgroup-header">'+a(e.label)+' <span class="scientific">('+a(e.label_scientific)+")</span></div>"}}}),t("#selectize-optgroup-column").selectize({options:[{id:"avenger",make:"dodge",model:"Avenger"},{id:"caliber",make:"dodge",model:"Caliber"},{id:"caravan-grand-passenger",make:"dodge",model:"Caravan Grand Passenger"},{id:"challenger",make:"dodge",model:"Challenger"},{id:"ram-1500",make:"dodge",model:"Ram 1500"},{id:"viper",make:"dodge",model:"Viper"},{id:"a3",make:"audi",model:"A3"},{id:"a6",make:"audi",model:"A6"},{id:"r8",make:"audi",model:"R8"},{id:"rs-4",make:"audi",model:"RS 4"},{id:"s4",make:"audi",model:"S4"},{id:"s8",make:"audi",model:"S8"},{id:"tt",make:"audi",model:"TT"},{id:"avalanche",make:"chevrolet",model:"Avalanche"},{id:"aveo",make:"chevrolet",model:"Aveo"},{id:"cobalt",make:"chevrolet",model:"Cobalt"},{id:"silverado",make:"chevrolet",model:"Silverado"},{id:"suburban",make:"chevrolet",model:"Suburban"},{id:"tahoe",make:"chevrolet",model:"Tahoe"},{id:"trail-blazer",make:"chevrolet",model:"TrailBlazer"}],optgroups:[{$order:3,id:"dodge",name:"Dodge"},{$order:2,id:"audi",name:"Audi"},{$order:1,id:"chevrolet",name:"Chevrolet"}],labelField:"model",valueField:"id",optgroupField:"make",optgroupLabelField:"name",optgroupValueField:"id",lockOptgroupOrder:!0,searchField:["model"],plugins:["optgroup_columns"],openOnFocus:!1}),t(".selectize-close-btn").selectize({plugins:["remove_button"],persist:!1,create:!0,render:{item:function(e,a){return'<div>"'+a(e.text)+'"</div>'}},onDelete:function(e){return confirm(1<e.length?"Are you sure you want to remove these "+e.length+" items?":'Are you sure you want to remove "'+e[0]+'"?')}}),t(".selectize-drop-header").selectize({sortField:"text",hideSelected:!1,plugins:{dropdown_header:{title:"Language"}}})},
		//	e.prototype.initSwitchery=function(){t('[data-plugin="switchery"]').each(function(e,a){new Switchery(t(this)[0],t(this).data())})},
			e.prototype.initMultiSelect=function(){0<t('[data-plugin="multiselect"]').length&&t('[data-plugin="multiselect"]').multiSelect(t(this).data())},
		//	e.prototype.initTouchspin=function(){var n={};t('[data-toggle="touchspin"]').each(function(e,a){var i=t.extend({},n,t(a).data());t(a).TouchSpin(i)})},
			e.prototype.init=function(){this.initSelect2(),this.initMultiSelect()/*this.initMaxLength(),this.initSelectize(),this.initSwitchery(),this.initMultiSelect(),this.initTouchspin()*/},
			t.FormAdvanced=new e,t.FormAdvanced.Constructor=e}
			(window.jQuery),function(){
				"use strict";
				window.jQuery.FormAdvanced.init()}(),
			$(function(){
				"use strict";
				var o=$.map(countries,function(e,a){return{value:e,data:a}});
				$.mockjax({url:"*",responseTime:2e3,response:function(e){
					var a=e.data.query,i=a.toLowerCase(),
					n=new RegExp("\\b"+$.Autocomplete.utils.escapeRegExChars(i),"gi"),
					t={query:a,suggestions:$.grep(o,function(e){return n.test(e.value)})};
					this.responseText=JSON.stringify(t)}})
				,$("#autocomplete-ajax").autocomplete({
					lookup:o,lookupFilter:function(e,a,i){
						return new RegExp("\\b"+$.Autocomplete.utils.escapeRegExChars(i),"gi").test(e.value)},onSelect:function(e){$("#selction-ajax").html("You selected: "+e.value+", "+e.data)},
						onHint:function(e){$("#autocomplete-ajax-x").val(e)},
						onInvalidateSelection:function(){
							$("#selction-ajax").html("You selected: none")}});
						var e=$.map(["Anaheim Ducks","Atlanta Thrashers","Boston Bruins","Buffalo Sabres","Calgary Flames","Carolina Hurricanes","Chicago Blackhawks","Colorado Avalanche","Columbus Blue Jackets","Dallas Stars","Detroit Red Wings","Edmonton OIlers","Florida Panthers","Los Angeles Kings","Minnesota Wild","Montreal Canadiens","Nashville Predators","New Jersey Devils","New Rork Islanders","New York Rangers","Ottawa Senators","Philadelphia Flyers","Phoenix Coyotes","Pittsburgh Penguins","Saint Louis Blues","San Jose Sharks","Tampa Bay Lightning","Toronto Maple Leafs","Vancouver Canucks","Washington Capitals"],
						function(e){return{value:e,data:{category:"NHL"}}}),
						a=$.map(["Atlanta Hawks","Boston Celtics","Charlotte Bobcats","Chicago Bulls","Cleveland Cavaliers","Dallas Mavericks","Denver Nuggets","Detroit Pistons","Golden State Warriors","Houston Rockets","Indiana Pacers","LA Clippers","LA Lakers","Memphis Grizzlies","Miami Heat","Milwaukee Bucks","Minnesota Timberwolves","New Jersey Nets","New Orleans Hornets","New York Knicks","Oklahoma City Thunder","Orlando Magic","Philadelphia Sixers","Phoenix Suns","Portland Trail Blazers","Sacramento Kings","San Antonio Spurs","Toronto Raptors","Utah Jazz","Washington Wizards"],
						function(e){return{value:e,data:{category:"NBA"}}}),
						i=e.concat(a);$("#autocomplete").devbridgeAutocomplete({lookup:i,minChars:1,onSelect:function(e){$("#selection").html("You selected: "+e.value+", "+e.data.category)}
						,showNoSuggestionNotice:!0,noSuggestionNotice:"Sorry, no matching results",groupBy:"category"}),
						$("#autocomplete-custom-append").autocomplete({lookup:o,appendTo:"#suggestions-container"}),
						$("#autocomplete-dynamic").autocomplete({lookup:o})});
						var countries={AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region"
						};
						
						
						
		
				
						
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
		function get_profile(id){
			$.ajax({
				  url:"<?php echo base_url()?>/ajax/get_profile_ente",
				  method:"POST",
				  data:{id:id}
				  
			}).done(function(data){
				
				$("#div_profile").html(data);
			});
		}
		</script>
    </body>
</html>