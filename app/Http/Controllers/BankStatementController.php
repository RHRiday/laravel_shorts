<?php

namespace App\Http\Controllers;

use App\Models\BankStatement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BankStatementController extends Controller
{
    public function index()
    {
        $data = BankStatement::all()->groupBy('uniqId')->map(function ($each, $uniqId) {
            return [
                'uniqId' => $uniqId,
                'total_amount' => $each->sum('amount'),
                'statement_date' => Carbon::parse($each->min('created_at'))->format('d F Y'),
                'created_at' => Carbon::parse($each->min('created_at'))->format('Ymd'),
                'items' => $each
            ];
        });
        return view('apps.statements', [
            'states' => $data->sortByDesc('created_at'),
        ]);
    }
    public function create()
    {
        return view('apps.statement_add', [
            'prevStatements' => BankStatement::all()->groupBy('uniqId')->last() ?? [
                (object) [
                    'reference' => '',
                    'amount' => ''
                ]
            ],
        ]);
    }
    public function compare(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('apps.statement_compare');
        } else {
            $opening = BankStatement::whereDate('created_at', '<=', Carbon::parse($request->from_date)->endOfDay())->get()->groupBy('uniqId')->last();
            $opening ? $opening = $opening->sum('amount') : 0;
            $closing = BankStatement::whereDate('created_at', '<=', Carbon::parse($request->to_date)->startOfDay())->get()->groupBy('uniqId')->last();
            $closing ? $closing = $closing->sum('amount') : 0;

            return (object) [
                'opening_balance' => number_format($opening, 2),
                'closing_balance' => number_format($closing, 2),
                'diff_balance' => number_format(abs($closing - $opening), 2),
                'color' => $opening > $closing ? 'text-danger' : 'text-success',
            ];
        }
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $uniqId = Str::lower(Str::random(8));
            foreach ($request->reference as $key => $item) {
                if ($item != '' && $item != null) {
                    BankStatement::create([
                        'uniqId' => $uniqId,
                        'reference' => $request['reference'][$key],
                        'amount' => $request['amount'][$key] ?? 0,
                    ]);
                }
            }
            DB::commit();

            return redirect(route('statements.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
