<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absen</title>
    <link rel="stylesheet" href="{{ asset('assets/css/absen.css') }}">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <section class="form-absen">
      <div class="container">
          <div class="row d-flex justify-content-center">
              <div class="col-md-12">
                  <div class="row d-flex justify-content-center">
                      <div class="col-md-4 d-flex justify-content-center">
                          <div class="text-card-bg">
                              <h2 class="mt-1">Form Absen</h2>
                          </div>
                      </div>
                      <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                          <form>
                            <div class="mb-3 mt-4">
                              <span class="badge bg-primary rectangle-pill mb-2">Nama Teknisi</span>
                              <select class="form-select" aria-label="Default select example">
                                <option selected>Nama Teknisi Login</option>
                                <option value="1">Pengganti</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <span class="badge bg-primary rectangle-pill mb-2">Lokasi ATM</span>
                              <select class="form-select" aria-label="Default select example">
                                <option selected>Lokasi ATM</option>
                                <option value="1">Tempat</option>
                              </select>
                            </div>
                            <div class="mb-3 mt-3">
                              <span class="badge bg-primary rectangle-pill mb-2">Status ATM</span>
                              <select class="form-select" aria-label="Default select example">
                                <option selected>Selesai</option>
                                <option value="1">Menunggu Tindakan</option>
                              </select>
                            </div>
                            {{-- <div class="row">
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <span class="badge bg-primary rectangle-pill mb-2">LONGITUDE</span>
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <span class="badge bg-primary rectangle-pill mb-2">LATITUDE</span>
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                              </div>
                            </div> --}}
                            <div class="form-floating mb-3">
                              <span class="badge bg-primary rectangle-pill mb-2">Keterangan</span>
                              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>
                            <span class="badge bg-primary rectangle-pill mb-2">Upload Foto Bukti</span>
                            <div class="input-group mb-3">
                              <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="width:100%;height:50px;">ABSEN</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <hr>
    
    <section class="progress-data">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-8">
              <div class="row d-flex justify-content-center">
                <div class="col-md-8 d-flex justify-content-center">
                    <div class="text-card-bg">
                        <h2 class="mt-1">Progress Kerja</h1>
                        <p class="tanggal">Sabtu, 1 Desember 2022</p>
                    </div>
                </div>
            </div>
          </div> 
          <div class="row d-flex justify-content-center">
            <div class="col-md-8 d-flex justify-content-center">
                <div class="card-bg1 mb-5">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="ms-2 me-auto">
                            <div class="fw-bold">ATM Galuh Mas</div>
                            ID MESIN : 09248559248842
                            <br>
                            <span>Waktu : 10.54 WIB</span>
                            <br>
                            Keterangan : asmfiamsfasfamsfaskf,,,,,
                          </div>
                          <span class="badge bg-primary rounded-pill mt-4">SELESAI</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="ms-2 me-auto">
                            <div class="fw-bold">ATM Johar</div>
                            ID MESIN : 09248559248842
                            <br>
                            Keterangan : asmfiamsfasfamsfaskf,,,,,
                          </div>
                          <span class="badge bg-primary rounded-pill mt-4">SELESAI</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="ms-2 me-auto">
                            <div class="fw-bold">ATM Nagasari</div>
                            ID MESIN : 09248559248842
                            <br>
                            Keterangan : asmfiamsfasfamsfaskf,,,,,
                          </div>
                          <span class="badge bg-warning rounded-pill mt-4">MENUNGGU TINDAKAN</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="ms-2 me-auto">
                            <div class="fw-bold">ATM Teluk Jambe</div>
                            ID MESIN : 09248559248842
                            <br>
                            Keterangan : asmfiamsfasfamsfaskf,,,,,
                          </div>
                          <span class="badge bg-warning rounded-pill mt-4">MENUNGGU TINDAKAN</span>
                        </li>
                      </ol>
                </div>
            </div>
        </div>
          </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>