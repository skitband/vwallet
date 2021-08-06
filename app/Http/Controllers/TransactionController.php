<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('transaction.create', ['name' => 'Victoria']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        //
        $transaction = new Transaction;

        $transaction->transaction_type = $request->transaction_type;
        $transaction->transaction_amount = $request->transaction_amount;
        $transaction->wallet_id = $request->wallet_id;

        $transaction->save();

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $transaction = Transaction::find($id);

        $transaction->transaction_isFraud = 1;

        $transaction->save();

        return response()->json(['message' => 'success']);
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
        $transaction = Transaction::find($id);

        $transaction->delete();

        return response()->json(['result' => 'success']);
    }

    public function create_transaction_wallet($id)
    {
        //
        $wallet = Wallet::find($id);

        return view('transaction.create', ['walletId' => $wallet->id]);
    }

    public function total_transactions($id)
    {
        $transaction_incoming = Transaction::where('transaction_type', 'incoming')->where('wallet_id', $id)->sum('transaction_amount');

        $transaction_outgoing = Transaction::where('transaction_type', 'outgoing')->where('wallet_id', $id)->sum('transaction_amount');

        return response()->json([
            'result' => 'success',
            'incoming' => $transaction_incoming,
            'outgoing' => $transaction_outgoing,
        ]);
    }
}
