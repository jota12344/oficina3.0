<?php

namespace App\Http\Controllers;


use App\Http\Resources\BudgetResource;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::orderBy('id', 'DESC')->paginate();
    
        return view ('admin.budgets.index', compact('budgets'));
    }


        public function apiIndex()
    {
        return BudgetResource::collection(
            Budget::orderBy('id', 'DESC')->paginate(10)
        );
    }

    public function create()
    {
        return view ('admin.budgets.create');
    }

    public function store(StoreBudgetRequest $request)
    {
        $budget = Budget::create($request->validated());

        return redirect ()
                    ->route('budgets.index')
                    ->with('message','Orçamento criado com sucesso');
    }

    

    public function apiStore(StoreBudgetRequest $request)
    {
        $budget = Budget::create($request->validated());

        return (new BudgetResource($budget))
            ->response()
            ->setStatusCode(201);
    }


    public function show($id)
    {
        $budget = Budget::find($id);

        if(!$budget){
            return redirect()->route ('budgets.index');
        }

        return view ('admin.budgets.show', compact('budget'));

    }


    public function apiShow($id)
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['message' => 'Orçamento não encontrado'], 404);
        }

        return new BudgetResource($budget);
    }



    public function destroy($id)
    {
        $budget = Budget::find($id);

         if(!$budget){
            return redirect()->route ('budgets.index');
        }
        
        $budget->delete();

        return redirect()
                    ->route('budgets.index')
                    ->with('message', "Orçamento deletado com sucesso");
    }

    public function apiDestroy($id)
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['message' => 'Orçamento não encontrado'], 404);
        }

        $budget->delete();

        return response()->json(null, 204); // 204 No Content
    }


    public function edit($id)
    {
        $budget = Budget::find($id);

        if(!$budget){
            return redirect()->back()->with('error', 'Orçamento não encontrado');
        }

        return view('admin.budgets.edit', compact('budget'));
    }


    public function update(UpdateBudgetRequest $request, $id)
    {   
         $budget = Budget::find($id);

        if(!$budget){
            return redirect()->back()->with('error', 'Orçamento não encontrado');
        }

        $budget->update($request->validated());

        return redirect()
                    ->route('budgets.index')
                    ->with('message', 'Orçamento atualizado com sucesso');
    }


    public function apiUpdate(UpdateBudgetRequest $request, $id)
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['message' => 'Orçamento não encontrado'], 404);
        }

        $budget->update($request->validated());

        return new BudgetResource($budget);
    }



    public function search(Request $request)
{
    $filters = $request->all();

    $query = Budget::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $start = $request->start_date . ' 00:00:00';
        $end = $request->end_date . ' 23:59:59';

        $query->whereBetween('budget_datetime', [$start, $end]);
    }

    if ($request->filled('client')) {
        $query->where('client', 'LIKE', '%' . $request->client . '%');
    }

    if ($request->filled('seller')) {
        $query->where('seller', 'LIKE', '%' . $request->seller . '%');
    }

    $budgets = $query->orderBy('budget_datetime', 'desc')->paginate();

    return view('admin.budgets.index', compact('budgets', 'filters'));
}



}