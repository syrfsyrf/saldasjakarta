<?php foreach($GetDetailProdukFront->result() as $row): ?>
<section class="ftco-section">
 <div class="container">
  <div class="row">
   <div class="col-lg-6 mb-5 ftco-animate">
    <a href="images/product-1.jpg" class="image-popup"><img src="<?php echo base_url().$row->path.'/'.$row->file; ?>" class="img-fluid" alt="Colorlib Template"></a>
  </div>
  <div class="col-lg-6 product-details pl-md-5 ftco-animate">
    <h3><?php echo $row->nama_produk; ?></h3>
  <p class="price"><span>Rp <?php echo $row->dharga.$row->jenis_harga_detail; ?></span></p>
  <p><?php echo $row->deskripsi;?>
  </p>
  <div class="row mt-4">
<div class="w-100"></div>
<div class="col-md-12">
 <p style="color: #000;">Sisa Stok: <?php echo $row->sisa_stok;?></p>
</div>
</div>
<p><a href="javascript:addOrder('<?php echo $row->id_stock; ?>');" class="btn btn-black py-3 px-5">Add to Cart</a></p>
</div>
</div>
</div>
</section>
<?php endforeach;?>