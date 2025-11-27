<?php
namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('subadmin.attendance.list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'location' => 'required',
            'datetime' => 'required',
        ]);

        // Handle base64 photo saving
        $base64 = $request->input('photo');
        $base64 = str_replace('data:image/png;base64,', '', $base64);
        $base64 = str_replace(' ', '+', $base64);

        $filename = 'attendance_' . uniqid() . '.png';
        $filePath = 'attendance/' . $filename;

        Storage::put("public/" . $filePath, base64_decode($base64));

        // Convert ISO datetime to MySQL format
        $datetime = Carbon::parse($request->datetime)->format('Y-m-d H:i:s');

        Attendance::create([
            'photo' => 'storage/' . $filePath,
            'location' => $request->location,
            'datetime' => $datetime,
        ]);

        return redirect()->back()->with('success', 'Attendance submitted');
    }
    
    
    
 public function showList()
{
    $attendances = \DB::table('attendances')
        ->leftJoin('employees', 'attendances.employee_id', '=', 'employees.id')
        ->select(
            'attendances.*',
            'employees.name as employee_name',
            'employees.email',
            'employees.phone',
            'employees.designation',
            'employees.address',
            'employees.date',
            'employees.time'
        )
        ->orderByDesc('attendances.id')
        ->get();

    return view('subadmin.attendance.list', compact('attendances'));
}


}
