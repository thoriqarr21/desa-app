@extends('layouts.app')

@section('content')

    <div class="px-5 py-4 container-fluid">
        <div class="mt-4 row">
            
            <div class="col-12">
                <div class="alert alert-dark text-sm" role="alert">
                    <strong>Add, Edit, Delete features are not functional!</strong> This is a
                    <strong>PRO</strong> feature ! Click <a href="#" target="_blank" class="text-bold">here</a>
                    to see the <strong>PRO</strong> product!
                </div>
                <div class="card">
                    <div class="pb-0 card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="">Role Management</h5>
                                <p class="mb-0 text-sm">
                                    Here you can manage roles.
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('roles.create') }}" class="btn btn-dark btn-primary">
                                    <i class="fas fa-user-plus me-2"></i> Add Role
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="">
                            @foreach (['success', 'primary', 'danger'] as $type)
                                @if(session($type))
                                <div class="alert alert-{{ $type }}" role="alert" id="alert-message">{{ session($type) }}</div>
                                @endif
                            @endforeach
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert" id="alert-message">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-secondary text-center">
                            <thead>
                                <tr>
                                    <th
                                        class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                        ID</th>
                                    
                                    <th
                                        class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                        Name</th>
                                    <th
                                        class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                        Action</th>
                                </tr>
                            </thead>
                            @foreach ($roles as $key => $role)
                            <tbody>
                                <tr>
                                    <td class="align-middle bg-transparent border-bottom">{{ ++$i }}</td>
                             
                                    <td class="align-middle bg-transparent border-bottom">{{ $role->name }}</td>
                                    <td class="text-center align-middle bg-transparent border-bottom">
                                        <a href="{{ route('roles.show',$role->id) }}"><i class="fas fa-list-ul" aria-hidden="true"></i></a>
                                        <a href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></a>
                                        <form method="POST" action="{{ route('roles.destroy',$role->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                          
                                            <button type="submit"><i class="fa-solid fa-trash ms-1"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



{!! $roles->links('pagination::bootstrap-5') !!}


@endsection
