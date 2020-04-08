<div class="row">
	<div class="col-md-12" style="margin-bottom:.5rem;">
		<div class="row">
			<div class="col-md-6">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-add">
					<i class="fa fa-plus-circle"></i> Users Baru
				</button>
				<button type="button" class="btn btn-danger" id="btn-list-access">
					<i class="fa fa-list"></i> List Akses
				</button>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control" id="input-users" placeholder="Ketik pencarian kelurahan disini...." autofocus autocomplete="off">
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
					<th>USER ID</th>
					<th>USERNAME</th>
					<th>EMAIL</th>
					<th>TELEPON</th>
					<th class="text-center">AKSI</th>
				</thead>
				<tbody class="bg-white" id="load-users">
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- BEGIN MODAL ADD USERS -->
<div class="modal fade" id="modal-add">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">FORMULIR ENTRY USERS</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<form class="form-horizontal" id="form-add" action="javascript:;">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-7">
							<label for="">Username <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="username" placeholder=" contoh (exam_28*hits)" autocomplete="off">
							<small class="text-danger error-username"></small>
						</div>
						<div class="col-md-5">
							<label for="">User Access <span class="text-danger">*</span></label>
							<select id="access"></select>
							<small class="text-danger error-access"></small>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label for="">Telepon <span class="text-danger">*</span></label>
							<input type="text" class="form-control" autocomplete="off" id="telepon" placeholder="089665906380">
							<small class="text-danger error-telepon"></small>
						</div>
						<div class="col-md-5">
							<label for="">Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control" autocomplete="off" id="email" placeholder="example@gmail.com">
							<small class="text-danger error-email"></small>
						</div>
						<div class="col-md-4">
							<label for="">Password <span class="text-danger">*</span></label>
							<input type="password" autocomplete="off" class="form-control" id="password" placeholder="password">
							<small class="text-danger error-password"></small>
						</div>
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
<!-- END MODAL ADD USERS -->

<!-- BEGIN MODAL LIST ACCESS -->
<div class="modal fade" id="modal-list-access">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">DAFTAR LIST AKSES MANAGER</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-danger" id="add-access">
							<i class="fa fa-plus-circle"></i> Buat Akses
						</button>
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<input type="text" class="form-control" id="input-access" placeholder="Ketik pencarian access disini...." autofocus autocomplete="off">
							<div class="input-group-btn">
								<button type="button" class="btn btn-dark" id="btn-search-access">
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
								<thead>
									<tr>
										<th class="text-center">NO</th>
										<th>NAMA AKSES</th>
										<th>DESKRIPSI</th>
										<th>AKSI</th>
									</tr>
								</thead>
								<tbody class="bg-white" id="load-access">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal" id="btn-close-access">
					Keluar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL LIST ACCESS -->

<!-- BEGIN VIEW USERS ACCESS -->
<div class="modal fade" id="modal-view-users">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">DETAIL AKSES <span id="detail-name"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="user_id" class="control-label col-sm-3">USER ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="user_id" disabled>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="v_username" class="control-label col-sm-3">USERNAME</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="v_username" disabled>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="v_email" class="control-label col-sm-3">EMAIL</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="v_email" disabled>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="v_telepon" class="control-label col-sm-3">TELEPON</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="v_telepon" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-close-view">
					Keluar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- END VIEW ACCESS -->

<!-- BEGIN EDIT USERS -->
<div class="modal fade" id="modal-edit-users">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">EDIT DATA <span id="edit-detail-name"></span></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="user_id" class="control-label col-sm-3">USER ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="e_user_id" disabled>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="e_username" class="control-label col-sm-3">
								USERNAME <span class="text-danger">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="e_username">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="e_email" class="control-label col-sm-3">
								EMAIL <span class="text-danger">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="e_email">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="e_telepon" class="control-label col-sm-3">
								TELEPON <span class="text-danger">*</span>
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="e_telepon">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label for="e_akses" class="control-label col-sm-3">AKSES</label>
							<div class="col-sm-9">
								<div class="switch-button switch-button-danger">
                                    <input type="checkbox" checked="" name="switch18" id="switch18">
                                    <span><label for="switch18"></label></span>
                                </div>
							</div>
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
<!-- END EDIT USERS -->

<!-- BEGIN DELETE USERS -->
<div class="modal fade" id="modal-delete-users">
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
						<i><b>Apakah anda yakin akan menghapus user <span class="delete-title text-danger"></span> ?</b></i>
					</div>
					<div class="col-md-12">
						<div id="error-delete"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal" id="btn-close-delete">
					Batalkan
				</button>
				<button type="button" class="btn btn-danger" id="btn-delete-users">YA, HAPUS</button>
			</div>
		</div>
	</div>
</div>
<!-- END DELETE USERS -->

<script src="<?=site_url('assets/sites/simmas-users.js')?>"></script>
<script type="text/javascript">
	SimmasUsers.baseUrl = "<?=site_url()?>";
	SimmasUsers.init();
</script>