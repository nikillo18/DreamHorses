<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Horse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\FiltersByUserRole;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        use FiltersByUserRole;

    public function index(Request $request)
    {
        $query = Expense::with('horse')->latest();

        $query = $this->filterByUserRole($query);

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('horse', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $expenses = $query->get();
        if ($request->filled('from_month')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m', $request->input('from_month'))->startOfMonth();
            $query->where('date', '>=', $from);
        }

        if ($request->filled('to_month')) {
            $to = \Carbon\Carbon::createFromFormat('Y-m', $request->input('to_month'))->endOfMonth();
            $query->where('date', '<=', $to);
        }

        $expenses = $query->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horses = $this->getUserHorses();
        return view('expenses.create', compact('horses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Expense creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $horses = $this->getUserHorses();
        return view('expenses.edit', compact('expense', 'horses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Gastos subidos exitosamente .');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Se borro correctamente.');
    }

    public function chart(Request $request)
    {
        $meses = [
            'January'   => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April'     => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July'      => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October'   => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];
        $meses_abrev = [
            'Jan' => 'Ene',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Abr',
            'May' => 'May',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ago',
            'Sep' => 'Sep',
            'Oct' => 'Oct',
            'Nov' => 'Nov',
            'Dec' => 'Dic'
        ];

        // === Bar Chart (Current month + 12 previous months) ===
        $monthLabels = [];
        $monthlyTotals = [];

        // Initialize last 13 months with 0 total, and create labels from oldest to newest
        for ($i = 12; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $monthlyTotals[$monthKey] = 0;

            $monthAbbr = $date->format('M');
            $year = $date->format('Y');
            $monthLabels[] = $meses_abrev[$monthAbbr] . ' ' . $year;
        }

        $startDateForBar = Carbon::now()->subMonths(12)->startOfMonth();
        $endDateForBar = Carbon::now()->endOfMonth();

        $monthlyExpenses = Expense::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->whereBetween('date', [$startDateForBar, $endDateForBar])
            ->groupByRaw('YEAR(date), MONTH(date)')
            ->get();

        foreach ($monthlyExpenses as $expense) {
            $monthKey = $expense->year . '-' . str_pad($expense->month, 2, '0', STR_PAD_LEFT);
            if (isset($monthlyTotals[$monthKey])) {
                $monthlyTotals[$monthKey] = (float) $expense->total;
            }
        }

        $monthData = array_values($monthlyTotals);


        // === Pie Chart (Date Range) ===
        $availableMonths = Expense::selectRaw('DISTINCT YEAR(date) as year, MONTH(date) as month')
            ->orderByRaw('YEAR(date) ASC, MONTH(date) ASC')
            ->get()
            ->mapWithKeys(function ($item) use ($meses) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                $monthName = $date->format('F');
                $year = $date->format('Y');
                return [$date->format('Y-m') => $meses[$monthName] . ' ' . $year];
            });

        // Determine default start month. If there's more than one month, default to the second to last one. Otherwise, the last one.
        $defaultStartMonth = $availableMonths->keys()->get(1) ?? $availableMonths->keys()->first() ?? Carbon::now()->subMonth()->format('Y-m');
        $defaultEndMonth = $availableMonths->keys()->first() ?? Carbon::now()->format('Y-m');

        $startMonth = $request->input('start_month', $defaultStartMonth);
        $endMonth = $request->input('end_month', $defaultEndMonth);

        $startDateForPie = Carbon::createFromFormat('Y-m', $startMonth)->startOfMonth();
        $endDateForPie = Carbon::createFromFormat('Y-m', $endMonth)->endOfMonth();


        $categoryExpenses = Expense::selectRaw('category, SUM(amount) as total')
            ->whereBetween('date', [$startDateForPie, $endDateForPie])
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $categoryLabels = $categoryExpenses->pluck('category');
        $categoryData = $categoryExpenses->pluck('total')->map(fn($t) => (float) $t);

        return view('expenses.chart', compact(
            'monthLabels',
            'monthData',
            'categoryLabels',
            'categoryData',
            'availableMonths',
            'startMonth',
            'endMonth'
        ));
    }
    public function summary(Request $request)
    {
        $meses = [
            'January'   => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April'     => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July'      => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October'   => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        $availableMonths = Expense::selectRaw('DISTINCT YEAR(date) as year, MONTH(date) as month')
            ->orderByRaw('YEAR(date) ASC, MONTH(date) ASC')
            ->get()
            ->mapWithKeys(function ($item) use ($meses) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                $monthName = $date->format('F');
                $year = $date->format('Y');
                return [$date->format('Y-m') => $meses[$monthName] . ' ' . $year];
            });

        $query = DB::table('expenses')
            ->select('category', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('category')
            ->orderBy('category', 'asc');

        if ($request->filled('from_month')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m', $request->input('from_month'))->startOfMonth();
            $query->where('date', '>=', $from);
        }

        if ($request->filled('to_month')) {
            $to = \Carbon\Carbon::createFromFormat('Y-m', $request->input('to_month'))->endOfMonth();
            $query->where('date', '<=', $to);
        }

        $monthlyCategorySummary = $query->get();

        $totalGeneral = $monthlyCategorySummary->sum('total_amount');

        return view('expenses.summary', compact('monthlyCategorySummary', 'totalGeneral', 'availableMonths'));
    }

    public function downloadSummaryPdf(Request $request)
    {
        $meses = [
            'January'   => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April'     => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July'      => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October'   => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        $query = DB::table('expenses')
            ->select('category', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('category')
            ->orderBy('category', 'asc');

        $fromMonth = null;
        $fromMonthFormatted = null;
        if ($request->filled('from_month')) {
            $from = Carbon::createFromFormat('Y-m', $request->input('from_month'))->startOfMonth();
            $query->where('date', '>=', $from);
            $fromMonth = $request->input('from_month');
            $date = Carbon::createFromFormat('Y-m', $fromMonth);
            $fromMonthFormatted = $meses[$date->format('F')] . ' ' . $date->format('Y');
        }

        $toMonth = null;
        $toMonthFormatted = null;
        if ($request->filled('to_month')) {
            $to = Carbon::createFromFormat('Y-m', $request->input('to_month'))->endOfMonth();
            $query->where('date', '<=', $to);
            $toMonth = $request->input('to_month');
            $date = Carbon::createFromFormat('Y-m', $toMonth);
            $toMonthFormatted = $meses[$date->format('F')] . ' ' . $date->format('Y');
        }

        $monthlyCategorySummary = $query->get();
        $totalGeneral = $monthlyCategorySummary->sum('total_amount');

        $pdf = Pdf::loadView('expenses.summary_pdf', [
            'monthlyCategorySummary' => $monthlyCategorySummary,
            'totalGeneral' => $totalGeneral,
            'fromMonth' => $fromMonth,
            'toMonth' => $toMonth,
            'fromMonthFormatted' => $fromMonthFormatted,
            'toMonthFormatted' => $toMonthFormatted,
        ]);

        return $pdf->download('resumen-de-gastos.pdf');
    }
}
