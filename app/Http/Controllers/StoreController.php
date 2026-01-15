<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreItem;
use App\Models\Redemption;
use App\Services\StoreService;

class StoreController extends Controller
{
    public function index()
    {
        $items = StoreItem::where('is_active', true)->get();
        return view('store.index', compact('items'));
    }

    public function redeem($id, StoreService $service)
    {
        $item = StoreItem::findOrFail($id);
        $service->redeem(auth()->user(), $item);

        return back()->with('success', 'Redeemed!');
    }

    public function inventory()
    {
        $redemptions = Redemption::with('storeItem')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('inventory.index', compact('redemptions'));
    }
}
