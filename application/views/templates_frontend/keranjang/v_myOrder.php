<section class="ftco-section ftco-cart">
	<div class="container">
		<div>
			<?php echo $this->session->flashdata('message');?>
		</div>
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>Transaction ID</th>
								<th>Transaction Status</th>
								<th>Transaction Date</th>
								<th>Payment Method</th>
								<th>Approved Date</th>
								<th>Receipt</th>
								<th>Total</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($getUserOrder->result() as $row): ?>
								<tr>
									<td><?php echo $row->transaction_id; ?></td>
									<td><?php echo $row->status; ?></td>
									<td><?php echo $row->transaction_date; ?></td>
									<td><?php echo $row->metode_pembayaran; ?></td>
									<td><?php echo $row->approved_date; ?></td>
									<td><?php if ($row->receipt != NULL) { ?>
										<a href="#"><span class="icon icon-check"></span></a>
									<?php } else { ?>
										<a href="#"><span class="icon icon-times"></span></a>
									<?php } ?></td>

									<td><?php echo $row->total; ?></td>
									<td><a class="btn btn-primary nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
										<div class="dropdown-menu" aria-labelledby="dropdown04">
											<?php if ($row->dstatus == '0' || $row->dstatus == '3') { ?>
												<a class="dropdown-item" href="javascript:doCancel(<?php echo $row->id; ?>);">Cancel</a>
											<?php } ?>
											<?php if ($row->transaction_id != NULL) { ?>
												<a class="dropdown-item" href="<?php echo base_url('/main/detail/transactionID/'.$row->transaction_id); ?>">Detail</a>
											<?php } ?>
										</div></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
</section>