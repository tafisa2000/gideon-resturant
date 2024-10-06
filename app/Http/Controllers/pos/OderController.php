<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Modifier;
use App\Models\OrderItem;
use App\Models\table;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class OderController extends Controller
{
    //
    public function addOder()
    {
        $menu_item = MenuItem::all();
        $table_item = MenuItem::all();
        $modifier = Modifier::all();
        $server = User::all();
        $table = table::all();
        $invoice_data = 1;
        $sale_data = Order::orderBy('id', 'desc')->first();
        if ($sale_data == null) {
            $firstReg = '0';
            $order_no = $firstReg + 1;
        } else {
            $sale_data = Order::orderBy('id', 'desc')->first()->sale_no;
            $order_no = $sale_data + 1;
        }
        $date = date('Y-m-d');
        return view('backend.oder.add_oder', compact('menu_item', 'modifier', 'server', 'table', 'date', 'order_no'));
    } // End method

    public function oderStore(Request $request)
    {
        if (is_null($request->menu_item_id)) {
            return redirect()->back()->with([
                'message' => 'Sorry, you did not select any items',
                'alert-type' => 'error'
            ]);
        } elseif (is_null($request->user_id)) {
            return redirect()->back()->with([
                'message' => 'Sorry, you did not select any server',
                'alert-type' => 'error'
            ]);
        } elseif (is_null($request->table_id)) {
            return redirect()->back()->with([
                'message' => 'Sorry, you did not select any table',
                'alert-type' => 'error'
            ]);
        }

        $sale = new Order();
        $sale->order_no = $request->order_no;
        $sale->date = date('Y-m-d', strtotime($request->date));
        $sale->description = $request->description;
        $sale->table_id = $request->table_id;
        $sale->user_id = $request->user_id;
        $sale->total_price = $request->cost;
        // $sale->created_by = Auth::user()->id;

        DB::transaction(function () use ($request, $sale) {
            if ($sale->save()) {
                for ($i = 0; $i < count($request->menu_item_id); $i++) {
                    $saleItem = new OrderItem();
                    $saleItem->order_id = $sale->id;
                    $saleItem->menu_item_id = $request->menu_item_id[$i];
                    $saleItem->modifier_id = $request->modifier_id[$i];
                    $saleItem->quantity = 0;
                    $saleItem->price = 0;
                    // $saleItem->created_by = Auth::user()->id;
                    $saleItem->save();
                }
            }
        });

        return redirect()->route('all.table')->with([
            'message' => 'Invoice Data Inserted Successfully',
            'alert-type' => 'success'
        ]);
    }
}