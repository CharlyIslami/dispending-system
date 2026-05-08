<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Wallet;


class WalletController extends Controller
{
    public function index() {
        $user = Auth::user();
        $wallets = $user->wallets;
        return response()->json($wallets);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'currency_id' => 'required',
            'name' => 'required|string'
        ]); 

        $user = Auth::user();
        $wallet = $user->wallets()->create([
            'currency_id' => $validated['currency_id'],
            'name' => $validated['name'],
        ]);
        return response()->json($wallet);
    }

    public function show($id) {
        $user = Auth::user();
        $wallet = Wallet::find($id);
        if ($wallet->user_id == $user->id) {
            return response()->json($wallet);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'currency_id' => 'required',
            'name' => 'required|string',
        ]);

        $user = Auth::user();
        $wallet = Wallet::find($id);
        if ($wallet->user_id == $user->id) {
            $wallet->update($validated);
            return response()->json($wallet->fresh());
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function destroy($id) {
        $user = Auth::user();
        $wallet = Wallet::find($id);

        if ($wallet->user_id == $user->id) {
            $wallet->delete();
            return response()->json(['message' => 'Berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
