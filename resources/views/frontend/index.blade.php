@extends('frontend.layouts.master')

@section('title', 'Archive Page')

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection
@section('vendor-script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <h2>Dashboard Pegawai</h2>
  <div class="row mt-4">
      <div class="col-md-3">
          <div class="card text-white bg-primary mb-3">
              <div class="card-body">
                  <h5 class="card-title">Jumlah Proyek</h5>
                  <p class="card-text">{{ $jumlahProyek }}</p>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="card text-white bg-secondary mb-3">
              <div class="card-body">
                  <h5 class="card-title">Laporan Proyek</h5>
                  <p class="card-text">{{ $jumlahLaporanProyek }}</p>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="card text-white bg-info mb-3">
              <div class="card-body">
                  <h5 class="card-title">Kegiatan</h5>
                  <p class="card-text">{{ $jumlahKegiatan }}</p>
              </div>
          </div>
      </div>
      {{-- <div class="col-md-3">
          <div class="card text-white bg-dark mb-3">
              <div class="card-body">
                  <h5 class="card-title">Laporan Kegiatan</h5>
                  <p class="card-text">{{ $jumlahLaporanKegiatan }}</p>
              </div>
          </div>
      </div> --}}
  </div>

  <div class="row mt-2">
      <div class="col-md-4">
          <div class="card text-white bg-success mb-3">
              <div class="card-body">
                  <h5 class="card-title">Laporan Disetujui</h5>
                  <p class="card-text">{{ $laporanDisetujui }}</p>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card text-white bg-danger mb-3">
              <div class="card-body">
                  <h5 class="card-title">Laporan Ditolak</h5>
                  <p class="card-text">{{ $laporanDitolak }}</p>
              </div>
          </div>
      </div>
  </div>

  <div class="row mt-2">
      <div class="col-md-4">
          <div class="card bg-warning text-white mb-3">
              <div class="card-body">
                <h4>Status Proyek</h4>
                  <h5 class="card-title">Perencanaan {{ $proyekPerencanaan }}</h5>
                  <h5 class="card-title">Selesai : {{ $proyekSelesai }}</></h5>
                  <h5 class="card-title">Berjalan : {{ $proyekBerjalan }}</></h5>
                  
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card bg-primary text-white mb-3">
              <div class="card-body">
                  <h5 class="card-title">Progres 30% : {{ $persentase30 }}</h5>
                  <h5 class="card-title">Progres 50% : {{ $persentase50 }}</></h5>
                  <h5 class="card-title">Progres 80% : {{ $persentase80 }}</></h5>
                  <h5 class="card-title">Progres 100% : {{ $persentase100 }}</></h5>
                  
              </div>
          </div>
      </div>
      <div class="col-md-4">
          {{-- <div class="card bg-primary text-white mb-3">
              <div class="card-body">
                @foreach($anggaranPerTahun as $tahun => $jumlah)
                <div>
                    <strong>Tahun {{ $tahun }}</strong><br>
                    Total Anggaran: Rp{{ number_format($jumlah, 0, ',', '.') }}<br>
                    Sisa Anggaran: Rp{{ number_format($sisaAnggaranPerTahun[$tahun], 0, ',', '.') }}
                </div>
            @endforeach
            
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card bg-success text-white mb-3">
              <div class="card-body">
                  <h5 class="card-title">Selesai : <p class="card-text">{{ $proyekSelesai }}</p></h5>
                  
              </div>
          </div>
      </div> --}}
  </div>
</div>
@endsection