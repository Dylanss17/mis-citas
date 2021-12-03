@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar nueva cita</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
            Cancelar y volver
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

 {{--    <form action="{{ url('appointments') }}" method="post" class="multiforms">
        @csrf --}}   
      {{--   {!! Form::open(['route' => 'pay', 'method' => 'POST']) !!}
        {{csrf_field()}} --}}

      {{--  <form action="{{ route('pay') }}" method="POST" id="paymentForm"> --}}
      <form action="{{ route('appointments') }}" method="post" id="paymentForm"> 
          @csrf  
        <div class="form-group">
       
         
          <label for="description">Descripción</label>
          <input name="description" value="{{ old('description') }}" id="description" type="text" class="form-control" placeholder="Describe brevemente la consulta" required>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="specialty">Especialidad</label>
            <select name="specialty_id" id="specialty" class="form-control" required>
              <option value="">Seleccionar especialidad</option>
              @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>{{ $specialty->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="email">Médico</label>
            <select name="doctor_id" id="doctor" class="form-control" required>
              @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="dni">Fecha</label>
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
            <input class="form-control datepicker" placeholder="Seleccionar fecha" 
              id="date" name="scheduled_date" type="text" 
              value="{{ old('scheduled_date', date('Y-m-d')) }}" 
              data-date-format="yyyy-mm-dd" 
              data-date-start-date="{{ date('Y-m-d') }}" 
              data-date-end-date="+30d">
          </div>
        </div>
        <div class="form-group">
          <label for="address">Hora de atención</label>
          <div id="hours">
            @if ($intervals)
              @foreach ($intervals['morning'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
              @foreach ($intervals['afternoon'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalAfternoon{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
            @else
              <div class="alert alert-info" role="alert">
                Seleccione un médico y una fecha, para ver sus horas disponibles.
              </div>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="type">Tipo de consulta</label>
          <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type1" type="radio"
              @if(old('type', 'Consulta') == 'Consulta') checked @endif value="Consulta">
            <label class="custom-control-label" for="type1">Consulta</label>
          </div>
          <label for="appointments_price">Precio</label>
          <div class="form-group">
            <input name="appointments_price" class="custom-control-input" id="appointments_price1" 
              @if(old('appointments_price', '50.00') == '50.00') checked @endif value="50.00">
            <label for="appointments_price1">S/.50.00</label>
          </div>
       {{--    <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type2" type="radio"
              @if(old('type') == 'Examen') checked @endif value="Examen">
            <label class="custom-control-label" for="type2">Examen</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type3" type="radio"
              @if(old('type') == 'Operación') checked @endif value="Operación">
            <label class="custom-control-label" for="type3">Operación</label>
          </div> --}}
        </div>
     {{--    <button type="submit" class="btn btn-primary">
          Guardar
        </button> --}}

          <div class="col-xl-7 ftco-animate">
          
            <label for="">Select the desired payment platform:</label>
            <div class="form-group" id="toggler">
              <div class="btn-group btn-group-toggle" data-toggle="buttons"> 
                @foreach ($paymentPlatforms as $paymentPlatform)
                  <label class="btn btn-outline-secondary rounded m-2 p-1"  data-target="#{{ $paymentPlatform->name }}Collapse" data-toggle="collapse" >
                    <input type="radio" name="payment_platform" value="{{ $paymentPlatform->id }}" required>
                    <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}">
                  </label>
                @endforeach
              </div>
              @foreach ($paymentPlatforms as $paymentPlatform)
              <div id="{{ $paymentPlatform->name }}Collapse" class="collapse" data-parent="#toggler">
                @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
              </div>
              @endforeach
                
            <div class="col-md-12">
                        <div class="form-group">
                  <p><button type="submit" id="payButton" class="btn btn-primary py-3 px-4"  >Paga Ahora</button></p>
                        </div>
                      </div>
                     </form>
                
          </div>
        </form>
  </div>
</div>

    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection