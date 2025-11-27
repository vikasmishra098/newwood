<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Performance;
use App\Models\User;
use App\Models\Attendance;
use App\Models\CompanyProfit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Get all users
        $users = User::orderBy('name')->get();
        $selectedUserId = $request->user_id ?? ($users->first()->id ?? null);

        // Get attendance records with employee relation
        $attendances = Attendance::with('employee')->orderBy('datetime','desc')->get();

        // Employees list for dropdowns
        $employees = User::where('role', '!=', 'admin')->orderBy('name')->get();

        // Performance Chart Data
        $years = Performance::where('user_id', $selectedUserId)
                    ->selectRaw('YEAR(date) as year')
                    ->distinct()
                    ->pluck('year');
        $selectedYear = $request->year ?? date('Y');

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        $performances = Performance::where('user_id', $selectedUserId)
                        ->whereYear('date', $selectedYear)
                        ->get();

        $totalOnTime = [];
        $totalLate = [];

        foreach ($months as $num => $name) {
            $monthPerf = $performances->filter(function ($item) use ($selectedYear, $num) {
                return date('Y-m', strtotime($item->date)) === $selectedYear.'-'.str_pad($num,2,'0',STR_PAD_LEFT);
            });
            $totalOnTime[$num] = $monthPerf->where('score', 1)->count();
            $totalLate[$num]   = $monthPerf->where('score', -1)->count();
        }

        // Company Profit Chart Data
        $profitYears = CompanyProfit::selectRaw('YEAR(entry_date) as year')->distinct()->pluck('year');
        $selectedProfitYear = $request->profit_year ?? date('Y');

        $profits = CompanyProfit::selectRaw('MONTH(entry_date) as month, SUM(profit_amount) as total_profit, SUM(loss_amount) as total_loss')
                    ->whereYear('entry_date', $selectedProfitYear)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $profitMonths = [];
        $profitData   = [];
        $lossData     = [];
        foreach ($profits as $row) {
            $profitMonths[] = Carbon::create()->month($row->month)->format('F');
            $profitData[]   = $row->total_profit;
            $lossData[]     = $row->total_loss;
        }

        // Attendance Performance counts for chart
       // Attendance Performance Counts
$attendancePerformance = [
    'Good' => $attendances->filter(function($a){
        if(!$a->employee?->date || !$a->employee?->time) return false;
        $diff = \Carbon\Carbon::parse($a->employee->date . ' ' . $a->employee->time)
                    ->diffInMinutes(\Carbon\Carbon::parse($a->datetime), false);
        return $diff <= 0;
    })->count(),
    'Poor' => $attendances->filter(function($a){
        if(!$a->employee?->date || !$a->employee?->time) return false;
        $diff = \Carbon\Carbon::parse($a->employee->date . ' ' . $a->employee->time)
                    ->diffInMinutes(\Carbon\Carbon::parse($a->datetime), false);
        return $diff > 0 && $diff <= 30;
    })->count(),
    'Bad' => $attendances->filter(function($a){
        if(!$a->employee?->date || !$a->employee?->time) return false;
        $diff = \Carbon\Carbon::parse($a->employee->date . ' ' . $a->employee->time)
                    ->diffInMinutes(\Carbon\Carbon::parse($a->datetime), false);
        return $diff > 30;
    })->count(),
];




        return view('home', compact(
            'months','totalOnTime','totalLate','years','selectedYear','users','selectedUserId',
            'profitYears','selectedProfitYear','profitMonths','profitData','lossData',
            'attendances','employees','attendancePerformance'
        ));
    }

    // Optional: AJAX method for performance chart update
    public function homeSummary(Request $request)
    {
        $authUser = Auth::user();
        $role = $authUser->role;

        $userId = in_array($role, ['admin','subadmin']) ? $request->user_id : $authUser->id;
        $year   = $request->year ?? date('Y');

        $performances = Performance::where('user_id', $userId)
                            ->whereYear('date', $year)
                            ->get();

        $months = [
            1 => 'Jan',2 => 'Feb',3 => 'Mar',4 => 'Apr',
            5 => 'May',6 => 'Jun',7 => 'Jul',8 => 'Aug',
            9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dec'
        ];

        $totalOnTime = [];
        $totalLate   = [];

        foreach($months as $num => $name){
            $monthPerf = $performances->filter(function($item) use($year, $num){
                return date('Y-m', strtotime($item->date)) === $year.'-'.str_pad($num,2,'0',STR_PAD_LEFT);
            });

            $totalOnTime[$num] = $monthPerf->where('score', 1)->count();
            $totalLate[$num]   = $monthPerf->where('score', -1)->count();
        }

        return view('customer.partials.performance_chart', compact('months','totalOnTime','totalLate'));
    }
}
