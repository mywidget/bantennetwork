<form id="formmember">
	<input type="hidden" value="<?=encrypt_url($arr->id_user);?>" class="form-control" id="id" name="id">
	<input type="hidden" value="edit" class="form-control" id="type" name="type">
	
	<div class="row">
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group">
					<label for="mail">Email</label>
					<input type="email" name="mail" value="<?=$arr->email;?>" class="form-control" id="mail" placeholder="Email" required="" readonly>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="title">Nama Lengkap</label>
					<input type="text" name="title" value="<?=$arr->nama_lengkap;?>" class="form-control" id="title" placeholder="Nama Lengkap" required="">
				</div>
				<div class="form-group">
					<label for="daftar">TGL. Daftar </label>
					<input type="date" name="daftar" value="<?=tgl_exp($arr->tgl_daftar);?>" class="form-control dpd1"  id="daftar">
				</div>
				<div class="form-group">
					<label for="phone">No. Handphone</label>
					<input type="text" name="phone" value="<?=$arr->no_hp;?>" class="form-control" id="phone" placeholder="No. Handphone">
				</div>
				
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<input type="text" name="alamat" value="<?=$arr->alamat;?>" class="form-control" id="alamat" placeholder="Alamat Percetakan">
				</div>
				
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="card-block">
				<div class="over-user" style="max-height:300px;overflow:auto">
					<div class="form-group">
						<label for="profit">Menu Akses</label>
					</div>
					<input id="selectAll" type="checkbox" checked> <label for='selectAll'> Select All</label>
					<!-- text input -->
					<?php
						
						if($this->session->g_level=="admin") {
							$resultz = $this->db->query("SELECT * FROM menuadmin where aktif='Y' order by urutan");
						}
						
						foreach($resultz->result_array() AS $rowz) {
							$dataTz[$rowz['idparent']][] = $rowz;
						}
						echo checkcard($dataTz,0,$rowz['idparent'],$arr->idmenu);
					?>
				</div>
				
				<div class="form-group">
					<label>Level Akses</label>
					<select name='id_level' class="form-control custom-select">
						<?php
							if($arr->level=="admin") {
								$tampil=$this->db->query("SELECT * FROM hak_akses");
								foreach($tampil->result_array() AS $we){
									if ($arr->id_level==$we['id_level']){
									echo "<option value=$we[id_level] selected>$we[nama]</option>";
									}else{
									echo "<option value=$we[id_level]>$we[nama]</option>"; 
								}
							}
							}else{
							$tampil = $this->db->query("select * FROM hak_akses where id_level IN ($arr->idlevel)");
							if ($arr->id_level==0){
								echo "<option value=0 selected>Pilih Level Akses</option>"; 
							}
							foreach($tampil->result_array() AS $w){
								if ($arr->id_level==$w['id_level']){
								echo "<option value=$w[id_level] selected>$w[nama]</option>";}
								else{
								echo "<option value=$w[id_level]>$w[nama]</option>";}}
						}
						?>
					</select>
				</div>
				<div class="form-group"> 
					<div class="">
						<label>
							<?php if($arr->level=="admin") { ?>
								<input type="hidden" name="aktif" value="Y" checked>
								<?php }else{ ?>
								<?php if($arr->aktif=="Y") { ?>
									<input type="radio" name="aktif" id="optionsRadios1" value="N" class="minimal">
									aktif N
									<input type="radio" name="aktif" id="optionsRadios2" class="minimal" value="Y" checked>
									aktif Y
									<?php }else{ ?>
									<input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked>
									aktif N
									<input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
									aktif Y
									<?php 	}
								} ?>
						</label>
					</div>
				</div>
			</div>
		</div> 
	</div>
</form>