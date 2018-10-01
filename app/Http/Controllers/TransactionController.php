<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Auth\Access\AuthorizationException;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function confirm(Request $request, $id) {
        $transaction = Transaction::find($id);
        try {
            $this->authorize('confirm', $transaction);
        } catch (AuthorizationException $exception) {
            return ['status' => 404, 'msg' => '您没有权限'];
        }
        $transaction->update('confirmed_at', Carbon::now());
        return ['status' => 200, 'msg' => 'success'];
    }

    public function request(Request $request) {
        try {
            $this->authorize('request', 'App\Transaction');
        } catch (AuthorizationException $exception) {
            return ['status' => 404, 'msg' => '您没有权限'];
        }
        $data = $request->all();
        $transaction = new Transaction([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $data['receiver'],
            'product_id' => $data['product'],
        ]);
        $transaction->save();
        return ['status' => 200, 'msg' => 'success'];
    }

    public function receive(Request $request, $id) {
        $transaction = Transaction::find($id);
        try {
            $this->authorize('receive', $transaction);
        } catch (AuthorizationException $exception) {
            return ['status' => 404, 'msg' => '您没有权限'];
        }
        $transaction->update('received_at', Carbon::now());
        return ['status' => 200, 'msg' => 'success'];
    }

    public function destroy(Request $request, $id) {
        $transaction = Transaction::find($id);
        try {
            $this->authorize('detroy', $transaction);
        } catch (AuthorizationException $exception) {
            return ['status' => 404, 'msg' => '您没有权限'];
        }
        $transaction->delete();
        return ['status' => 200, 'msg' => 'success'];
    }
}
