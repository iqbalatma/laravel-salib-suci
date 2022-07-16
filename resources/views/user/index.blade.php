<x-app-layout :title="$title">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Data Guru</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 ms-3">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Lahir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Hp</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Sekolah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenjang</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Golongan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sertifikasi</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teacherDetails as $item )
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $alamat = $item->teacherDetails->alamat??'' }}
                        @if ($alamat == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      @php
                      $jenis_kel = $item->teacherDetails->jenis_kel??'';
                      if ($jenis_kel==1) {
                      echo '<span class="badge badge-sm bg-gradient-success">
                        Laki-laki
                      </span>';
                      }else if ($jenis_kel ==0) {
                      echo '<span class="badge badge-sm bg-gradient-secondary">
                        Perempuan
                      </span>';
                      }else {
                      echo '<span class="text-secondary text-xs font-weight-bold">
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                      </span>';
                      }
                      @endphp

                    </td>
                    <td class="align-middle text-center">

                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $tempat_lhr = $item->teacherDetails->tempat_lhr??'' }}
                        @if ($tempat_lhr == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $tanggal_lhr = $item->teacherDetails->tanggal_lhr??'' }}
                        @if ($tanggal_lhr == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $no_hp = $item->teacherDetails->no_hp??'' }}
                        @if ($no_hp == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $id_sekolah = $item->teacherDetails->id_sekolah??'' }}
                        @if ($id_sekolah == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $jenjang = $item->teacherDetails->jenjang??'' }}
                        @if ($jenjang == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $golongan = $item->teacherDetails->golongan??'' }}
                        @if ($golongan == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $sertifikasi =$item->teacherDetails->sertifikasi??'' }}
                        @if ($sertifikasi == '')
                        <i class="fa fa-exclamation-triangle text-danger text-sm opacity-10" aria-hidden="true"></i>
                        @endif
                      </span>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</x-app-layout>