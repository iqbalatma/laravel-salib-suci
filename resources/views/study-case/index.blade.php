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
        <div class="col-md-8">
          <x-alert></x-alert>
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
                      <div class="row">
                        <div class="col-4">
                          <a href="{{ route('criteria.show', $item['id']) }}" class="btn btn-success">Detail</a>
                        </div>
                        @if (!count($item->criteria))
                        <div class="col-4">
                          <form action="{{ route('studycase.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                        @endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p class="text-uppercase text-sm">Buat Studi Kasus</p>
              <form method="POST" action="{{ route('studycase.store') }}">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Studi Kasus</label>
                  <input type="text" class="form-control" placeholder="Masukkan nama studi kasus" name="case_name" required>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-app-layout>