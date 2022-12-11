@extends('table')
@section('title','Daftar Absensi Teknisi')
@section('content')
<div class="container my-5">
    <div class="konten">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                            FILTER NAMA
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">NAMA 1</a></li>
                            <li><a class="dropdown-item" href="#">NAMA 2</a></li>
                            <li><a class="dropdown-item" href="#">NAMA 3</a></li>
                        </ul>
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                            FILTER TANGGAL
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">HARI INI</a></li>
                            <li><a class="dropdown-item" href="#">KEMARIN</a></li>
                            <li><a class="dropdown-item" href="#">7 HARI YANG LALU</a></li>
                        </ul>
                        <button type="button" class="btn btn-success">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="unduh-pdf">
                        <button type="button" class="btn btn-danger">
                            <i class="fas fa-download mr-2"></i> UNDUH PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow-5-strong rounded-5 overflow-auto">
        <table class="table align-middle mb-0 bg-white" id="myTable">
            <thead class="bg-primary bg-gradient text-light fw-bold">
                <tr>
                    <th style="width: 200px">NAMA</th>
                    <th style="width: 200px" class="text-center">ID MESIN</th>
                    <th style="width: 200px" class="text-center">LOKASI</th>
                    <th style="width: 200px">WAKTU</th>
                    <th style="width: 200px">KETERANGAN</th>
                    <th style="width: 200px" class="text-center">FOTO</th>
                    <th class="text-center">STATUS</th>
                </tr>
            </thead>
            <tbody id="data">
                {{-- @foreach($datas as $data) --}}
                {{-- <tr> --}}
                    {{-- <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="fw-bold mb-0" style="width: 150px">{{ $data->user->nama_lengkap }}</p>
                                <i class="fab fa-whatsapp text-primary"></i><a href="https://wa.me/{{ $data->user->no_telp }}" target="_blank"> Hubungi Teknisi</a>
                            </div>
                        </div>
                    </td> --}}
                    {{-- <td class="text-center">
                        <p>{{ $data->atm->kode_mesin }}</p>
                    </td> --}}
                    {{-- <td class="text-center">
                        <p>{{ $data->atm->nama_atm }}</p>
                        <div style="width:180;height:180;">
                            <iframe src="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}&hl=es;z=14&output=embed" frameborder="0"></iframe>
                        </div>
                    </td> --}}
                    {{-- <td>
                        <p>{{Carbon\Carbon::parse($data->created_at)->format('H:i') ?? '' }} WIB</p>
                    </td> --}}
                    {{-- <td>
                        {{ $data->keterangan }}
                    </td> --}}
                    {{-- <td class="text-center">
                        <img src="storage/uploads/{{ $data->foto }}" class="rounded" alt="" style="width: 100px; height: 100px" />
                        <a href="#" data-id="{{ $data->id }}" bs-toggle="modal" data-bs-target="#showImage" class="lihat-gambar">Lihat Gambar</a>
                    </td> --}}
                    {{-- <td style="width: 200px" class="text-center">
                        @if($data->kondisi_mesin == 'Menunggu Tindakan')
                        <button type="button" class="btn btn-warning btn-rounded mb-2">Perlu Tindakan</button>
                        @elseif($data->kondisi_mesin == 'Selesai')
                        <button type="button" class="btn btn-success btn-rounded mb-2">SELESAI</button>
                        @else
                        @endif
                        <a href="#" data-id="{{ $data->id }}" class="ubah-status">Ubah status</a>
                    </td> --}}
                {{-- </tr> --}}
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="showImage" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                    <div id="resultImage">
                    </div>
                </center>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- Modal Ubah Status -->
{{-- <form action="{{ route('updatestatus', $data->id) }}" method="post"> --}}
<form action="" method="post">
    @csrf
    @method('put')
    <div class="modal" id="ubahStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <input type="hidden" name="kondisi_mesin" id="kondisi_mesin" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary tombol-update">Ubah Status</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
