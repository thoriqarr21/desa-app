@extends('layouts.app')

@section('title', 'Dashboard - Analytics')

@section('content')

<div class="container-fluid py-4 px-5">
  <div class="d-flex">
    <div class="card-body">
      {{-- <h2>Dashboard</h2> --}}
      <h2>RKTL Desa Bojong Gede</h2>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      Halo, {{ Auth::user()->name }}
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
                                <span class="text-sm ms-1">Jumlah Data</span>
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
                                <span class="text-sm ms-1">Jumlah Data</span>
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
                                <span class="text-sm ms-1">Jumlah Data</span>
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
                                <span class="text-sm ms-1">Jumlah Data</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="row">
      <div class="col-md-4 mb-xl-0 mb-4">
        <div class="card shadow-xs border h-100">
          <div class="card-header pb-0">
            <h4 class="font-weight-bold text-md mb-0">Rasio Laporan Kegiatan</h4>
          </div>
          <div class="card-body py-3 mt-1">
            <div id="rasioChartKegiatan"></div>
          </div>
          <h6 class="font-weight-bold text-md ms-3 mb-5">Berikut di atas adalah rasio laporan kegiatan disetujui, pending dan ditolak.</h6>
        </div>
      </div>
      <div class="col-md-4 mb-xl-0 mb-4">
        <div class="card shadow-xs border h-100">
          <div class="card-header pb-0">
            <h4 class="font-weight-bold text-md mb-0">Rasio Laporan Proyek</h4>
          </div>
          <div class="card-body py-3 mt-1">
            <div id="rasioChartProyek"></div>
          </div>
          <h6 class="font-weight-bold text-md ms-3 mb-5">Berikut di atas adalah rasio Laporan Proyek disetujui, pending dan ditolak.</h6>
        </div>
      </div>
      <div class="col-md-4 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header text-white">
            <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Status Proyek</h5>
          </div>
          <div class="card-body">
            <div class="card mb-3 border-start status">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="mb-1">Batal</h5>
                  <h6 class="text-muted">Jumlah: {{ $proyekBatal }}</h6>
                </div>
                <i class="fas fa-times-circle text-danger fa-lg"></i>
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
    
  <div class="row mt-4">
    <div class="col-md-6 mb-4">
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
  
  
    <div class="col-md-6 mb-4">
      <div class="card shadow-xs border h-100">
        <div class="card-header pb-0">
            <h4 class="font-weight-bold text-md mb-0">Kalender Kegiatan & Proyek</h4>
        </div>
        <div class="card-body py-3">
            <div id="calendar"></div>
        </div>
        <div class="mt-2 mb-2 ms-4">
          <span style="background-color: #007bff; width: 15px; height: 15px; display: inline-block;"></span> Kegiatan
          <span style="background-color: #28a745; width: 15px; height: 15px; display: inline-block; margin-left: 10px;"></span> Proyek
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card shadow-sm rounded">
        <h4 class="mb-3 mt-2 ms-3">Statistik Kegiatan Per Tahun</h4>
          <div class="card-body">
              <div id="kegiatanBarChart"></div>
          </div>
      </div>
    </div>
</div>
<div class="col mt-4">
  <div class="card shadow-sm rounded" style="border: 2px solid rgb(240, 240, 240)">
    <h5 class="mt-2 ms-3">Peta Seluruh Lokasi Kegiatan & Proyek</h5>
    <div class="card-body">
      <div id="map" style="height: 400px; width: 100%"></div>

      <!-- Keterangan Warna Marker -->
      <div class="mt-3 d-flex align-items-center gap-4 flex-wrap">
        <div class="d-flex align-items-center">
          <div class="text-ket text-secondary fw-bold">Keterangan :</div>
        </div>
        <div class="d-flex align-items-center">
          <img src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png" width="12" class="me-2">
          <span class="fw-semibold text-secondary">Kegiatan</span>
        </div>
        <div class="d-flex align-items-center">
          <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png" width="12" class="me-2">
          <span class="fw-semibold text-secondary">Proyek</span>
        </div>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
</div>
<script>
      var map = L.map('map').setView([-6.4, 106.8], 12); // Koordinat default Bojonggede
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  const proyekIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  // Icon kegiatan (biru - default)
  const kegiatanIcon = new L.Icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  let lokasiData = @json($lokasiGabungan);

  lokasiData.forEach(item => {
    if (item.lokasi) {
      let koordinat = item.lokasi.split(',').map(parseFloat);
      if (koordinat.length === 2) {
        let icon = item.jenis === 'proyek' ? proyekIcon : kegiatanIcon;

        let marker = L.marker(koordinat, { icon }).addTo(map)
          .bindPopup(`<strong>${item.nama}</strong><br><span class="text-muted">${item.jenis}</span>`);

        marker.on('mouseover', function () {
          fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${koordinat[0]}&lon=${koordinat[1]}&zoom=18&addressdetails=1`)
            .then(res => res.json())
            .then(data => {
              let alamat = data.display_name || 'Alamat tidak ditemukan';
              marker.bindTooltip(alamat).openTooltip();
            })
            .catch(() => {
              marker.bindTooltip('Gagal mengambil alamat').openTooltip();
            });
        });

        marker.on('mouseout', function () {
          marker.closeTooltip();
        });
      }
    }
  });
    // --------- ////
  const ctx = document.getElementById('progresChart').getContext('2d');
  const progresChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['0%', '50%', '100%'],
      datasets: [{
        label: 'Jumlah Proyek',
        data: [
          {{ $persentase0 }},
          {{ $persentase50 }},
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
    // rasio ///
    document.addEventListener("DOMContentLoaded", function () {
  // Chart untuk Laporan Kegiatan
  var optionsKegiatan = {
    chart: { type: 'donut' },
    series: [{{ $rasioDisetujui }}, {{ $rasioPending }}, {{ $rasioDitolak }}],
    labels: ['Disetujui', 'Pending', 'Ditolak'],
    colors: ['#28a745', '#ffc107', '#dc3545'],
    responsive: [{
      breakpoint: 480,
      options: {
        chart: { width: 300 },
        legend: { position: 'bottom' }
      }
    }]
  };

  var chartKegiatan = new ApexCharts(document.querySelector("#rasioChartKegiatan"), optionsKegiatan);
  chartKegiatan.render();

  // Chart untuk Laporan Proyek
  var optionsProyek = {
    chart: { type: 'donut' },
    series: [{{ $rasioDisetujuiProyek }}, {{ $rasioPendingProyek }}, {{ $rasioDitolakProyek }}],
    labels: ['Disetujui', 'Pending', 'Ditolak'],
    colors: ['#28a745', '#ffc107', '#dc3545'],
    responsive: [{
      breakpoint: 480,
      options: {
        chart: { width: 300 },
        legend: { position: 'bottom' }
      }
    }]
  };

  var chartProyek = new ApexCharts(document.querySelector("#rasioChartProyek"), optionsProyek);
  chartProyek.render();
});

  $(document).ready(function () {
  $('#calendar').fullCalendar({
    events: [
      // Data Kegiatan
      @foreach($dataKegiatan as $kegiatan)
        {
          title: 'Kegiatan: {{ $kegiatan->nama_kegiatan }}',
          start: '{{ $kegiatan->tanggal_mulai }}',
          end: '{{ $kegiatan->tanggal_selesai }}',
          description: 'Lokasi: {{ $kegiatan->lokasi }}',
          color: '#007bff' // Biru untuk kegiatan
        },
      @endforeach

      // Data Proyek
      @foreach($dataProyek as $proyek)
        {
          title: 'Proyek: {{ $proyek->nama_proyek }}',
          start: '{{ $proyek->tanggal_mulai }}',
          end: '{{ $proyek->tanggal_selesai }}',
          description: 'Lokasi: {{ $proyek->lokasi }}',
          color: '#28a745' // Hijau untuk proyek
        },
      @endforeach
    ],
    eventRender: function(event, element) {
      element.attr('title', event.description); // Tooltip lokasi
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



