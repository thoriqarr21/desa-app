@extends('layouts.app')

@section('title', 'Dashboard - Analytics')

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
<div class="container-clock d-flex justify-content-center">
  <div class="card-clock text-center text-white p-3 rounded-1"
       style="background: linear-gradient(135deg, #5e00ff, #00e0ff); width: 250px;">
       
    <h6 id="clock-day" class="mb-1 text-uppercase fw-semibold" style="letter-spacing: 1px;">Senin</h6>
    <h1 id="clock-time" class="display-4 fw-bold">00:00:00</h1>
    <p id="clock-date" class="mb-0">1 Januari 2025</p>
    
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

{{-- <div class="row gy-6">
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body text-nowrap">
        <h5 class="card-title mb-0 flex-wrap text-nowrap">Congratulations Norris! 🎉</h5>
        <p class="mb-2">Best seller of the month</p>
        <h4 class="text-primary mb-0">$42.8k</h4>
        <p class="mb-2">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
      </div>
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="position-absolute bottom-0 end-0 me-5 mb-5" width="83" alt="view sales">
    </div>
  </div>
  <!--/ Congratulations card -->

  <!-- Transactions -->
  <div class="col-lg-8">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Transactions</h5>
          <div class="dropdown">
            <button class="btn text-muted p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ri-more-2-line ri-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div>
        </div>
        <p class="small mb-0"><span class="h6 mb-0">Total 48.5% Growth</span> 😎 this month</p>
      </div>
      <div class="card-body pt-lg-10">
        <div class="row g-6">
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-primary rounded shadow-xs">
                  <i class="ri-pie-chart-2-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Sales</p>
                <h5 class="mb-0">245k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-success rounded shadow-xs">
                  <i class="ri-group-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Customers</p>
                <h5 class="mb-0">12.5k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-warning rounded shadow-xs">
                  <i class="ri-macbook-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Product</p>
                <h5 class="mb-0">1.54k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-info rounded shadow-xs">
                  <i class="ri-money-dollar-circle-line ri-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <p class="mb-0">Revenue</p>
                <h5 class="mb-0">$88k</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->

  <!-- Weekly Overview Chart -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h5 class="mb-1">Weekly Overview</h5>
          <div class="dropdown">
            <button class="btn text-muted p-0" type="button" id="weeklyOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ri-more-2-line ri-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body pt-lg-2">
        <div id="weeklyOverviewChart"></div>
        <div class="mt-1 mt-md-3">
          <div class="d-flex align-items-center gap-4">
            <h4 class="mb-0">45%</h4>
            <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
          </div>
          <div class="d-grid mt-3 mt-md-4">
            <button class="btn btn-primary" type="button">Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Weekly Overview Chart -->

  <!-- Total Earnings -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Total Earning</h5>
        <div class="dropdown">
          <button class="btn text-muted p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ri-more-2-line ri-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body pt-lg-8">
        <div class="mb-5 mb-lg-12">
          <div class="d-flex align-items-center">
            <h3 class="mb-0">$24,895</h3>
            <span class="text-success ms-2">
              <i class="ri-arrow-up-s-line"></i>
              <span>10%</span>
            </span>
          </div>
          <p class="mb-0">Compared to $84,325 last year</p>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-6">
            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
              <img src="{{asset('assets/img/icons/misc/zipcar.png')}}" alt="zipcar">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Zipcar</h6>
                <p class="mb-0">Vuejs, React & HTML</p>
              </div>
              <div>
                <h6 class="mb-2">$24,895.65</h6>
                <div class="progress bg-label-primary" style="height: 4px;">
                  <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-6">
            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
              <img src="{{asset('assets/img/icons/misc/bitbank.png')}}" alt="bitbank">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Bitbank</h6>
                <p class="mb-0">Sketch, Figma & XD</p>
              </div>
              <div>
                <h6 class="mb-2">$8,6500.20</h6>
                <div class="progress bg-label-info" style="height: 4px;">
                  <div class="progress-bar bg-info" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
              <img src="{{asset('assets/img/icons/misc/aviato.png')}}" alt="aviato">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Aviato</h6>
                <p class="mb-0">HTML & Angular</p>
              </div>
              <div>
                <h6 class="mb-2">$1,2450.80</h6>
                <div class="progress bg-label-secondary" style="height: 4px;">
                  <div class="progress-bar bg-secondary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Total Earnings -->

  <!-- Four Cards -->
  <div class="col-xl-4 col-md-6">
    <div class="row gy-6">
      <!-- Total Profit line chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h4 class="mb-0">$86.4k</h4>
          </div>
          <div class="card-body">
            <div id="totalProfitLineChart" class="mb-3"></div>
            <h6 class="text-center mb-0">Total Profit</h6>
          </div>
        </div>
      </div>
      <!--/ Total Profit line chart -->
      <!-- Total Profit Weekly Project -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                <i class="ri-pie-chart-2-line ri-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn text-muted p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-more-2-line ri-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-1">Total Profit</h6>
            <div class="d-flex flex-wrap mb-1 align-items-center">
              <h4 class="mb-0 me-2">$25.6k</h4>
              <p class="text-success mb-0">+42%</p>
            </div>
            <small>Weekly Project</small>
          </div>
        </div>
      </div>
      <!--/ Total Profit Weekly Project -->
      <!-- New Yearly Project -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                <i class="ri-file-word-2-line ri-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn text-muted p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-more-2-line ri-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-1">New Project</h6>
            <div class="d-flex flex-wrap mb-1 align-items-center">
              <h4 class="mb-0 me-2">862</h4>
              <p class="text-danger mb-0">-18%</p>
            </div>
            <small>Yearly Project</small>
          </div>
        </div>
      </div>
      <!--/ New Yearly Project -->
      <!-- Sessions chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h4 class="mb-0">2,856</h4>
          </div>
          <div class="card-body">
            <div id="sessionsColumnChart" class="mb-3"></div>
            <h6 class="text-center mb-0">Sessions</h6>
          </div>
        </div>
      </div>
      <!--/ Sessions chart -->
    </div>
  </div>
  <!--/ four cards -->

  <!-- Sales by Countries -->
  <div class="col-xl-4 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Sales by Countries</h5>
        <div class="dropdown">
          <button class="btn text-muted p-0" type="button" id="saleStatus" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ri-more-2-line ri-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center mb-4">
            <div class="avatar me-4">
              <div class="avatar-initial bg-label-success rounded-circle">US</div>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1 mb-1">
                <h6 class="mb-0">$8,656k</h6>
                <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                <span class="text-success">25.8%</span>
              </div>
              <p class="mb-0">United states of america</p>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-1">894k</h6>
            <small class="text-muted">Sales</small>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center mb-4">
            <div class="avatar me-4">
              <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1 mb-1">
                <h6 class="mb-0">$2,415k</h6>
                <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                <span class="text-danger">6.2%</span>
              </div>
              <p class="mb-0">United Kingdom</p>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-1">645k</h6>
            <small class="text-muted">Sales</small>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center mb-4">
            <div class="avatar me-4">
              <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1 mb-1">
                <h6 class="mb-0">865k</h6>
                <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                <span class="text-success"> 12.4%</span>
              </div>
              <p class="mb-0">India</p>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-1">148k</h6>
            <small class="text-muted">Sales</small>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center mb-4">
            <div class="avatar me-4">
              <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1 mb-1">
                <h6 class="mb-0">$745k</h6>
                <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                <span class="text-danger">11.9%</span>
              </div>
              <p class="mb-0">Japan</p>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-1">86k</h6>
            <small class="text-muted">Sales</small>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <div class="avatar me-4">
              <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1 mb-1">
                <h6 class="mb-0">$45k</h6>
                <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                <span class="text-success">16.2%</span>
              </div>
              <p class="mb-0">Korea</p>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-1">42k</h6>
            <small class="text-muted">Sales</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sales by Countries -->

  <!-- Deposit / Withdraw -->
  <div class="col-xl-8">
    <div class="card-group">
      <div class="card mb-0">
        <div class="card-body card-separator">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Deposit</h5>
            <a class="fw-medium" href="javascript:void(0);">View all</a>
          </div>
          <div class="deposit-content pt-2">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/gumroad.png')}}" class="img-fluid" alt="gumroad" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Gumroad Account</h6>
                    <p class="mb-0">Sell UI Kit</p>
                  </div>
                  <h6 class="text-success mb-0">+$4,650</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/mastercard-2.png')}}" class="img-fluid" alt="mastercard" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Mastercard</h6>
                    <p class="mb-0">Wallet deposit</p>
                  </div>
                  <h6 class="text-success mb-0">+$92,705</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/stripes.png')}}" class="img-fluid" alt="stripes" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Stripe Account</h6>
                    <p class="mb-0">iOS Application</p>
                  </div>
                  <h6 class="text-success mb-0">+$957</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/american-bank.png')}}" class="img-fluid" alt="american" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">American Bank</h6>
                    <p class="mb-0">Bank Transfer</p>
                  </div>
                  <h6 class="text-success mb-0">+$6,837</h6>
                </div>
              </li>
              <li class="d-flex align-items-center">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/citi.png')}}" class="img-fluid" alt="citi" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Bank Account</h6>
                    <p class="mb-0">Wallet deposit</p>
                  </div>
                  <h6 class="text-success mb-0">+$446</h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card mb-0">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Withdraw</h5>
            <a class="fw-medium" href="javascript:void(0);">View all</a>
          </div>
          <div class="withdraw-content pt-2">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/brands/google.png')}}" class="img-fluid" alt="google" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Google Adsense</h6>
                    <p class="mb-0">Paypal deposit</p>
                  </div>
                  <h6 class="text-danger mb-0">-$145</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/brands/github.png')}}" class="img-fluid" alt="github" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Github Enterprise</h6>
                    <p class="mb-0">Security &amp; compliance</p>
                  </div>
                  <h6 class="text-danger mb-0">-$1870</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/brands/slack.png')}}" class="img-fluid" alt="slack" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Upgrade Slack Plan</h6>
                    <p class="mb-0">Debit card deposit</p>
                  </div>
                  <h6 class="text-danger mb-0">$450</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/payments/digital-ocean.png')}}" class="img-fluid" alt="digital" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Digital Ocean</h6>
                    <p class="mb-0">Cloud Hosting</p>
                  </div>
                  <h6 class="text-danger mb-0">-$540</h6>
                </div>
              </li>
              <li class="d-flex align-items-center">
                <div class="flex-shrink-0 me-4">
                  <img src="{{asset('assets/img/icons/brands/aws.png')}}" class="img-fluid" alt="aws" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">AWS Account</h6>
                    <p class="mb-0">Choosing a Cloud Platform</p>
                  </div>
                  <h6 class="text-danger mb-0">-$21</h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Deposit / Withdraw -->

  <!-- Data Tables -->
  <div class="col-12">
    <div class="card overflow-hidden">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-truncate">User</th>
              <th class="text-truncate">Email</th>
              <th class="text-truncate">Role</th>
              <th class="text-truncate">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
                    <small class="text-truncate">@amiccoo</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">susanna.Lind57@gmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                  <span>Admin</span>
                </div>
              </td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                    <small class="text-truncate">@brossiter15</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">estelle.Bailey10@gmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                  <span>Editor</span>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                    <small class="text-truncate">@bemblinf</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">milo86@hotmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-computer-line text-danger ri-22px me-2"></i>
                  <span>Author</span>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bertha Biner</h6>
                    <small class="text-truncate">@bbinerh</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">lonnie35@hotmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                  <span>Editor</span>
                </div>
              </td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
                    <small class="text-truncate">@bkrabbe1d</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">ahmad_Collins@yahoo.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-pie-chart-2-line ri-22px text-info me-2"></i>
                  <span>Maintainer</span>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                    <small class="text-truncate">@brosebothamz</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                  <span>Editor</span>
                </div>
              </td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                    <small class="text-truncate">@bkildayr</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">otho21@gmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-user-3-line ri-22px text-success me-2"></i>
                  <span>Subscriber</span>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr class="border-transparent">
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-4">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                    <small class="text-truncate">@bgallemore6</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">florencio.Little@hotmail.com</td>
              <td class="text-truncate">
                <div class="d-flex align-items-center">
                  <i class="ri-user-3-line ri-22px text-success me-2"></i>
                  <span>Subscriber</span>
                </div>
              </td>
              <td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Data Tables -->
</div> --}}


