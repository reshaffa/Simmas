<div class="row">
	<div class="col-md-8">
		<button class="btn btn-danger" id="btn-propinsi"><i class="fa fa-plus-circle"></i> Buat Propinsi</button>
		<button class="btn btn-danger" id="btn-kabupaten"><i class="fa fa-plus-circle"></i> Buat Kabupaten</button>
		<button class="btn btn-danger" id="btn-kecamatan"><i class="fa fa-plus-circle"></i> Buat Kecamatan</button>
		<button class="btn btn-danger" id="btn-kelurahan"><i class="fa fa-plus-circle"></i> Buat Kelurahan</button>
	</div>
	<div class="col-md-4">
		<div class="input-group">
			<input type="text" id="input-search" class="form-control" placeholder="Ketik pencarian disini...." autofocus="" autocomplete="off">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default" id="btn-search">
					<i class="fa fa-search"></i> Cari
				</button>
			</div>
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-dark">
				<thead class="text-white">
					<th>NO</th>
					<th>NAMA PROPINSI</th>
					<th>TOTAL KABUPATEN</th>
					<th width="25%">AKSI</th>
				</thead>
				<tbody class="bg-white" id="load-locations">
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- BEGIN MODAL PROPINSI -->
<div class="modal fade" id="modal-propinsi">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ENTRY PROPINSI</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="javascript:;" id="form-propinsi">
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Nama Propinsi <span class="required">*</span></label>
							<input type="text" class="form-control text-uppercase" id="propinsi">
							<small class="text-danger propinsi-error"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="close_propinsi">Batal</button>
					<button type="submit" class="btn btn-primary" id="submit_propinsi">Buatkan</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- END MODAL PROPINSI -->

<!-- BEGIN MODAL KABUPATEN -->
<div class="modal fade" id="modal-kabupaten">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ENTRY KABUPATEN</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="javascript:;" id="form-kabupaten">
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Pilih Propinsi <span class="required">*</span></label>
							<select id="select-kab-prop"></select>
							<small class="text-danger select-kab-prop-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Nama Kabupaten <span class="required">*</span></label>
							<input type="text" class="form-control text-uppercase" id="kabupaten">
							<small class="text-danger kabupaten-error"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="close_kabupaten">Batal</button>
					<button type="submit" class="btn btn-primary" id="submit_kabupaten">Buatkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL KABUPATEN -->

<!-- BEGIN MODAL KECAMATAN -->
<div class="modal fade" id="modal-kecamatan">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ENTRY KECAMATAN</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="javascript:;" id="form-kecamatan">
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Pilih Propinsi <span class="required">*</span></label>
							<select id="select-kec-prop"></select>
							<small class="text-danger select-kec-prop-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Pilih Kabupaten <span class="required">*</span></label>
							<select id="select-kec-kab"></select>
							<small class="text-danger select-kec-kab-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="" class="control-label">Nama Kecamatan <span class="required">*</span></label>
							<input type="text" class="form-control text-uppercase" id="kecamatan">
							<small class="text-danger kecamatan-error"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="close_kecamatan">Batal</button>
					<button type="submit" class="btn btn-primary" id="submit_kecamatan">Buatkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL KECAMATAN -->

<!-- BEGIN MODAL KELURAHAN -->
<div class="modal fade" id="modal-kelurahan">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ENTRY LOKASI BARU</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="javascript:;" id="form-kelurahan">
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nama Propinsi</label>
							<select id="select-propinsi"></select>
							<small class="text-danger select-propinsi-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nama Kabupaten</label>
							<select id="select-kabupaten"></select>
							<small class="text-danger select-kabupaten-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nama Kecamatan</label>
							<select id="select-kecamatan"></select>
							<small class="text-danger select-kecamatan-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nama Kelurahan</label>
							<input type="text" id="kelurahan" class="form-control text-uppercase" autocomplete="off">
							<small class="text-danger kelurahan-error"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Kode Pos</label>
							<input type="text" id="kode-pos" class="form-control" autocomplete="off">
							<small class="text-danger kodepos-error"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="btn-close-kelurahan" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary" id="btn-add-kelurahan">Simpan baru</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL KELURAHAN -->

<!-- BEGIN MODAL VIEW KABUPATEN -->
<div class="modal fade" id="modal-view-kabupaten">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">LIST KABUPATEN DARI PROPINSI <span class="title-propinsi"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 offset-md-6">
						<div class="input-group input-group-sm">
							<input type="text" id="kabupaten-search" class="form-control" placeholder="Ketik pencarian disini...." autofocus="" autocomplete="off">
							<div class="input-group-btn">
								<button type="button" class="btn btn-sm btn-dark" id="btn-kabupaten-search">
									<i class="fa fa-search"></i> Cari
								</button>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-dark">
								<thead class="text-center">
									<th>NO</th>
									<th>NAMA KABUPATEN</th>
									<th>TOTAL KECAMATAN</th>
									<th width="20%">AKSI</th>
								</thead>
								<tbody class="bg-white" id="load-kabupaten">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Keluar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- END MODAL VIEW KABUPATEN -->

<!-- BEGIN MODAL VIEW KECAMATAN -->
<div class="modal fade" id="modal-view-kecamatan">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">LIST KECAMATAN DARI PEMKAB.  <span class="title-kabupaten"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 offset-md-6">
						<div class="input-group input-group-sm">
							<input type="text" id="kecamatan-search" class="form-control" placeholder="Ketik pencarian disini...." autofocus="" autocomplete="off">
							<div class="input-group-btn">
								<button type="button" class="btn btn-sm btn-dark" id="btn-kecamatan-search">
									<i class="fa fa-search"></i> Cari
								</button>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-dark">
								<thead class="text-center">
									<th>NO</th>
									<th>NAMA KECAMATAN</th>
									<th>TOTAL KELURAHAN</th>
									<th width="20%">AKSI</th>
								</thead>
								<tbody class="bg-white" id="load-kecamatan">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Keluar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- END MODAL VIEW KECAMATAN -->

<!-- BEGIN MODAL VIEW KECAMATAN -->
<div class="modal fade" id="modal-view-kelurahan">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">LIST KELURAHAN DARI KEC.  <span class="title-kecamatan"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 offset-md-6">
						<div class="input-group input-group-sm">
							<input type="text" id="kelurahan-search" class="form-control" placeholder="Ketik pencarian disini...." autofocus="" autocomplete="off">
							<div class="input-group-btn">
								<button type="button" class="btn btn-sm btn-dark" id="btn-kelurahan-search">
									<i class="fa fa-search"></i> Cari
								</button>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-dark">
								<thead class="text-center">
									<th>NO</th>
									<th>NAMA KELURAHAN</th>
									<th>NAMA KADES</th>
									<th>INFORMASI</th>
									<th width="20%">AKSI</th>
								</thead>
								<tbody class="bg-white" id="load-kelurahan">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Keluar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- END MODAL VIEW KECAMATAN -->
<script src="<?=site_url('assets/sites/simmas-systems.js')?>"></script>
<script type="text/javascript">
	SimmasSystems.baseUrl = "<?=site_url()?>";
	SimmasSystems.init();
</script>