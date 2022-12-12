@extends('table-progres')
@section('title','Daftar Absensi Teknisi')
@section('content')
<div class="container my-5">
    <div class="konten">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <h1>Progres Kerja Teknisi</h1>
                    <p>Minggu, 15 Desember 2022<p>
                </div>
                <div class="col-6">
                    <form action="{{route('admin.progress')}}" method="GET">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary filter"><i class="fas fa-filter"></i></button>
                        </div>
                        <div class="col-6">
                            <input type="date" aria-label="First name" class="form-control" name="created_at" value="{{ Request::get('created_at') }}">
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="shadow-5-strong rounded-5 overflow-auto">
                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-primary bg-gradient text-light fw-bold">
                        <tr>
                            <th style="width: 50px">Nama</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        <tr>
                            <td>Darmawan Kijut</td>
                            @for($i = 0; $i < $ilhan ; $i++)
                            <td><i class="fas fa-check fa-lg" style="color: #2cdb00"></i></td>
                            @endfor
                        </tr>
                        <tr>
                            <td>Ilhan Firaldi</td>
                            @for($i = 0; $i < $darmawan ; $i++)
                            <td><i class="fas fa-check fa-lg" style="color: #2cdb00"></i></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection