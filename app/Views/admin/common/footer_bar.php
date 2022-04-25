 <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2021 - <script>document.write(new Date().getFullYear())</script> &copy; <b>Auledigitali</b> Tutti i diritti riservati. 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                   
                                    <a href="#help-modal" data-toggle="modal" class="btn btn-xs btn-warning">Help ?</a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
					
					<?php $attributes = ['class' => 'form-input-flat', 'id' => 'help_form','method'=>'post'];
		echo form_open("", $attributes);?>
		
		<div class="modal fade"id="help-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_help_form')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                          <label><?php echo lang('app.field_subject')?> *</label>
						  <input type="text" class="form-control" name="help_subject" id="help_subject">
						  <label><?php echo lang('app.field_message')?> *</label>
						  <textarea class="form-control" name="help_message" id="help_message"></textarea>
						  </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="return send_form_help();"><?php echo lang('app.btn_send')?></button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><?php echo lang('app.btn_cancel')?></button>
                            </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
       <?php echo form_close();?>	
                </footer>
		<script>
function send_form_help(){
	
	var subject=$("#help_subject").val();
	var msg=$("#help_message").val();
	
	if(subject=="" || msg==""){
		alert("<?php echo lang('app.error_required')?>");
	}
	else{
		$.ajax({
			url: '<?php echo base_url()?>/Ajax/send_help_form', // point to server-side controller method			
			type: 'post',
			data:{subject:subject,msg:msg}
		}).done(function(msg){
				alert("<?php echo lang('app.success_send_contact')?>");
				$("#help-modal").modal('hide');
				
			});
	}
}
</script>		