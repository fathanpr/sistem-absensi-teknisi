@extends('table-progres')
@section('title','Daftar Absensi Teknisi')
@section('link')
    <a class="dropdown-item" href="{{ route('admin') }}">Detail Absen Teknisi</a>
@endsection
@section('content')
<div class="container my-5">
    <div class="konten">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <h1>Progres Kerja Teknisi</h1>
                    <p>{{ $tanggal }}<p>
                </div>
                <div class="col-6">
                    <form action="{{route('admin.progress')}}" method="GET">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary filter"><i class="fas fa-filter"></i></button>
                        </div>
                        <div class="col-6">
                            <input type="date" aria-label="First name" class="form-control" name="created_at" value="{{ Request::get('created_at') ?? date('Y-m-d')}}">
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="shadow-5-strong rounded-5 overflow-auto mb-3">
                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-primary bg-gradient text-light fw-bold">
                        <tr>
                            <th colspan="7">Ilhan Firaldi</th>
                            <th colspan="7" style="text-align:end;">Telah melakukan absen sebanyak {{$ilhan}} dari 11</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        <tr class="text-center">
                            @for($i = 0; $i < $ilhan ; $i++)
                            <td><i class="fas fa-check fa-lg" style="color: #2cdb00"></i></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="shadow-5-strong rounded-5 overflow-auto mb-3">
                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-primary bg-gradient text-light fw-bold">
                        <tr>
                            <th colspan="7">Darmawan Kijut</th>
                            <th colspan="7" style="text-align:end;">Telah melakukan absen sebanyak {{$darmawan}} dari 11</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        <tr class="text-center">
                            @for($i = 0; $i < $darmawan ; $i++)
                            <td><i class="fas fa-check fa-lg" style="color: #2cdb00"></i></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="shadow-5-strong rounded-5 overflow-auto mb-3">
                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-primary bg-gradient text-light fw-bold">
                        <tr>
                            <th colspan="7">Darmawan Kijut</th>
                            <th colspan="7" style="text-align:end;">Telah melakukan absen sebanyak {{$darmawan}} dari 11</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        <tr class="text-center">
                            @for($i = 0; $i < $darmawan ; $i++)
                            <td><i class="fas fa-check fa-lg" style="color: #2cdb00"></i></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="shadow-5-strong rounded-5 overflow-auto mb-3">
                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-primary bg-gradient text-light fw-bold">
                        <tr>
                            <th colspan="7">Darmawan Kijut</th>
                            <th colspan="7" style="text-align:end;">Telah melakukan absen sebanyak {{$darmawan}} dari 11</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        <tr class="text-center">
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