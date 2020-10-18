  <form action="" method="POST" autocomplete="off" id="form-edit">
      @method('put')
      @csrf
      <div class="form-group">
          <input type="hidden" value="{{ $kategori->id }}" id="id_data" name="'id">
      </div>
      <div class="form-group {{ $errors->has('nama') ? ' has->error ' : '' }}">
          <label for="nama">Nama :</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kategori" value="{{ $kategori->nama }}">

          @if($errors->has('nama'))
          <span class=" help-block">{{ $errors->first('nama') }}</span>
          @endif
      </div>
      <div class="form-group {{ $errors->has('kode') ? ' has->error ' : '' }}">
          <label for="kode">Kode :</label>
          <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Kategori" value="{{ $kategori->kode }}">

          @if($errors->has('kode'))
          <span class=" help-block">{{ $errors->first('kode') }}</span>
          @endif
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-ubah">UBAH</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
  </form>
  </div>