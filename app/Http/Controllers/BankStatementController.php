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
                'items' => $each
            ];
        });
        return view('apps.statements', [
            'states' => $data->sortByDesc('statement_date'),
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
