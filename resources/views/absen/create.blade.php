<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absen</title>
    <link rel="stylesheet" href="{{ asset('assets/css/absen.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body onload="getLocation()">

    @include('sweetalert::alert')

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
                                <form class="myForm" method="post" action="{{ route('absen.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-4">
                                        <span class="badge bg-primary rectangle-pill mb-2">ID Teknisi</span>
                                        <select class="form-select" name="user_id">
                                            @foreach($teknisis as $tk)
                                            <option value="{{ $tk->id }}">{{ $tk->nip_teknisi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge bg-primary rectangle-pill mb-2">Nama Teknisi</span>
                                        <select class="form-select" name="user_id">
                                            @foreach($teknisis as $tk)
                                            <option value="{{ $tk->id }}">{{ $tk->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="latitude" class="form-control">
                                        <input type="hidden" name="longitude" class="form-control">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <span class="badge bg-primary rectangle-pill mb-2">Tempat ATM</span>
                                        <select class="form-select" name="atm_id" aria-label="Default select example">
                                            @foreach($atms as $atm)
                                            <option value="{{ $atm->id }}">{{ $atm->nama_atm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <span class="badge bg-primary rectangle-pill mb-2">Status ATM</span>
                                        <select class="form-select" name="kondisi_mesin" aria-label="Default select example">
                                            <option value="Menunggu Tindakan">Menunggu Tindakan</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge bg-primary rectangle-pill mb-2">Keterangan</span>
                                        <textarea class="form-control" placeholder="Keterangan.." style="height: 100px" name="keterangan" required></textarea>
                                    </div>
                                    <span class="badge bg-primary rectangle-pill mb-2">Upload Foto Bukti</span>
                                    <div class="input-group mb-3">
                                        <input type="file" name="foto" class="form-control" id="inputGroupFile01" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" style="width:100%;height:50px;">ABSEN</button>
                                            <a href="{{ route('logout') }}" class="btn btn-danger mt-3" style="width:100%;height:50px;">LOGOUT</a>
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
                                    <p class="tanggal">{{ $tanggal }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center">
                        <div class="card-bg1 mb-5">
                            <ol class="list-group list-group-numbered">
                                @foreach($absens as $data)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $data->atm->nama_atm }}</div>
                                        ID MESIN : {{ $data->atm->kode_mesin }}
                                        <br>
                                        <span>Waktu : {{Carbon\Carbon::parse($data->created_at)->format('H:i') ?? '' }} WIB</span>
                                        <br>
                                        Keterangan : {{ $data->keterangan }}
                                    </div>

                                    @if($data->kondisi_mesin == 'Menunggu Tindakan')
                                        <span class="badge bg-warning rounded-pill mt-4">Menunggu Tindakan</span>
                                    @elseif($data->kondisi_mesin == 'Selesai')
                                        <span class="badge bg-success rounded-pill mt-4">SELESAI</span>
                                    @else
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
