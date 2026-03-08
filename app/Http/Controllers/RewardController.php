<?php

namespace App\Http\Controllers;

use App\Mail\VoucherMail;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RewardController extends Controller
{
    public function useVoucher($id)
    {
        $redemption = Redemption::findOrFail($id);

        // Optional safety check: only allow owner to use it
        if ($redemption->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 403);
        }

        if (($redemption->status ?? 'owned') === 'used') {
            return response()->json([
                'message' => 'Voucher already used.'
            ], 400);
        }

        $user = Auth::user();

        if (!$user || !$user->email) {
            return response()->json([
                'message' => 'User email not found.'
            ], 400);
        }

        Mail::to($user->email)->send(
            new VoucherMail($redemption)
        );

        $redemption->status = 'used';
        $redemption->save();

        return response()->json([
            'message' => 'Voucher email sent successfully.'
        ]);
    }
}