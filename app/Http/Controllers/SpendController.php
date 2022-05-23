<?php

namespace App\Http\Controllers;

use App\Models\Spend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $spends = Spend::latest()->paginate(5);
//
//        return view('spends.index',compact('spends'))
//                ->with('i', (request()->input('page', 1) - 1) * 5);
        $user = optional(Auth::user())->id;
        $spends = Spend::where('user_id',$user)->get();
        $income = Spend::where('status','IN')->where('user_id',$user)->sum('amount');
        $expense = Spend::where('status','OUT')->where('user_id',$user)->sum('amount');
        $total = Spend::where('user_id',$user)->sum('amount');
        $profit = $income - $expense;
        if($profit < 0){
            $profit = 0;
        }

        return view('spends.index',compact('spends', 'income', 'expense','total', 'profit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spends.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'detail' => 'required',
            'amount' => 'required',
            'user_id' => 'required',
        ]);

        Spend::create($request->all());

        return redirect()->route('spends.index')
            ->with('success','Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show(Spend $spend)
    {
        return view('spends.show',compact('spend'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit(Spend $spend)
    {
        return view('spends.edit',compact('spend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spend $spend)
    {
        $request->validate([
            'status' => 'required',
            'detail' => 'required',
            'amount' => 'required',
        ]);

        $spend->update($request->all());

        return redirect()->route('spends.index')
            ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spend $spend)
    {
        $spend->delete();

        return redirect()->route('spends.index')
            ->with('success','Deleted successfully');
    }
}
