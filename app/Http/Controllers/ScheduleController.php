<?php

namespace App\Http\Controllers;
use App\Events\ClassCanceled;
use App\Models\ScheduledClass;
use App\Models\ClassType;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduledClasses = auth()->user()->scheduledClasses()->upcoming()->oldest('date_time')->get();
        
        return view('instructor.upcoming')->with('scheduledClasses',$scheduledClasses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classTypes = ClassType::all(); 
        return view('instructor.schedule')->with('classTypes',$classTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date_time = $request->input('date')." ".$request->input('time');
        $request->merge([
            'date_time' => $date_time,
            'instructor_id' => auth()->id()
        ]);
        $validated = $request->validate([
            'date_time' => 'required|unique:scheduled_classes,date_time|after:now',
            'instructor_id' => 'required',
            'class_type_id' => 'required'
        ]);
        
        ScheduledClass::create($validated);
        return redirect()->route('schedule.index');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledClass $schedule)
    { 
        // normal Method
        // if(auth()->user()->id()!== $schedule->instructor_id){            
        //     abort(403);
        // }
        // using policy
        if(auth()->user()->cannot('delete',$schedule)){
            abort(403);
        }
        
        ClassCanceled::dispatch($schedule);
        $schedule->members()->detach();
        $schedule->delete();
        
        return redirect()->route('schedule.index');
        
    }
}
