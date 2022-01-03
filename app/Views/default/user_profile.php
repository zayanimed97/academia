<?php require_once 'common/header.php' ?>
  <div class="container">

            <h3 class="text-2xl font-medium mb-5"> <?php echo lang('front.title_page_user_profile')?> </h3>

           <div class="bg-yellow-500 border p-4 relative rounded-md uk-alert" uk-alert="" id="error_alert" style="display:none">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                   
                    <p class="text-white text-opacity-75" id="error_text"></p>
                </div>
             
                <div class="bg-green-500 border p-4 relative rounded-md uk-alert" uk-alert=""  id="success_alert" style="display:none">
                    <button class="uk-alert-close absolute bg-gray-100 bg-opacity-20 m-5 p-0.5 pb-0 right-0 rounded text-gray-200 text-xl top-0">
                        <i class="icon-feather-x"></i>
                    </button>
                
                    <p class="text-white text-opacity-75"  id="success_text"></p>
                </div>
          
            <!-- Basic information -->
			 <form method="POST"  id="profile_form" onsubmit="return valid_user();">
            <div class="grid lg:grid-cols-2 gap-8 md:mt-12" x-data="getResData">
               
                <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">

                    <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">
					
                        <div>
                            <label for="first-name"> <?php echo lang('front.field_first_name')?> <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="" id="nome" name="nome" class="shadow-none with-border" value="<?= $user['nome'] ?>">
                        </div>
                        <div>
                            <label for="last-name"><?php echo lang('front.field_last_name')?> <span class="text-red-600">*</span></label>
                            <input type="text" placeholder="" id="cognome" name="cognome" class="shadow-none with-border" value="<?= $user['cognome'] ?>">
                        </div>
						<div>
                            <label for="last-name"><?php echo lang('front.field_cf')?></label>
                            <input type="text" placeholder="" id="cf" name="cf" class="shadow-none with-border" value="<?= $user['cf'] ?>">
                        </div>
                        <div>
                            <label for="email"> Email </label>
                            <input type="text" placeholder="" id="email" name="email" class="shadow-none with-border" value="<?= $user['email'] ?>">
                        </div>
						<div>
                            <label for="last-name"><?php echo lang('front.field_mobile')?></label>
                            <input type="text" placeholder="" id="mobile" name="mobile" class="shadow-none with-border" value="<?= $user['mobile'] ?>">
                        </div>
						<div>
                            <label for="last-name"><?php echo lang('front.field_phone')?></label>
                            <input type="text" placeholder="" id="telefono" name="telefono" class="shadow-none with-border" value="<?= $user['telefono'] ?>">
                        </div>
						
						 <div>
                                        <label for="residenza_stato" class="text-sm font-medium"> <?php echo lang('front.field_country')?> </label>
                                        <select class="selectpicker border rounded-md" id="residenza_stato" name="residenza_stato" x-model="stato" @change="handleCountry">
                                            <option value="0"><?php echo lang('front.field_select')?></option>
                                            <?php foreach($country as $stato) { ?>
                                                <option value="<?= $stato['id'] ?>" <?php if(null !==$user['residenza_stato'] && $user['residenza_stato']==$stato['id']) echo 'selected'?>><?= $stato['nazione'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="residenza_provincia" class="text-sm font-medium"> <?php echo lang('front.field_provincia')?> </label>
                                        <div x-html="provincia"></div>
                                    </div>
                                    <div>
                                        <label for="residenza_comune" class="text-sm font-medium"> <?php echo lang('front.field_city')?> </label>
                                        <div x-html="comuni"></div>
                                    </div>
									 <div>
                                        <label for="cap" class="text-sm font-medium"> <?php echo lang('front.field_zip')?></label>
                                        <input type="text" class="with-border" id="cap" name="cap" value="<?= $user['residenza_cap'] ?>">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="indirizzo" class="text-sm font-medium"> <?php echo lang('front.field_address')?></label>
                                        <input type="text" class="with-border" id="indirizzo" name="indirizzo" value="<?= $user['residenza_indirizzo'] ?>">
                                    </div>
                                   <div>
                                        <label for="professione" class="text-sm font-medium"> <?php echo lang('front.field_professione')?> </label>
                                        <select class="selectpicker border rounded-md" id="professione" name="professione" onchange="get_discipline(this.value)">
                                            <option value="0"><?php echo lang('front.field_select')?></option>
                                            <?php if(!empty($list_prof)){
												foreach($list_prof as $stato) { ?>
                                                <option value="<?= $stato['idprof'] ?>" <?php if(null !==$user['professione'] && $user['professione']==$stato['idprof']) echo 'selected'?>><?= $stato['professione'] ?></option>
                                            <?php } }?>
                                        </select>
                                    </div> 
									<div>
                                        <label for="disciplina" class="text-sm font-medium"> <?php echo lang('front.field_disciplina')?> </label>
                                        <select class="selectpicker border rounded-md" id="disciplina" name="disciplina">
                                            <option value="0"><?php echo lang('front.field_select')?></option>
                                            <?php if(!empty($list_disc)){
												foreach($list_disc as $stato) { ?>
                                                <option value="<?= $stato['iddisciplina'] ?>" <?php if(null !==$user['disciplina'] && $user['disciplina']==$stato['iddisciplina']) echo 'selected'?>><?= $stato['disciplina'] ?></option>
                                            <?php } }?>
                                        </select>
                                    </div> 
						 <div class="flex justify-center col-span-2">
                                        
                                        <button name="submit" type="submit"  class="bg-blue-600 text-white flex font-medium items-center justify-center py-3 rounded-md hover:text-white w-1/3">
                                            <span class="md:block hidden"><?php echo lang('front.btn_save')?></span><span class="md:hidden block"><?php echo lang('front.btn_save')?></span>
                                            <i class="icon-feather-chevron-right ml-1"></i>
                                        </button>
                                    </div>
						
                        <!--div class="col-span-2">
                            <label for="about">About me</label>  
                            <textarea id="about" name="about" rows="3"  class="with-border"></textarea>
                        </div--> 
                         
                        <!-- Website logo  -->
                       
                       
                    </div> 
                    
                </div>
            </div>
		</form>
<?php /*
            <!-- Change Password -->
            <div class="grid lg:grid-cols-3 gap-8 md:mt-12">
                <div>
                    <div uk-sticky="offset:100;bottom:true;media:992">
                        <h3 class="text-lg mb-2 font-semibold"> Password</h3>
                        <p> Lorem ipsum dolor sit amet nibh consectetuer adipiscing elit</p>
                    </div>
                </div>
                <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">
                    
                    <div class="lg:p-6 p-4 space-y-4">
                        <div>
                            <label for="current_password"> Current password</label>
                            <input type="text" placeholder="" id="current_password" class="shadow-none with-border">
                        </div>
                        <div>
                            <label for="new_password"> New password</label>
                            <input type="text" placeholder="" id="new_password" class="shadow-none with-border">
                        </div>
                        <div>
                            <label for="confirm_new_password"> Confirm new password</label>
                            <input type="text" placeholder="" id="confirm_new_password" class="shadow-none with-border">
                        </div>
                    </div>
                </div>
            </div>
*/?>
           
          


        </div>
  
        <?= view($view_folder.'/common/footer') ?>
           
    
    <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
 <script>
  function getResData(){
        return {
            stato: '<?= $user['residenza_stato'] ?? '' ?>', 
            paymethod: 'paypal',
            type: '<?= $user['type'] ?? 'private' ?>',
            comuni: '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">', 
            provincia : '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">',

            

            handleCountry(e){
                if (e.target.value == '106') {
                    fetch(`<?php echo base_url()?>/getProv?country=${e.target.value}&name=residenza_provincia`, 
                        {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                        .then( el => el.text() ).then(res => {this.provincia = res; setTimeout(() => {$('select').selectpicker('render');}, 50)})
                }
                else {
                    this.provincia = '<input type="text" id="residenza_provincia" name="residenza_provincia" class="form-control with-border">'
                    this.comuni = '<input type="text" id="residenza_comune" name="residenza_comune" class="form-control with-border">'
                }
            },
            
            init(){
                Promise.allSettled([
                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106') {
                                // $('#loading').modal('show');
                                
                                return fetch(`<?php echo base_url()?>/getProv?country=106&selected=<?= $user['residenza_provincia'] ?>&name=residenza_provincia`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.provincia = res; setTimeout(() => {$('select').selectpicker('render');}, 50); resolve()})
                            } resolve();})) ,


                            new Promise((resolve, reject) => setTimeout(() => {if ('<?= $user['residenza_stato'] ?>' == '106' && '<?= $user['residenza_provincia'] ?>') {
                                // $('#loading').modal('show');

                                return fetch(`<?php echo base_url()?>/getComm?prov=<?= $user['residenza_provincia'] ?>&selected=<?= $user['residenza_comune'] ?>&name=residenza_comune`, 
                                    {method: "get",  headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                                    .then( el => el.text() ).then(res => {this.comuni = res; setTimeout(() => {$('select').selectpicker('render');}, 50); resolve()})
                            } resolve();})),

                            
                        ])
            }
        }

	/*$("input[name='residenza_provincia']").removeClass('form-control');
    $("input[name='residenza_comune']").removeClass('form-control');     */
    }
	
	 function get_discipline(v){
		
	$.ajax({
				  url:"<?php echo base_url('Ajax/get_discipline_by_professione')?>",
				  method:"POST",
				  data:{id:v}
				  
			}).done(function(data){
				
			
			
					$( "#disciplina" ).html(data);
				$( "#disciplina").selectpicker('render');
			
			});
	}
	
	function valid_user(){
		$("#success_alert").hide('slow');
		$("#error_alert").hide('slow');
		var fields = $( "#profile_form" ).serializeArray();
		$.ajax({

				  url:"<?php echo base_url('user/profile/valid_user')?>",

				  method:"POST",
				 data:fields
				  
			}).done(function(data){
				
			var obj=JSON.parse(data);
			//console.log(obj);
				if(obj.error==true){
					$("#error_text").html(obj.validation);
					$("#error_alert").show('slow');
				
					return false;
				}
				else{ 
					$("#success_text").html("<?php echo lang('front.success_update')?>");
					$("#success_alert").show('slow');
					return false;
				}
			
			});
			return false;
	}
</script>
 <?= view($view_folder.'/common/close') ?>