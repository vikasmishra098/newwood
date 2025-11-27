<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::where('customer_id', auth()->id())
            ->where('status', 'processing')
            ->get();

        return view('customer.attendance.attendance', compact('employees'));
    }

    public function store(Request $request)
    {
        // 1) Save the attendance photo
        $base64   = str_replace('data:image/png;base64,', '', $request->photo);
        $base64   = str_replace(' ', '+', $base64);
        $filename = 'attendance_' . uniqid() . '.png';
        $filePath = 'attendance/' . $filename;

        Storage::disk('public')->put($filePath, base64_decode($base64));

        // 2) Use server-side current datetime (Laravel timezone)
        $datetime = Carbon::now();

        // 3) Save attendance
        Attendance::create([
            'employee_id' => $request->employee_id,
            'name'        => $request->name,
            'photo'       => 'storage/' . $filePath,
            'location'    => $request->location,
            'datetime'    => $datetime,
            'type'        => 'in',
        ]);

        return redirect()->back()->with('success', 'Attendance Submitted Successfully!');
    }

    public function showList()
    {
        $attendances = Attendance::latest()->get();
        return view('customer.attendance.list', compact('attendances'));
    }

    public function logoutForm()
    {
        return view('customer.attendance.logout');
    }

    public function logoutStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'photo'    => 'required',
            'location' => 'required',
            'datetime' => 'required',
        ]);

        // Save logout photo
        $image     = str_replace('data:image/png;base64,', '', $request->photo);
        $image     = str_replace(' ', '+', $image);
        $imageName = 'logout_' . uniqid() . '.png';

        Storage::disk('public')->put('attendance/' . $imageName, base64_decode($image));

        // Fix datetime (convert to IST safely)
        $datetime = Carbon::parse($request->datetime, 'Asia/Kolkata')->format('Y-m-d H:i:s');

        Attendance::create([
            'name'     => $request->name,
            'photo'    => 'storage/attendance/' . $imageName,
            'location' => $request->location,
            'datetime' => $datetime,
            'type'     => 'out',
        ]);

        return redirect()->route('attendance.list')->with('success', 'Logout marked successfully.');
    }
}
