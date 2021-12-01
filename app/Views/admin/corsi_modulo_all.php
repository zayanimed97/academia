<?= view('admin/common/header',array('page_title'=>lang('app.title_page_cours_modulo'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
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
											
											  <li class="breadcrumb-item active"><?php echo lang('app.menu_corsi_modulo')?></li>
											
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_cours_modulo') ?></h4>
										
                                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
						 <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										 <?php $attributes = ['class' => 'form-input-flat', 'id' => 'form-event','method'=>'post'];
										echo form_open_multipart( base_url('admin/modulo'), $attributes);?>
										   <div class="form-row">
										    <div class="form-group col-md-3">
                                               <label class="control-label"><?php echo lang('app.field_cuors_title')?></label>
            
													<select class="form-control select2" data-toggle="select2"  name="id_corsi" id="id_corsi">
                                                    <option value="">Select</option>
													<?php if(!empty($list_cours)){
														foreach($list_cours as $k=>$v){?>
													 <option value="<?php echo $v['id']?>" <?php if(isset($search_form) && $search_form['id_corsi']==$v['id']) echo 'selected'?>><?php echo $v['sotto_titolo']?></option>
													<?php } }?>
													</select>
                                            </div>
                                            <div class="form-group col-md-3">
                                               <label class="control-label"><?php echo lang('app.field_doctors')?></label>
            
													<select class="form-control select2" data-toggle="select2"  name="instructor" id="instructor">
                                                    <option value="">Select</option>
													<?php if(!empty($list_doctors)){
														foreach($list_doctors as $k=>$v){?>
													 <option value="<?php echo $v['id']?>" <?php if(isset($search_form) && $search_form['instructor']==$v['id']) echo 'selected'?>><?php echo $v['display_name']?></option>
													<?php } }?>
													</select>
                                            </div>
											<div class="form-group col-md-2">
                                              <label class="form-label" for="name"><?php echo lang('app.field_type_cours')?></label>
                                                    <select  class="form-control"  id="tipologia_corsi" name="tipologia_corsi">
													   <option value=""><?php echo lang('app.field_select')?></option>
													<?php foreach($ente_package['type_cours'] as $k=>$v){?>
														<option value="<?php echo $v?>" <?php if(isset($search_form) && $search_form['tipologia_corsi']==$v) echo 'selected'?>><?php echo $v?></option>
													<?php } ?>
													</select>
                                            </div>
											 <div class="form-group col-md-2">
                                              <label class="form-label" for="name"><?php echo lang('app.field_buy_type')?></label>
                                                    <select  class="form-control"  id="buy_type" name="buy_type">
													   <option value=""><?php echo lang('app.field_select')?></option>
														<option value="cours" <?php if(isset($search_form) && $search_form['buy_type']=='cours') echo 'selected'?>><?php echo lang('app.field_buy_type_cours')?></option>
														<option value="module" <?php if(isset($search_form) && $search_form['buy_type']=='module') echo 'selected'?>><?php echo lang('app.field_buy_type_modulo')?></option>
													
													</select>
                                            </div>
                                           <div class="form-group col-md-2">
                                              <label class="form-label" for="name"><?php echo lang('app.field_free_modulo')?></label>
                                                    <select  class="form-control"  id="free_modulo" name="free_modulo">
													   <option value=""><?php echo lang('app.field_select')?></option>
														<option value="yes" <?php if(isset($search_form) && $search_form['free_modulo']=='yes') echo 'selected'?>><?php echo lang('app.yes')?></option>
														<option value="no" <?php if(isset($search_form) && $search_form['free_modulo']=='no') echo 'selected'?>><?php echo lang('app.no')?></option>
													
													</select>
                                            </div>
										</div>
										  
										 <div class="form-row">
											<div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="search"><?php echo lang('app.btn_search')?></button>
											  <a href="<?php echo base_url('admin/modulo')?>" class="btn btn-light waves-effect" name="search"><?php echo lang('app.btn_clear')?></a>
											</div>
											</div>
                                         <?php echo form_close();?>	
									</div>
								</div>
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
                                                        <th><?php echo lang('app.field_title')?></th>
                                                       <th><?php echo lang('app.field_cuors_title')?></th>
                                                        <th>actions</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($list as $arg) { ?>
                                                    <tr>
                                                        <td><?= $arg['id'] ?></td>
                                                        <td><?= $arg['sotto_titolo'] ?></td>
                                                       <td><?= $arg['cour'] ?></td>
                                                       
                                                        <td class="row pt-1">
                                                          <a href="<?php echo base_url('admin/corsi/'.$arg['id_corsi'].'/modulo/edit/'.$arg['id'])?>" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
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

             <?php $attributes = ['class' => '', 'id' => 'pdf_form_list','method'=>'post'];
				echo form_open_multipart( base_url('admin/modulo'), $attributes);?>
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
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
      
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
!function(t){
			"use strict";
			function e(){
				
			}
			e.prototype.initSelect2=function(){t('[data-toggle="select2"]').select2()},
				e.prototype.init=function(){this.initSelect2()/*this.initMaxLength(),this.initSelectize(),this.initSwitchery(),this.initMultiSelect(),this.initTouchspin()*/},
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
						
     function get_del(id){
      
        $('#deleteID').val(id)
    }
</script>
<?= view('admin/common/endtag') ?>
