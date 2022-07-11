<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <p class="text-uppercase text-sm">{{ $studyCase['case_name'] }}</p>

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
              <option value="7">7 - Satu elemen 3mutlak penting dari elemen lainnya</option>
            </select>
          </div>

          <div class="col-2">
            <label>Setting</label> <br>
            <button class="btn btn-primary" id="btn-setting">Setting</button>
          </div>

        </div>

        <div class="row mt-4">
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


        <hr>
        Status
        <div class="alert alert-secondary text-white" role="alert" id="summary-alert">
          Belum Dilakukan Perhitungan
        </div>


      </div>
    </div>
  </div>
</div>