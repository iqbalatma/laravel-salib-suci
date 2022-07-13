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
              <p class="text-uppercase text-sm">Daftar Studi Kasus</p>
              <table class="table">
                <thead>
                  <tr>
                    <td scope="col">Nama Guru</td>
                    <td scope="col">Total</td>
                    <td scope="col">Rank</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ranks as $item)
                  <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->rank }} </td>
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