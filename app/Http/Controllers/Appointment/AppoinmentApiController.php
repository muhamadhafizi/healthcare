<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment\Appointment;
use App\Models\Patient\Patient;
use Hashids\Hashids;
use App\Models\Status\Status;

class AppoinmentApiController extends Controller
{
    /**
     * Show all appointment
     *
     * @param Appointment $appointment
     * @return Response
     */ 
    public function index()
    {
        $appointment = Appointment::with('patient', 'status')
                ->get();
        
        return response()->json(['data' => $appointment],200);
    }

    public function create()
    {
        //
    }

    /**
     * create appointment
     *
     * @param Appointment $appointment
     * @return Response
     */ 
    public function store(Request $request)
    {
        $patient = Patient::updateOrCreate(
            [ 'ic_number' => $request->patient['ic_number']],
            [
                'name' => $request->patient['name'],
                'phone' => $request->patient['phone'],
            ]
        );

        $status = Status::where('name', 'pending')->first();
        $customAlphabet = implode('', range('A', 'Z')) . implode('', range('0', '9'));
        $hashids = new Hashids('', 6, $customAlphabet);

        $appointmentData = [
            'appointment_date' => $request->appointment['appointment_date'],
            'patient_id' => $patient->id,
            'status_id' => $status->id,
        ];

        $appointment = Appointment::create($appointmentData);
        
        $code = $hashids->encode($appointment->id);
        $appointment->update(["code"=>$code]);

        return response()->json(['data' => $appointment],200);
    }

    /**
     * Show appointment details
     *
     * @param Appointment $appointment
     * @return Response
     */ 
    public function show(Appointment $appointment)
    {
        $appointment = Appointment::where('id', $appointment->id)
            ->with('patient', 'status')
            ->first();
        
        return response()->json(['data' => $appointment],200);
    }

    /**
     * Update reschedule and update status
     *
     * @param Appointment $appointment
     * @return Response
     */ 
    public function update(Request $request, Appointment $appointment)
    {
        if(!empty($request->appointment_date) && $request->appointment_date != $appointment->appointment_date){

            $status = Status::where('name', 'pending')->first();
            $customAlphabet = implode('', range('A', 'Z')) . implode('', range('0', '9'));
            $hashids = new Hashids('', 6, $customAlphabet);
            
            $appointmentData = [
                'appointment_date' => $request->appointment['appointment_date'],
                'patient_id' => $appointment->patient_id,
                'status_id' => $status->id,
            ];
    
            $newAppointment = Appointment::create($appointmentData);
            $code = $hashids->encode($newAppointment->id);
            $newAppointment->update(["code"=>$code]);

            $status = Status::where('name', 'rescheduled')->first();
            $appointment->update(['status_id' => $status->id]);

        }else{
            $appointment->update($request->toArray());
        }

        $appointment = $appointment->refresh();

        return response()->json(['data' => $appointment],200);
    }

    public function destroy()
    {
        //
    }

   
}
