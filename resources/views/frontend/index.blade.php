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
@section('vendor-style')
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-o9N1j7k2v3xbZz5GyWzxMaLwM4O1aU9aQ+U+pG6P5tM="
    crossorigin=""
  />
  @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
  <script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-o9N1j7k2v3xbZz5GyWzxMaLwM4O1aU9aQ+U+pG6P5tM="
    crossorigin=""
  ></script>
  @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('content')

<div class="container-fluid py-4 px-5">
    <div class="d-flex">
      <div class="card-body">
        {{-- <h2>Dashboard</h2> --}}
        <h2>Hello, {{ Auth::user()->name }}</h2>
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        {{ __('You are logged in!') }}
      </div>
    
      <div class="d-flex align-items-end me-5">
        <h4 class="welcome-hover animated-welcome">Selamat Datang</h4>
      </div>
      
    </div>
    
    
  <hr class="animated-hr">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
              <div class="card-body text-start p-3 w-100">
                  <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                      <path d="M19 9h-4V5c0-.55-.45-1-1-1H10c-.55 0-1 .45-1 1v4H5c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h14c.55 0 1-.45 1-1V10c0-.55-.45-1-1-1zm-6 0H9V6h4v3zm-6 0h2v7H7V9zm12 10H5V10h14v9z"/>
                  </svg>
                  
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="w-100">
                              <p class="text-sm text-secondary mb-1">Proyek Pembangunan</p>
                              <h4 class="mb-2 font-weight-bold">{{ $jumlahProyek }} Proyek</h4>
                              <div class="d-flex align-items-center">
                                  <span class="text-sm text-success font-weight-bolder">
                                      <i class="fa fa-chevron-up text-xs me-1"></i>Desa Bojonggede
                                  </span>
                                  <span class="text-sm ms-1">Proyek</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
              <div class="card-body text-start p-3 w-100">
                  <div
                      class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path d="M21 3h-3V1h-2v2H8V1H6v2H3c-1.1 0-1.99.89-1.99 1.99L1 19c0 1.1.89 2 1.99 2H21c1.1 0 1.99-.9 1.99-2L23 5c0-1.1-.89-1.99-1.99-1.99zM12 14H5v-2h7v2zm4-4H5v-2h11v2z"/>
                      </svg>
                      
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="w-100">
                              <p class="text-sm text-secondary mb-1">Kegiatan</p>
                              <h4 class="mb-2 font-weight-bold">{{ $jumlahKegiatan }} Kegiatan</h4>
                              <div class="d-flex align-items-center">
                                  <span class="text-sm text-success font-weight-bolder">
                                      <i class="fa fa-chevron-up text-xs me-1"></i>Desa Bojonggede
                                  </span>
                                  <span class="text-sm ms-1">Kegiatan</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
              <div class="card-body text-start p-3 w-100">
                  <div
                      class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path d="M6 2v16c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V6l-6-4H7c-.55 0-1 .45-1 1z"/>
                        <path d="M12 7V1L18 7h-6z"/>
                        <path fill-rule="evenodd" d="M6 12h12v1H6zM6 15h12v1H6zM6 18h12v1H6z"/>
                    </svg>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="w-100">
                              <p class="text-sm text-secondary mb-1">Laporan Kegiatan  </p>
                              <h4 class="mb-2 font-weight-bold">{{ $jumlahLaporanKegiatan }} Laporan</h4>
                              <div class="d-flex align-items-center">
                                  <span class="text-sm text-success font-weight-bolder">
                                      <i class="fa fa-chevron-up text-xs me-1"></i>Desa Bojonggede
                                  </span>
                                  <span class="text-sm ms-1">Laporan Kegiatan</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
              <div class="card-body text-start p-3 w-100">
                  <div
                      class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                      <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24" fill="currentColor">
                          <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                          <path fill-rule="evenodd"
                              d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                              clip-rule="evenodd" />
                      </svg>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="w-100">
                              <p class="text-sm text-secondary mb-1">Laporan Proyek</p>
                              <h4 class="mb-2 font-weight-bold">{{ $jumlahLaporanProyek }} Laporan</h4>
                              <div class="d-flex align-items-center">
                                  <span class="text-sm text-success font-weight-bolder">
                                      <i class="fa fa-chevron-up text-xs me-1"></i>Desa Bojonggede
                                  </span>
                                  <span class="text-sm ms-1">Laporan Proyek</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-8 mb-4">
      <div class="card shadow-xs border h-100">
        <div class="card-header pb-0">
          <h4 class="font-weight-bold text-md mb-0">Statistik Progres Proyek</h4>
          <p class="text-sm text-muted">Jumlah proyek per progres (%)</p>
        </div>
        <div class="card-body py-3">
          <canvas id="progresChart" height="160" style="width: 100%;"></canvas>
        </div>
      </div>
      </div>
  
  
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-header text-white">
              <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Status Proyek</h5>
            </div>
            <div class="card-body">
      
              <div class="card mb-3 border-start status">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="mb-1">Perencanaan</h5>
                    <h6 class="text-muted">Jumlah: {{ $proyekPerencanaan }}</h6>
                  </div>
                  <i class="fas fa-pencil-alt text-primary fa-lg"></i>
                </div>
              </div>
              <div class="card mb-3 border-start status">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="mb-1">Berjalan</h5>
                    <h6 class="text-muted">Jumlah: {{ $proyekBerjalan }}</h6>
                  </div>
                  <i class="fas fa-spinner text-warning fa-lg"></i>
                </div>
              </div>
              <div class="card border-start status">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="mb-1">Selesai</h5>
                    <h6 class="text-muted">Jumlah: {{ $proyekSelesai }}</h6>
                  </div>
                  <i class="fas fa-check-circle text-success fa-lg"></i>
                </div>
              </div>
      
            </div>
          </div>
          </div>
      </div>
      <div class="row">
        <h4 class="mb-3">Statistik Kegiatan Per Tahun</h4>
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div id="kegiatanBarChart"></div>
            </div>
        </div>
    </div>
    <!-- Grafik Rasio Kegiatan Disetujui vs Ditolak -->
    <div class="row mt-5">
      <div class="col-xl-6 col-sm-6 mb-xl-0">
      <div class="card shadow-xs border h-100">
        <div class="card-header pb-0">
          <h4 class="font-weight-bold text-md mb-0">Rasio Kegiatan Disetujui vs Ditolak</h4>
        </div>
        <div class="card-body py-3">
          <div id="rasioChart"></div>
        </div>
      </div>
    </div>
  <!-- Kalender Kegiatan -->
  <div class="col-xl-6 col-sm-6 mb-xl-0">
    <div class="card shadow-xs border h-100">
        <div class="card-header pb-0">
            <h4 class="font-weight-bold text-md mb-0">Kalender Kegiatan</h4>
        </div>
        <div class="card-body py-3">
            <div id="calendar"></div> <!-- Kalender akan ditampilkan di sini -->
        </div>
    </div>
  </div>
  </div>
  <div class="container mt-4">
    <h4 class="mb-3">Peta Lokasi Kegiatan</h4>
    <div class="card shadow-sm rounded">
      <div class="card-body">
        <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>
      </div>
    </div>
  </div>
  
      </div>
    </div>
  </div>
  <script>
      const lokasiKegiatan = @json($lokasiKegiatan);
      
      document.addEventListener('DOMContentLoaded', function () {
          const map = L.map('map').setView([-2.5489, 118.0149], 5); // Pusat peta Indonesia
  
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '© OpenStreetMap contributors'
          }).addTo(map);
  
          lokasiKegiatan.forEach(kegiatan => {
              fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(kegiatan.lokasi)}`)
                  .then(response => response.json())
                  .then(data => {
                      if (data.length > 0) {
                          const lat = parseFloat(data[0].lat);
                          const lon = parseFloat(data[0].lon);
  
                          L.marker([lat, lon])
                              .addTo(map)
                              .bindPopup(kegiatan.nama)
                              .openPopup();
                      } else {
                          console.warn('Lokasi tidak ditemukan:', kegiatan.lokasi);
                      }
                  })
                  .catch(err => {
                      console.error('Gagal mengambil koordinat lokasi:', err);
                  });
          });
      });
      // --------- ////
    const ctx = document.getElementById('progresChart').getContext('2d');
    const progresChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['30%', '50%', '80%', '100%'],
        datasets: [{
          label: 'Jumlah Proyek',
          data: [
            {{ $persentase30 }},
            {{ $persentase50 }},
            {{ $persentase80 }},
            {{ $persentase100 }}
          ],
          backgroundColor: ['#f1c40f', '#3498db', '#9b59b6', '#2ecc71'],
          borderRadius: 6,
          barThickness: 30,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            ticks: { color: '#6c757d' },
            grid: { display: false }
          },
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              color: '#6c757d'
            },
            grid: {
              color: '#f0f0f0'
            }
          }
        },
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#333',
            titleColor: '#fff',
            bodyColor: '#fff',
          }
        }
      }
    });
  
    function updateClock() {
      const now = new Date();
  
      const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ];
  
      const dayName = days[now.getDay()];
      const date = now.getDate();
      const month = months[now.getMonth()];
      const year = now.getFullYear();
  
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
  
      document.getElementById('clock-day').textContent = dayName;
      document.getElementById('clock-time').textContent = `${hours}:${minutes}:${seconds}`;
      document.getElementById('clock-date').textContent = `${date} ${month} ${year}`;
    }
  
    setInterval(updateClock, 1000);
    updateClock();
  
    const dataKegiatan = {!! json_encode($kegiatan->pluck('jumlah')) !!};
      const tahunKegiatan = {!! json_encode($kegiatan->pluck('tahun')) !!};
  
      const options = {
          chart: {
              type: 'bar',
              height: 350
          },
          series: [{
              name: 'Jumlah Kegiatan',
              data: dataKegiatan
          }],
          xaxis: {
              categories: tahunKegiatan
          },
          yaxis: {
              labels: {
                  formatter: function (val) {
                      return Number.isInteger(val) ? val : '';
                  }
              },
              tickAmount: Math.max(...dataKegiatan), // Sesuaikan jumlah tick dengan data tertinggi
              axisTicks: {
                  show: true
              },
              axisBorder: {
                  show: true
              }
          },
          grid: {
              yaxis: {
                  lines: {
                      show: true // tampilkan garis horizontal
                  }
              },
              xaxis: {
                  lines: {
                      show: false // hilangkan garis vertikal kalau mau lebih bersih
                  }
              }
          },
          plotOptions: {
              bar: {
                  borderRadius: 4,
                  horizontal: false,
                  columnWidth: '50%',
              }
          },
          colors: ['#1E90FF'],
          dataLabels: {
              enabled: true,
              formatter: function (val) {
                  return Math.round(val); // pastikan bulat
              }
          },
          title: {
              text: 'Jumlah Kegiatan Per Tahun Desa Bojong Gede',
              align: 'center',
              style: {
                  fontSize: '16px',
                  fontWeight: 'bold'
              }
          }
      };
  
      const chart = new ApexCharts(document.querySelector("#kegiatanBarChart"), options);
      chart.render();
  
      document.addEventListener("DOMContentLoaded", function () {
      var options = {
        chart: {
          type: 'donut'
        },
        series: [{{ $rasioDisetujui }}, {{ $rasioDitolak }}],
        labels: ['Disetujui', 'Ditolak'],
        colors: ['#28a745', '#dc3545'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
      };
  
      var chart = new ApexCharts(document.querySelector("#rasioChart"), options);
      chart.render();
    });
  
  $(document).ready(function() {
      $('#calendar').fullCalendar({
        events: [
          @foreach($dataKegiatan as $index => $kegiatan)
            {
              title: '{{ $kegiatan->nama_kegiatan }}',
              start: '{{ $kegiatan->tanggal_mulai }}',
              end: '{{ $kegiatan->tanggal_selesai }}',
              description: '{{ $kegiatan->lokasi }}'
            }
            @if(!$loop->last),@endif
          @endforeach
        ],
        eventRender: function(event, element) {
          element.attr('title', event.description); // Menampilkan lokasi kegiatan sebagai tooltip
        },
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        }
      });
    });
  
  </script>
  
  
  @endsection



{{-- <div class="container">
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
  {{-- </div>

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
      <div class="col-md-4"> --}}
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
  {{-- </div>
</div>
@endsection --}} --}}