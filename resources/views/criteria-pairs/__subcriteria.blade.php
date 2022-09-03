<div class="row mt-4 d-none" id="sub-criteria">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <p class="text-uppercase text-sm">Result</p>
        <div class="row">
          <div class="col-3">
            <label for="">Nama Alternatif</label>
            <select class="form-select" aria-label="Default select example" id="select-row-alternative">
              <option selected value>Pilih Nama Alternatif</option>
              @foreach ( $alternative as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-3">
            <label for="">Kriteria</label>
            <select class="form-select" aria-label="Default select example" id="select-column-criteria">
              <option selected value>Pilih Nama Kriteria</option>
              @foreach ( $studyCase->criteria as $item)
              <option value="{{ $item->id }}">{{ $item->criteria_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-4">
            <label for="">Nilai Kriteria</label>
            <select class="form-select" aria-label="Default select example" id="select-criteria-value">
              <option selected value>Pilih Nilai Kriteria</option>
              <option value="Sangat Baik">1 - Sangat Baik</option>
              <option value="Baik">2 - Baik</option>
              <option value="Cukup">3 - Cukup</option>
              <option value="Kurang">4 - Kurang</option>
            </select>
          </div>
          <div class="col-2">
            <label>Setting</label>
            <br>
            <button class="btn btn-primary" id="btn-setting-kriteria-value">Setting</button>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-criteria-alternative">
                <thead>
                  <tr>
                    <th rowspan="2" class="text-center align-middle">ID</th>
                    <th rowspan="2" class="text-center align-middle">Nama Alternatif</th>
                    <th colspan="{{ sizeOf($studyCase->criteria) }}" class="text-center align-middle">Kriteria</th>
                  </tr>
                  <tr>
                    @foreach ($studyCase->criteria as $item)
                    <th>{{ $item->criteria_name }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($alternative as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    @foreach ($studyCase->criteria as $itemCriteria)
                    <td id="baris-subcriteria{{ $item->id }}-kolom-subcriteria{{ $itemCriteria->id }}"></td>
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
            <button class="btn btn-primary" id="btn-rank">Perankingan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <p class="text-uppercase text-sm">Perankingan</p>
        <div class="row mt-4">
          <div class="col">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-rank">
                <thead>
                  <tr>
                    <th>Nama Alternatif</th>
                    <th>Jumlah Bobot</th>
                    <th>Ranking</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($alternative as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <p id="summary-text" class="d-none">
                Berdasarkan hasil perhitungan dan perankingan studi kasus <b>{{ $studyCase['case_name'] }}</b>, maka dapat disimpulkan bahwa <b id="highest-alternative">
                  {alternative}
                </b> memiliki nilai tertinggi dengan total
                <b id="highest-value">{total_tertinggi}</b> dan <b id="lowest-alternative">{alternative_terendah}</b> memiliki nilai terendah dengan total <b id="lowest-value">{total terendah}</b>
              </p>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>