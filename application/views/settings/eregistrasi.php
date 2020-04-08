<div class="row">
	<div class="col-md-12" style="margin-bottom:.5rem;">
		<div class="row">
			<div class="col-md-6">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-add">
					<i class="fa fa-plus-circle"></i> Registrasi Baru
				</button>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control" id="input-kelurahan" placeholder="Ketik pencarian kelurahan disini...." autofocus autocomplete="off">
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
					<th>NO.</th>
					<th>USER ID</th>
					<th>NAMA KELURAHAN</th>
					<th>NAMA KEPALA DESA</th>
					<th class="text-center">AKSI</th>
				</thead>
				<tbody class="bg-white" id="load-registrasi">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- BEGIN MODAL NEW REGISTER -->
<div class="modal fade" id="modal-add">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">FORMULIR ENTRY REGISTRASI DESA / KELURAHAN</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<form class="form-horizontal" id="form-add" action="javascript:;">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-6">
							<label for="">Propinsi</label>
							<select id="propinsi" class="text-uppercase"></select>
							<span class="text-danger error-propinsi"></span>
						</div>
						<div class="col-md-6">
							<label for="">Kabupaten</label>
							<select id="kabupaten"></select>
							<span class="text-danger error-kabupaten"></span>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="">Kecamatan</label>
							<select id="kecamatan"></select>
							<span class="text-danger error-kecamatan"></span>
						</div>
						<div class="col-md-6">
							<label for="">Kelurahan</label>
							<select id="kelurahan"></select>
							<span class="text-danger error-kelurahan"></span>
						</div>
					</div>
					<div id="list-desa">
						<hr>
						<h4>INFORMASI DESA / KELURAHAN</h4>
						<hr>
						<div class="form-group row">
							<div class="col-sm-5">
								<label for="">Nama Kepala Desa</label>
								<input type="text" class="form-control" id="kades" placeholder="Isikan nama kepala desa..." autocomplete="off">
								<span class="text-danger error-kades"></span>
							</div>
							<div class="col-sm-7">
								<label for="">E-mail Desa / Kelurahan</label>
								<input type="email" class="form-control" id="email" placeholder="example@gmail.com" autocomplete="off">
								<span class="text-danger error-email"></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="">Alamat Kantor Kepala Desa</label>
								<input type="text" class="form-control" id="alamat" placeholder="Isikan alamat lengkap kantor..." autocomplete="off">
								<span class="text-danger error-alamat"></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3">
								<label for="">No. Telepon</label>
								<input type="text" class="form-control" id="telepon" placeholder="6288-XXX-XXX-XXX" autocomplete="off">
								<span class="text-danger error-telepon"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-registrasi">Batalkan</button>
					<button type="submit" class="btn btn-primary" id="btn-registrasi">Buatkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL REGISTER -->

<!-- BEGIN MODAL VIEW KELURAHAN -->
<div class="modal fade" id="modal-view-kelurahan">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">INFORMASI KELURAHAN <span id="kelurahan-title"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label for="user_id" class="control-label col-sm-3">USER ID DESA</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="user_id">
					</div>
				</div>
				<div class="form-group row">
					<label for="propinsi_detail" class="control-label col-sm-3">PROPINSI</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="propinsi-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="kabupaten-detail" class="control-label col-sm-3">KABUPATEN</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="kabupaten-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="kecamatan-detail" class="control-label col-sm-3">KECAMATAN</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="kecamatan-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="kelurahan-detail" class="control-label col-sm-3">KELURAHAN</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="kelurahan-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="kades-detail" class="control-label col-sm-3">KEP. DESA</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="kades-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="alamat-detail" class="control-label col-sm-3">ALM. KANTOR</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="alamat-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="email-detail" class="control-label col-sm-3">EMAIL</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="email-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="telepon-detail" class="control-label col-sm-3">TELEPON</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="telepon-detail">
					</div>
				</div>
				<div class="form-group row">
					<label for="sites-detail" class="control-label col-sm-3">WEBSITE</label>
					<div class="col-sm-9">
						<input type="text" disabled class="form-control" id="sites-detail">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">KELUAR</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL VIEW KELURAHAN -->

<!-- BEGIN MODAL EDIT KELURAHAN -->
<div class="modal fade" id="modal-edit-kelurahan">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">EDIT INFORMASI KELURAHAN <span id="edit-kelurahan-title"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label for="kelurahan-edit" class="control-label col-sm-3">KELURAHAN</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="kelurahan-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="kades-edit" class="control-label col-sm-3">KEP. DESA</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="kades-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="alamat-edit" class="control-label col-sm-3">ALM. KANTOR</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="alamat-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="email-edit" class="control-label col-sm-3">EMAIL</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="email-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="telepon-edit" class="control-label col-sm-3">TELEPON</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="telepon-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="sites-edit" class="control-label col-sm-3">WEBSITE</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="sites-edit">
					</div>
				</div>
				<div class="form-group row">
					<label for="status-edit" class="control-label col-sm-3">AKTIFASI</label>
					<div class="col-sm-9">
						<div class="switch-button switch-button-danger">
                            <input type="checkbox" checked="" name="switch18" id="switch18">
                            <span><label for="switch18"></label></span>
                        </div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal" id="btn-close-edit">
					Batalkan
				</button>
				<button type="submit" class="btn btn-danger" id="btn-edit-submit">Perbaharui</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL EDIT KELURAHAN -->

<!-- BEGIN DELETE ACCOUNT KELURAHAN -->
<div class="modal fade" id="modal-delete-kelurahan">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">KONFIRMASI HAPUS</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<i><b>Apakah anda yakin akan menghapus data kelurahan <span class="delete-title text-danger"></span> ?</b></i>
					</div>
					<div class="col-md-12">
						<div id="error-delete"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal" id="btn-delete-close">
					Batalkan
				</button>
				<button type="button" class="btn btn-danger" id="btn-delete-actions">YA, HAPUS</button>
			</div>
		</div>
	</div>
</div>
<!-- END DELETE ACCOUNT KELURAHAN -->

<script src="<?=site_url('assets/sites/simmas-registration.js')?>"></script>
<script type="text/javascript">
	SimmasRegistration.baseUrl = "<?=site_url()?>";
	SimmasRegistration.init();
</script>