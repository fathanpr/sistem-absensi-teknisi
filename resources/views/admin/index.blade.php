@extends('table')
@section('title','Daftar Absensi Teknisi')
@section('link')
    <a class="dropdown-item" href="{{ route('admin.progress') }}">Overview Progress Teknisi</a>
@endsection
@section('content')
<div class="container my-5">
    <div class="konten">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <h1>Detail Absen Teknisi</h1>
                    <p>{{$tanggal}}<p>
                    <form action="/admin" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" name="nama_lengkap">
                                @foreach ($nama as $item)
                                <option value="{{ $item->nama_lengkap }}" {{ Request::get('nama_lengkap') == $item->nama_lengkap ? 'selected':'' }}>{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex justify-content-start">
                            <input type="date" aria-label="First name" class="form-control" id="created_at" name="created_at" value="{{ Request::get('created_at') ?? date('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary filter"><i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-6">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="{{ route('admin') }}" class="btn btn-success">Lihat Semua Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> Kondisi mesin berhasil diubah.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="shadow-5-strong rounded-5 overflow-auto">
        <table class="table align-middle mb-0 bg-white" id="myTable">
            <thead class="bg-primary bg-gradient text-light fw-bold">
                <tr>
                    <th style="width: 200px">TANGGAL</th>
                    <th style="width: 200px">NAMA</th>
                    <th style="width: 200px" class="text-center">ID MESIN</th>
                    <th style="width: 200px" class="text-center">LOKASI</th>
                    <th style="width: 200px" class="text-center">WAKTU</th>
                    <th style="width: 200px">KETERANGAN</th>
                    <th style="width: 200px" class="text-center">FOTO</th>
                    <th class="text-center">STATUS</th>
                </tr>
            </thead>
            <tbody id="data">
                @foreach($datas as $data)
                <tr>
                    <td>
                        <p>{{Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMM Y') ?? '' }}</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="fw-bold mb-0" style="width: 150px">{{ $data->user->nama_lengkap }}</p>
                                <i class="fab fa-whatsapp text-primary"></i><a href="https://wa.me/{{ $data->user->no_telp }}" target="_blank"> Hubungi Teknisi</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <p>{{ $data->atm->kode_mesin }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ $data->atm->nama_atm }}</p>
                        <div style="width:180;height:180;">
                            <iframe src="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}&hl=es;z=14&output=embed" frameborder="0"></iframe>
                        </div>
                    </td>
                    <td>
                        <p>{{Carbon\Carbon::parse($data->created_at)->format('H:i') ?? '' }} WIB</p>
                    </td>
                    <td>
                        {{ $data->keterangan }}
                    </td>
                    <td class="text-center">

                        <a data-fancybox data-src="storage/uploads/{{$data->foto}}" data-caption="{{ $data->foto}}">
                            <img src="storage/uploads/{{$data->foto}}" width="100" height="100"/>
                          </a>
                        {{-- <a href="storage/uploads/{{$data->foto}}" data-lightbox="image-1" data-title="My caption">
                            <img src="storage/uploads/{{$data->foto}}" class="rounded" alt="" style="width: 100px; height: 100px" />
                        </a> --}}
                    </td>
                    <td style="width: 200px" class="text-center">
                        @if($data->kondisi_mesin == 'Menunggu Tindakan')
                        <button type="button" class="btn btn-warning btn-rounded mb-2">MENUNGGU TINDAKAN</button>
                        <a href="{{  route('ubahstatus',$data->id) }}" method="POST">Ubah Status</a>
                        @else
                        <button type="button" class="btn btn-success btn-rounded mb-2">SELESAI</button>
                        <a href="{{  route('ubahstatus',$data->id) }}" method="POST">Ubah Status</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="showImage" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <center>
                    <div id="resultImage">
                    </div>
                </center>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <div class="tombol-close">
                                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <h2><b>Apakah anda yakin untuk mengubah status ?</b></h2>
                    <p>Jangan ubah status apabila teknisi belum melakukan tindakan!</p>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="tombols">
                                <input type="hidden" name="id" id="id" class="form-control">
                                <input type="hidden" name="kondisi_mesin" id="kondisi_mesin" class="form-control">
                                <button type="button" class="btn btn-success tombol-update">Ubah Status</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
@endsection
