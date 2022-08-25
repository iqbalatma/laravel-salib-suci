<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <p class="text-uppercase text-sm">Nama Study Case : {{ $studyCase['case_name'] }}</p>
        <p class="text-uppercase text-sm d-none" id="studyCaseId">{{ $studyCase['id'] }}</p>


        <div class="row">
          <div class="col-3">
            <label for="">Baris</label>
            <select class="form-select" aria-label="Default select example" id="select-row">
              <option selected value>Pilih Kriteria Baris</option>
              @foreach ( $studyCase->criteria as $item)
              <option value="{{ $item->id }}">{{ $item->criteria_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-3">
            <label for="">Kolom</label>
            <select class="form-select" aria-label="Default select example" id="select-column">
              <option selected value>Pilih Kriteria Kolom</option>
              @foreach ( $studyCase->criteria as $item)
              <option value="{{ $item->id }}">{{ $item->criteria_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-4">
            <label for="">Nilai Antar Kriteria</label>
            <select class="form-select" aria-label="Default select example" id="select-criteria-pair-value">
              <option selected value>Open this select menu</option>
              <option value="1">1 - Kedua Nilai Sama Pentingnya</option>
              <option value="2">2 - Nilai-nilai intermediate</option>
              <option value="3">3 - Elemen yang satu sedikit lebih penting dari elemen lainnya</option>
              <option value="4">4 - Nilai-nilai intermediate</option>
              <option value="5">5 - Elemen yang satu lebih penting dari elemen lainnya</option>
              <option value="6">6 - Nilai-nilai intermediate</option>
              <option value="7">7 - Satu elemen jelas lebih mutlak penting dari elemen lainnya</option>
              <option value="8">8 - Nilai-nilai intermediate</option>
              <option value="9">9 - Satu elemen 3mutlak penting dari elemen lainnya</option>
            </select>
          </div>

          <div class="col-2">
            <label>Setting</label> <br>
            <button class="btn btn-primary" id="btn-setting">Setting</button>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table table-striped" id="table-criteria">
                <thead>
                  <tr>
                    <td class="table-primary"> <b>Nama Kriteria</b> </td>
                    @foreach ( $studyCase->criteria as $item)
                    <td>{{ $item->criteria_name }}</td>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $studyCase->criteria as $item)
                  <tr>
                    <td>{{ $item->criteria_name }}</td>
                    @foreach ($studyCase->criteria as $itemKolom)
                    <td id="baris{{ $item->id }}-kolom{{ $itemKolom->id }}">1</td>
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-3">
            <button class="btn btn-primary" id="btn-calculate">Calculate</button>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <p class="text-uppercase text-sm">Rangkuman</p>

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table ">
                <thead>
                  <tr>
                    <th>Intensitas Kepentingan</th>
                    <th>Definisi</th>
                  </tr>
                  <tr>
                    <td class="text-center">1</td>
                    <td>Sama pentingnya dibanding dengan yang lain</td>
                  </tr>
                  <tr>
                    <td class="text-center">3</td>
                    <td>Sedikit lebih penting dibanding yang lain</td>
                  </tr>
                  <tr>
                    <td class="text-center">5</td>
                    <td>Cukup penting dibanding yang lain</td>
                  </tr>
                  <tr>
                    <td class="text-center">7</td>
                    <td>Sangat Penting dibanding dengan yang lain</td>
                  </tr>
                  <tr>
                    <td class="text-center">9</td>
                    <td>Ekstrim pentingnya dibanding dengan yang lain</td>
                  </tr>
                  <tr>
                    <td class="text-center">2,4,6,8</td>
                    <td>Nilai diantara dua penilaian yang berdekatan</td>
                  </tr>
                  <tr>
                    <td class="text-center">Resiprokal</td>
                    <td>Jika elemen i memiliki salah satu angka di atas <br>
                      dibandingkan elemen j, maka j memiliki nilai <br>
                      kebalikannya ketika dibandingkan dengan i</td>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

        <div class=" row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Consistency Index</th>
                    <th id="ci">-</th>
                  </tr>
                  <tr>
                    <th scope="col">Random Index</th>
                    <th id="ri">-</th>
                  </tr>
                  <tr>
                    <th scope="col">Consistency Ratio</th>
                    <th id="cr">-</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <hr>
        Status
        <div class="alert alert-secondary text-white" role="alert" id="summary-alert">
          Belum Dilakukan Perhitungan
        </div>


      </div>
    </div>
  </div>
</div>