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
          <div class="card">
            <div class="card-body">
              <p class="text-uppercase text-sm">{{ $studyCase['case_name'] }}</p>


              <div class="row">
                <div class="col">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($studyCase->criteria as $item)
                      <tr>
                        <td>{{ $item['criteria_name'] }}</td>
                        <td>
                          <a href="{{ route('criteria.destroy', [$item['id'],$studyCase['id']]) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table class="table">
                            <form action="{{ route('subcriteria.update') }}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="criteria_id" value="{{ $item['id'] }}">
                              <input type="hidden" name="id_studyCase" value="{{ $studyCase['id'] }}">
                              <tr>
                                <td><input class="form-control" type="text" id="" value="{{ $item->subcriteria[0]['very_good']??"" }}" placeholder="Masukkan syarat kriteria" name="very_good"></td>
                                <td>Sangat Baik</td>
                              </tr>
                              <tr>
                                <td><input class="form-control" type="text" id="" value="{{ $item->subcriteria[0]['good']??"" }}" placeholder="Masukkan syarat kriteria" name="good"></td>
                                <td>Baik</td>
                              </tr>
                              <tr>
                                <td><input class="form-control" type="text" id="" value="{{ $item->subcriteria[0]['enough']??"" }}" placeholder="Masukkan syarat kriteria" name="enough"></td>
                                <td>Cukup</td>
                              </tr>
                              <tr>
                                <td><input class="form-control" type="text" id="" value="{{ $item->subcriteria[0]['less']??"" }}" placeholder="Masukkan syarat kriteria" name="less"></td>
                                <td>Kurang</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-success" type="submit">Update</button>
                                </td>
                              </tr>
                              <tr>
                              </tr>
                            </form>
                          </table>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>


              <form action="{{ route('criteriapair.show') }}" method="POST">
                @csrf
                <input type="hidden" name="studyCaseId" value="{{ $studyCase['id'] }}">
                <div class="row">
                  <div class="col">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Guru</th>
                          <th>Status Keikutsertaan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($alternative as $item)
                        <tr>
                          <td>
                            {{ $item->name }}
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="idAlternative[]" value="{{ $item->id }}" id="flexCheckChecked">
                              <label class="form-check-label" for="flexCheckChecked">
                              </label>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-primary">Next</button>
                  </div>
                </div>
              </form>




            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p class="text-uppercase text-sm">Tambah Kriteria</p>
              <form method="POST" action="{{ route('criteria.store') }}">
                @csrf
                <input type="hidden" name="id_studyCase" value="{{ $studyCase['id'] }}">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Kriteria</label>
                  <input type="text" class="form-control" placeholder="Masukkan nama studi kasus" name="criteria_name">
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