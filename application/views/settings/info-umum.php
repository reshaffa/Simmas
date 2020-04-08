<div class="row">
	<div class="col-md-12" style="margin-bottom:.5rem;">
		<div class="row">
			<div class="col-md-6">
				<button type="button" class="btn btn-danger" id="btn-add-informasi">
					<i class="fa fa-plus-circle"></i> Buat Informasi
				</button>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control" id="input-informasi" placeholder="Ketik pencarian informasi disini...." autofocus autocomplete="off">
					<div class="input-group-btn">
						<button type="button" class="btn btn-dark" id="btn-search">
							<i class="fa fa-search"></i> Cari
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-dark">
				<thead>
					<th class="text-center">NO</th>
					<th>JUDUL INFORMASI</th>
					<th>TGL. TERBIT</th>
					<th>TARGET INFORMASI</th>
					<th class="text-center">AKSI</th>
				</thead>
				<tbody class="bg-white" id="load-informasi">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- BEGIN MODAL INFORMASI -->
<div class="modal fade" id="modal-add-informasi">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">FORMULIR ENTRY INFORMASI</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<form class="form-horizontal" id="form-add" action="javascript:;">
				<div class="modal-body">
					<div class="form-group row">
						<label for="target_to" class="col-md-3">TARGET INFORMASI</label>
						<div class="col-md-9">
							<select id="target_to" multiple="multiple">
								<option value="umum">Umum</option>
								<option value="kelurahan">Kelurahan</option>
								<option value="kecamatan">Kecamatan</option>
							</select>
						</div>
					</div>
					<div class="form-group" style="margin-top: 10px">
						<textarea class="form-control" id="informasi" rows="6" placeholder="Ketik isi informasi disini......"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark" data-dismiss="modal" id="btn-close-users">Batalkan</button>
					<button type="submit" class="btn btn-danger" id="btn-users">Buatkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL INFORMASI -->


<script src="<?=site_url('assets/sites/simmas-informasi.js')?>"></script>
<script type="text/javascript">
	SimmasInfo.baseUrl = "<?=site_url()?>";
	SimmasInfo.init();
</script>