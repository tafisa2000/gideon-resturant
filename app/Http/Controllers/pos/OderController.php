<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Modifier;
use App\Models\Table;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class OderController extends Controller
{
    //
    public function addOder()
    {
        $menu_item = MenuItem::all();
        $modifier = Modifier::all();
        $server = User::all();
        $table = Table::all();
        $invoice_data = 1;
        $sale_data = Order::orderBy('id', 'desc')->first();
        if ($sale_data == null) {
            $firstReg = '0';
            $sale_no = $firstReg + 1;
        } else {
            $sale_data = Order::orderBy('id', 'desc')->first()->sale_no;
            $sale_no = $sale_data + 1;
        }
        $date = date('Y-m-d');
        return view('backend.oder.add_oder', compact('menu_item', 'modifier', 'server', 'table', 'date', 'sale_no'));
    } // End method
}
