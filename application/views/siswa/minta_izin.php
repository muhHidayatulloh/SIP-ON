<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <form action="<?= base_url('siswa/mintaizin') ?>" method="post" enctype="multipart/form-data">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="far fa-envelope mr-2"></i> Tulis Surat Izin</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group col-5">
                            <label for="date">To Date</label>
                            <input id="date" class="form-control" type="date" name="to_date" value="<?= $to_date; ?>" readonly>
                        </div>
                        <div class="form-group col-5">
                            <input class="form-control" placeholder="To:" value="To Wali Kelas : <?= $nama_walikelas; ?>" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label for="subject">Keterangan</label>
                            <select name="subject" id="subject" class="form-control">
                                <option value="1">Izin</option>
                                <option value="2">Sakit</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="compose-textarea">Catatan</label>
                            <textarea id="compose-textarea" class="form-control" style="height: 300px;" name="catatan">
                                
                            </textarea>
                        </div>
                        <div class="form-group">
                                <label for="file"><i class="fas fa-paperclip"></i> Wajib Upload Bukti</label>
                                <input type="file" name="bukti" id="file" class="form-control" required>                        
                            <p class="help-block mt-2">Max. 5MB | format : jpeg, jpg, png, pdf, doc, docx</p>
                            <p class="help-block"><i class="fas text-danger">*</i> Bukti yang dikirim boleh berupa : </p>
                            <p class="help-block"><i class="fas text-danger">-</i> foto</p>
                            <p class="help-block"><i class="fas text-danger">-</i> dokumen scan</p>
                            <p class="help-block"><i class="fas text-danger">-</i> soft file yang bertanda tangan digital</p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" name="kirim"><i class="far fa-envelope"></i> Send</button>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                </form>
            </div>
        </div>
    </div>
</section>

<!-- style text editor pada textarea -->
<script>
    $(function() {
        //Add text editor
        $('#compose-textarea').summernote()
    })
</script>

