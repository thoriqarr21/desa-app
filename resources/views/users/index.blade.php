@extends('layouts.app')

@section('content')
@foreach (['success', 'primary', 'danger'] as $type)
    @if(session($type))
        <div class="alert alert-{{ $type }}" role="alert" id="alert-message">{{ session($type) }}</div>
    @endif
@endforeach
@if(session('error'))
    <div class="alert alert-danger" role="alert" id="alert-message">
        {{ session('error') }}
    </div>
@endif
    <div class="px-md-5 py-4 container-fluid mb-5">
        <div class="row">
            <div class="px-3 ">
                <h6 class="text-muted mb-3">
                    Berikut adalah daftar <strong style="font-weight :bold; color:#323c67; font-size: 18px">Users</strong> yang telah dibuat untuk mendukung dalam pengelolaan program desa secara efektif.
                </h6>
            </div>
            <div class="col-lg-12 margin-tb">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Users list</h6>
                            <p class="text-sm">See information about all users</p>
                        </div>
                        <div class="ms-auto d-flex">
                            <div class="text-end">
                                @can('user-create')               
                                <a href="{{ route('users.create') }}" class="btn btn-dark btn-primary">
                                     <i class="fas fa-user-plus me-2"></i> Add Users
                                 </a>
                                @endcan
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                        <form method="GET" id="filterForm">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="role" id="roleAll" value="" autocomplete="off" {{ request('role') == '' ? 'checked' : '' }}>
                                <label class="btn btn-white px-3 mb-0" for="roleAll">All</label>
                        
                                <input type="radio" class="btn-check" name="role" id="roleAdmin" value="admin" autocomplete="off" {{ request('role') == 'admin' ? 'checked' : '' }}>
                                <label class="btn btn-white px-3 mb-0" for="roleAdmin">Admin</label>

                                <input type="radio" class="btn-check" name="role" id="rolePegawai" value="pegawai" autocomplete="off" {{ request('role') == 'pegawai' ? 'checked' : '' }}>
                                <label class="btn btn-white px-3 mb-0" for="rolePegawai">Pegawai</label>
                            </div>
                            
                        </form>                        
                        <div class="input-group w-sm-25 ms-auto">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search">
                        </div>         
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary fs-6 font-weight-semibold opacity-7">Nama
                                    </th>
                                    <th class="text-secondary fs-6 font-weight-semibold opacity-7 ps-2">
                                        Username</th>
                                    <th
                                        class="text-center text-secondary fs-6 font-weight-semibold opacity-7">
                                        Role</th>
                                    <th
                                        class="text-center text-secondary fs-6 font-weight-semibold opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $user)
                                <tr data-role="{{ strtolower($user->getRoleNames()->first()) }}">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $user->gambar) }}"
                                                    class="avatar avatar-sm rounded-circle me-2"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                <p class="mb-0 font-weight-semibold fs-6">{{ $user->name }}</p>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fs-6 text-dark font-weight-semibold mb-0">{{ $user->username }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span
                                            class="badge badge-sm border border-success bg-success">
                                            @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                               <label>{{ $v }}</label>
                                            @endforeach
                                          @endif
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @can('user-edit')
                                        <a href="{{ route('users.edit',$user->id) }}"><i class="edit fas fa-user-edit" aria-hidden="true"></i></a>                        
                                        @endcan
                                        @can('user-show')
                                        <a href="{{ route('users.show',$user->id) }}"><i class="show fas fa-list-ul ms-1" aria-hidden="true"></i></a>
                                        @endcan
                                        @can('user-delete')                                     
                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                          
                                            <button type="submit"><i class="delete fa-solid fa-trash ms-1"></i></button>
                                        </form>
                                        @endcan

                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top py-3 px-3 d-flex justify-content-between align-items-center">
                        <div>
                            {!! $data->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="roleFilter"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const selected = this.value;
                const rows = document.querySelectorAll('table tbody tr');
    
                rows.forEach(row => {
                    const role = row.getAttribute('data-role');
                    if (selected === 'all' || role === selected) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    
        // Trigger filter on page load (in case default is not 'all')
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('input[name="roleFilter"]:checked').dispatchEvent(new Event('change'));
        });
        document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('filterForm').submit();
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('table tbody tr');

    // Fungsi untuk melakukan pencarian
    function applySearch() {
        const searchQuery = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const name = row.querySelector('td:nth-child(1) .fs-6').innerText.toLowerCase();
            const username = row.querySelector('td:nth-child(2)').innerText.toLowerCase();

            // Menyembunyikan baris jika tidak cocok dengan pencarian
            if (name.includes(searchQuery) || username.includes(searchQuery)) {
                row.style.display = ''; // Tampilkan
            } else {
                row.style.display = 'none'; // Sembunyikan
            }
        });
    }

    // Mendengarkan input pada search box
    searchInput.addEventListener('input', applySearch);
});

    </script>
    
    

@endsection
