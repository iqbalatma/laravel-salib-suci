<x-app-layout :title="$title">
  <div class="container-fluid py-4">
    <div class="card shadow-lg mx-4">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset('argon-template/assets/img/team-1.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ Auth::user()->username }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{ Auth::user()->name }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <form action="{{ route('detail_guru.update') }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ Auth::id() }}">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" type="text" value="{{ Auth::user()->username }}" readonly name="username">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIK</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['nik_guru']??'' }}" name="nik_guru">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" value="{{ Auth::user()->email }}" name="email">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor HP</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['no_hp']??'' }}" name="no_hp">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Fullname</label>
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" name="name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Sekolah</label>
                    <select name="id_sekolah" id="" class="form-control">
                      <option value>-Silahkan Pilih Sekolah-</option>
                      @php
                      $idSekolah = $detailGuru['id_sekolah']??'';
                      @endphp
                      @foreach ($dataSekolah as $item)
                      <option value="{{ $item['id'] }}" @if ($item['id']==$idSekolah) selected @endif>{{ $item['nama_sekolah'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                    <select name="jenis_kel" id="" class="form-control">
                      @php
                      $jenisKelamin = $detailGuru['jenis_kel']??"";
                      @endphp
                      <option value="null">-Silahkan Pilih-</option>
                      <option value="1" @if ($jenisKelamin==1) selected @endif>Laki-laki</option>
                      <option value="0" @if ($jenisKelamin==0) selected @endif>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tempat Lahir</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['tempat_lhr']??'' }}" name="tempat_lhr">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['tanggal_lhr']??'' }}" name="tanggal_lhr">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Jenjang</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['jenjang']??'' }}" name="jenjang">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Golongan</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['golongan']??'' }}" name="golongan">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Sertifikasi</label>
                    <input class="form-control" type="text" value="{{ $detailGuru['sertifikasi']??'' }}" name="sertifikasi">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat</label>
                    <textarea class="form-control" name="alamat">{{ $detailGuru['alamat']??'' }}</textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-app-layout>