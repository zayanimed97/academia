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
                couponSum: {},
                flashMessage: {status: '', message:''},
                init(){
                    if (this.coupons.length > 0) {
                        this.coupons.forEach(el => {Object.keys(el).forEach(key=> this.couponSum[key] = null)});
                        Object.keys(this.couponSum).forEach(key => {
                            this.couponSum[key] = this.coupons.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}, 0);
                        });
                    }
                    $watch('coupons', value => {
                        this.couponSum = {};
                        if (this.coupons.length > 0) {
                            this.coupons.forEach(el => {Object.keys(el).forEach(key=> this.couponSum[key] = null)});
                            Object.keys(this.couponSum).forEach(key => {
                                this.couponSum[key] = this.coupons.map(el=> {return el[key]}).reduce((pv,cv)=>{return parseFloat(pv ? pv : 0)+parseFloat(cv ? cv : 0)}, 0);
                            });
                        }
                        console.log(this.couponSum);
                    })

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
                                        this.flashMessage.status = res.status, 
                                        this.flashMessage.message = res.message
                                    })

                        
                }
            }
        }
    </script>

