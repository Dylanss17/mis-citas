<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Appointment;
use App\CancelledAppointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;
use Validator;
use App\PaymentPlatform;
use App\Services\PaypalService; 

class AppointmentController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        // patient
        // doctor
        if($role == 'admin'){
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->paginate(10);

        } elseif($role == 'doctor'){
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('doctor_id', auth()->id())
                ->paginate(10);

        } elseif ($role == 'patient'){
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('patient_id', auth()->id())
                ->paginate(10);
        }
        

        return view('appointments.index', 
            compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments','role'));
    }

    public function show(Appointment $appointment)
    {

        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role')); 
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {
        
    	$specialties = Specialty::all();
        $paymentPlatforms = PaymentPlatform::all();
        
        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        
        $date = old('schedule_date');
        $doctorId = old('doctor_id');
        if($date && $doctorId) {
            $intervals = $scheduleService->getAvaliableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }
        

    	return view('appointments.create', compact('specialties', 'doctors','intervals'))->with([
            'paymentPlatforms' => $paymentPlatforms,
        ]);
    }

    public function store(StoreAppointment $request)
    {


        $rules = [
            'payment_platform' => 'required', 'exist:payment_platform,id',
        ];

        $request->validate($rules);
        $paymentPlatform = resolve(PaypalService::class);
        
        Appointment::createForPatient($request, auth()->id());
        return $paymentPlatform->handlePayment($request);

    	/* $notification = 'La cita se ha registrado correctamente!';
    	return back()->with(compact('notification')); */
        
    }

    public function showCancelForm(Appointment $appointment)
    {
        if($appointment->status == 'Confirmada'){
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }

        return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if($request->has('justification')){
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $saved = $appointment->save(); //update

        if($saved)
            $appointment->patient->sendFCM('Su cita se ha cancelado!');

        $notification = 'La cita se ha cancelado exitosamente.';
        return redirect('/appointments')->with(compact('notification'));
    }

    public function postConfirm(Appointment $appointment)
    {
        $appointment->status = 'Confirmada';
        $saved = $appointment->save(); //update

        if($saved)
            $appointment->patient->sendFCM('Su cita se ha confirmado!');

        $notification = 'La cita se ha confirmado exitosamente.';
        return redirect('/appointments')->with(compact('notification'));
    }
}