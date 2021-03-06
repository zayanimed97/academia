        <!-- footer -->
        <div class="mb-7 px-12 border-t pt-7 mt-auto">
          <div class="flex flex-col justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                <?php echo $settings['copyright'] ?? ''?>
                <div class="lg:flex space-x-4 text-gray-700 capitalize hidden">
				<?php if(!empty($list_static_pages)){
					foreach($list_static_pages as $k=>$one_page){
						if($one_page['menu_position']=='footer'){
							if($one_page['is_externel']=='no') $url=base_url('page/'.$one_page['url']); else $url=$one_page['url'];?>
							<a href="<?php echo $url?>" <?php if($one_page['is_externel']=='yes') echo "target='_blank'";?> ><?php echo $one_page['menu_title']?></a>
						<?php } 
					} 
				}?>
                   
                </div>
				
            </div>
			<?php if(($settings['social'] ?? '') !=""){
				$social=json_decode($settings['social'],true);?>
			 <div class="flex justify-end lg:flex-row max-w-6xl mx-auto space-x-3">
			 <?php foreach($social as $kk=>$vv){
				 if($vv!=""){?>
			 <a target="_blank" href="<?php echo $vv?>" ><?php switch($kk){
				 case 'site_web':?><span class="icon-material-outline-language"></span><?php break;
				  case 'twitter':?><span class="icon-brand-twitter"></span><?php break;
				   case 'facebook':?><span class="icon-brand-facebook"></span><?php break;
				    case 'linkedin':?><span class="icon-brand-linkedin"></span><?php break;
					 case 'youtube':?><span class="icon-brand-youtube"></span><?php break;
					  case 'instagram':?><span class="icon-brand-instagram"></span><?php break;
					   case 'blog':?><span class="icon-material-outline-assignment"></span><?php break;
			 } }?></a>
			 <?php } ?>
			 </div>
			<?php } ?>
			
			<div class="justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                <div class="space-x-4 text-gray-300 text-center">
					Piattaforma di E-learning realizzata da <a href="https://auledigitali.it/"><b>Auledigitali.it</b></a>
                </div>
            </div>
        </div>

    </div>
           
    
    <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script>
	 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/parsleyjs/i18n/it.js"></script>
    <script defer src="https://unpkg.com/alpinejs"></script>
    <script>
        var formatter = new Intl.NumberFormat('it-IT', {
            style: 'currency',
            currency: 'EUR',

            // These options are needed to round to whole numbers if that's what you want.
            //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
        });
        function headerData($watch) {
            return {
                cartItems: <?= json_encode($cart->contents()) ?>,
                total: <?= $cart->total() ?>,
                items: <?= $cart->totalItems() ?>,
                tax: <?= $tax ?>,
                coupons: <?= json_encode(array_values(array_map(function($el){return $el['coupon'];},$cart->contents()))) ?>,
                share: <?= json_encode(array_values(array_map(function($el){return $el['share'];},$cart->contents()))) ?>,
                couponSum: {},
                shareSum: {},
                flashMessage: {status: '', message:''},
                init(){
                    if (this.coupons.length > 0) {
                        this.coupons.forEach(el => {Object.keys(el).forEach(key=> this.couponSum[key] = null)});
                        Object.keys(this.couponSum).forEach(key => {
                            this.couponSum[key] = this.coupons.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? (isNaN(pv) ? 0 : pv) : 0)+parseFloat(cv ? (isNaN(cv) ? 0 : cv) : 0)}, 0);
                        });
                    }
                    $watch('coupons', value => {
                        this.couponSum = {};
                        if (this.coupons.length > 0) {
                            this.coupons.forEach(el => {Object.keys(el).forEach(key=> this.couponSum[key] = null)});
                            Object.keys(this.couponSum).forEach(key => {
                                this.couponSum[key] = this.coupons.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? (isNaN(pv) ? 0 : pv) : 0)+parseFloat(cv ? (isNaN(cv) ? 0 : cv) : 0)}, 0);
                            });
                        }
                        console.log(this.couponSum);
                    })

                    if (this.share.length > 0) {
                        this.share.forEach(el => {Object.keys(el).forEach(key=> this.shareSum[key] = null)});
                        Object.keys(this.shareSum).forEach(key => {
                            this.shareSum[key] = this.share.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? (isNaN(pv) ? 0 : pv) : 0)+parseFloat(cv ? (isNaN(cv) ? 0 : cv) : 0)}, 0);
                        });
                    }
                    $watch('share', value => {
                        this.shareSum = {};
                        if (this.share.length > 0) {
                            this.share.forEach(el => {Object.keys(el).forEach(key=> this.shareSum[key] = null)});
                            Object.keys(this.shareSum).forEach(key => {
                                this.shareSum[key] = this.share.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? (isNaN(pv) ? 0 : pv) : 0)+parseFloat(cv ? (isNaN(cv) ? 0 : cv) : 0)}, 0);
                            });
                        }
                        console.log(this.shareSum);
                    })
                    console.log(this.share , this.couponSum);
                },
                addToCart(id, prezzo, type, url, item, date=null) {
                    if (type == 'date') {
                        location.href = '<?= base_url() ?>/'+item+'/'+url
                    } else {
                        // console.log(id, prezzo, type, url);
                        $.ajax({
                            url: '<?= base_url('addToCart') ?>', 
                            type: 'post',
                            data: {"id": id, "price": prezzo, "type": item, date: date}, 
                            dataType: 'json'
                        })
                        .done((res)=>{  this.cartItems = res.cart; 
                                        this.total = res.totalPrice; 
                                        this.items = res.total; 
                                        this.tax = res.tax;
                                        this.coupons = res.coupons;
                                        this.share = res.share;  
                                    })
                    }
                },
                removeFromCart(row){
                    console.log('fad');
                    fetch('<?= base_url('removeFromCart') ?>/'+row, {
                            method: "get",  
                            headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                            .then( el => el.json() )
                            .then(res =>{   this.cartItems = res.cart; 
                                            this.total = res.totalPrice; 
                                            this.items = res.total; 
                                            this.tax = res.tax;
                                            this.coupons = res.coupons;
                                            this.share = res.share;
                                        })
                },
                inCart(corsi_id, id, date=null){
                    let corsiInCart = (Object.values(this.cartItems)).find(element => {return (corsi_id == '' && element.id == 'corsi'+id) || (element.id == 'corsi'+corsi_id)})
                    let moduleInCart = (Object.values(this.cartItems)).filter(element => {return (corsi_id != '' && element.id == 'modulo'+id)})
                    if (date && moduleInCart.length>0) {
                        return moduleInCart.find(el => {return el.options.date == date}) ? 'in cart' : 'disabled';
                    }
                    return (corsiInCart || moduleInCart.length>0) ? '<?= lang('front.title_checkout') ?>' : false;
                },
                applyCoupon(code){
                    fetch('<?= base_url('/order/coupon') ?>', {
                        method: 'post',
                        headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" },
                        body: JSON.stringify({coupon: code})
                    })
                    .then( el => el.json() )
                    .then(res =>    {   
                                        this.cartItems = res.cartItems; 
                                        this.total = res.total; 
                                        this.tax = res.tax, 
                                        this.coupons = res.coupons;
                                        this.share = res.share;  
                                        this.flashMessage.status = res.status, 
                                        this.flashMessage.message = res.message
                                    })

                        
                },
                shareFacebook(rowid, url, discount){
                    let fields = {rowid: rowid, url: url, platform: 'facebook'};
                            $.ajax({
                                    url:"<?php echo base_url('/user/preshare')?>",
                                    method:"POST",
                                    data:fields
                                })
                    FB.ui({
                        method: 'share',
                        href: url,
                    }, response => {
                        
                        if(typeof(response) == 'object' && Object.keys(response).length == 0){
                            let fields = {rowid: rowid, url: url, platform: 'facebook', discount: discount};
                            $.ajax({
                                    url:"<?php echo base_url('/user/postShared')?>",
                                    method:"POST",
                                    data:fields
                            
                                }).done((res) => {  res = JSON.parse(res);
                                                    this.cartItems = res.cartItems; 
                                                    this.total = res.total; 
                                                    this.tax = res.tax, 
                                                    this.coupons = res.coupons;
                                                    this.share = res.share;  
                                                    this.flashMessage.status = res.status, 
                                                    this.flashMessage.message = res.message
                                                })
                        }
                    })
                }
            }
        }
    </script>

  