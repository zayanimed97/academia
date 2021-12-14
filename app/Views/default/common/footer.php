        <!-- footer -->
        <div class="mb-7 px-12 border-t pt-7 mt-auto">
            <div class="flex flex-col items-center justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                <p class="capitalize font-medium"> <?php echo $settings['copyright']?></p>
                <div class="lg:flex space-x-4 text-gray-700 capitalize hidden">
				<?php if(!empty($list_static_pages)){
					foreach($list_static_pages as $k=>$one_page){?>
                    <a href="<?php echo base_url('page/'.$one_page['url'])?>"> <?php echo $one_page['menu_title']?></a>
				<?php } }?>
                   
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
        function headerData() {
            return {
                cartItems: <?= json_encode($cart->contents()) ?>,
                total: <?= $cart->total() ?>,
                items: <?= $cart->totalItems() ?>,
                tax: <?= $tax ?>,
                addToCart(id, prezzo, type, url, item) {
                    if (type == 'date') {
                        location.href = '<?= base_url() ?>/corsi/'+url
                    } else {
                        // console.log(id, prezzo, type, url);
                        $.ajax({
                            url: '<?= base_url('addToCart') ?>', 
                            type: 'post',
                            data: {"id": id, "price": prezzo, "type": item}, 
                            dataType: 'json'
                        })
                        .done((res)=>{this.cartItems = res.cart; this.total = res.totalPrice; this.items = res.total; this.tax = res.tax})
                    }
                },
                removeFromCart(row){
                    console.log('fad');
                    fetch('<?= base_url('removeFromCart') ?>/'+row, {
                            method: "get",  
                            headers: {"Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" }})
                            .then( el => el.json() )
                            .then(res => {this.cartItems = res.cart; this.total = res.totalPrice; this.items = res.total; this.tax = res.tax})
                }
            }
        }
    </script>

