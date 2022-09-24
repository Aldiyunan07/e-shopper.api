<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Transaction;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

// use Session;/
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderby('created_at', 'desc')->get();
        return view('transaction.index',compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        if($transaction->read_at == null) $this->read_at($id);
        $detail = Detail::where('transaction_id', $id)->with('product')->get();
        return view('transaction/show',compact('transaction','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function mark()
    {
        $transaction = Transaction::where('read_at', null)->get();
        foreach ($transaction as $value) {            
            $value->update([
                'read_at' => now()
            ]);
            $value->save();
        }
        View::share('countTransaction', Transaction::where('read_at', null)->get());
        return redirect('/transaction');
    }

    public function read_at($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'read_at' => now() 
        ]);
        $transaction->save();
        View::share('countTransaction', Transaction::where('read_at', null)->get());

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;

        $item->save();
        return redirect('/transaction');
    } 
}
