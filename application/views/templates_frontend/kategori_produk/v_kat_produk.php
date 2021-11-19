<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Kami</span>
            </div>
        </div>      
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="javascript:;" class="active">Semua Kategori</a></li>
                        <?php foreach($getKategori->result() as $row): ?>
                            <li><a href="javascript:getOrder(<?php echo $row->id;?>, 'SPESIFIK');" class="active"><?php echo $row->jenis;?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="row" id="target_product">
                <div class="col-md-6 col-lg-3">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                            <span class="status">30%</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">Bell Pepper</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="<?php echo base_url() ?>/assets/backend/js/product.js"></script>

<script type="text/javascript">
    // getKategori();
    getOrder('1', 'ALL');
    
</script>