<x-app-layout :title="$title">
  <div class="container-fluid py-4">
    <div class="row">
      {{-- COL1 --}}
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Guru</p>
                  <h5 class="font-weight-bolder">
                    {{ count($teachers) }} orang
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- COL2 --}}
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Sekolah</p>
                  <h5 class="font-weight-bolder">
                    {{ count($school) }} Sekolah
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <i class="fa fa-building" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- COL3 --}}
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Studi Kasus</p>
                  <h5 class="font-weight-bolder">
                    {{ count($studyCase) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <i class="fa fa-list-ul" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <p class="text-uppercase text-sm">Daftar Studi Kasus</p>
            <table class="table">
              <thead>
                <tr>
                  <td scope="col">Nama Studi Kasus</td>
                  <td scope="col">Tanggal</td>
                  <td scope="col">Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach ($studyCase as $item)
                <tr>
                  <td>{{ $item['case_name'] }}</td>
                  <td>{{ $item['created_at'] }}</td>
                  <td>
                    <a href="{{ route('ranks.detail', $item['id']) }}" class="btn btn-success">Detail</a>
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
</x-app-layout>