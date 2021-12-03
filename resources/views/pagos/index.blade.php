@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Pagos</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('patients/create') }}" class="btn btn-sm btn-success">
            Nuevo Pago
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif
    </div>    
    <div class="table-responsive">
       <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">E-mail</th>
            <th scope="col">DNI</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        
      </table>
    </div>
    
  </div>
@endsection
