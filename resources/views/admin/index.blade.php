@extends('table')
@section('title','Daftar Absensi Teknisi')
@section('content')
<div class="container my-5">
    <div class="konten">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <form action="{{ route('admin') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" id="nama_lengkap" name="nama_lengkap">
                                @foreach ($nama as $item)
                                <option value="{{ $item->nama_lengkap }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex justify-content-start">
                            <input type="date" aria-label="First name" class="form-control" id="created_at" name="created_at">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" name="filter" id="filter"><i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>
                </div>
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
    $('#data').load().destroy();
    $(document).ready(function(){
    $('#filter').on('click', function(){
        var nama_lengkap = $('#nama_lengkap').val();
        var created_at = $('created_at').val();
        $.ajax({
            url : "/admin",
            type: "GET",
            data: {
                'nama_lengkap':nama_lengkap,
                'created_at':created_at
            },
            success:function(data){
                $('#data').html('')
                $.each(data, function (key, val) {

                var tanggal = new Date(val.created_at);
                const yyyy = tanggal.getFullYear();
                let mm = tanggal.getMonth() + 1; // Months start at 0!
                let dd = tanggal.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;
                const formattedToday = dd + '/' + mm + '/' + yyyy;

                $('#data').append(
                    "<tr>" +
                    "<td>" +
                    "<p>" + formattedToday + "</p>" +
                    "</td>" +
                    "<td>" +
                    "<div class='d-flex align-items-center'>" +
                    "<div class='ms-3 >" +
                    "<p class='fw-bold mb-0' style='width:150px'>" + val.nama_lengkap + "</p>" +
                    "<i class='fab fa-whatsapp text-primary'></i>" +
                    "<a href='https://wa.me/" + val.user.no_telp + "' target='_blank'> Hubungi Teknisi</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<p>" + val.atm.kode_mesin + "</p>" +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<p>" + val.atm.nama_atm + "</p>" +
                    "<div style='width: 180; height: 180;'>" +
                    "<iframe src='https://www.google.com/maps?q=" + val.latitude + "," + val.longitude + "&hl=es;z=14&output=embed' frameborder='0'>" + "</iframe>" +
                    "</div>" +
                    "</td>" +
                    "<td>" +
                    val.keterangan +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<img src='storage/uploads/" + val.foto + "' class='rounded' alt='' style='width:100px; height:100px'/>" +
                    "<a href='#'data-id='" + val.id + "' bs-toggle='modal' data-bs-target='#showImage' class='lihat-gambar'>Lihat Gambar</a>" +
                    "</td>" +
                    "<td style='width:200px' class='text-center'>" +
                    (val.kondisi_mesin == 'Menunggu Tindakan' ? '<button type="button" class="btn btn-warning btn-rounded mb-2">Perlu Tindakan</button>' : val.kondisi_mesin == 'Selesai' ? '<button type="button" class="btn btn-success btn-rounded mb-2">SELESAI</button>' : '') +
                    "<a href='#' data-id=" + val.id + " class='ubah-status'>Ubah status</a>" +
                    "</td>" +
                    "</tr>"
                )
            })
            }
        });
    });
});
</script>
@endsection
