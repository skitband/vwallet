<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateWalletRequest;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get authenticated user id
        $id = auth()->id();
        $wallet = User::find($id)->wallet;

        return $wallet;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('wallet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWalletRequest $request)
    {
        $wallet = new Wallet;
        $id = auth()->id();

        $wallet->wallet_name = $request->wallet_name;
        $wallet->wallet_description = $request->wallet_description;
        $wallet->wallet_balance = 0;
        $wallet->user_id = $id;

        $wallet->save();

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
        return view('wallet.edit');
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
        $wallet = Wallet::find($id);

        return response()->json(['result' => $wallet]);
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
        // Update Wallet Details
        $wallet = Wallet::find($id);

        $wallet->wallet_name = $request->wallet_name;
        $wallet->wallet_description = $request->wallet_description;

        $wallet->save();

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
        $wallet = Wallet::find($id);

        $wallet->delete();

        return response()->json(['result' => 'success']);
    }

    public function walletTransaction($id)
    {
        return view('transaction.index');
    }

    public function walletTransactionList($id)
    {
        $transaction = Transaction::where('wallet_id', $id)->get();

        return $transaction;
    }
}
