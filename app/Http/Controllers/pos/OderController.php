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
use Barryvdh\DomPDF\Facade\Pdf;




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
            $sale_data = Order::orderBy('id', 'desc')->first()->order_no;
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
                    $saleItem->modifier_id = 2;
                    $saleItem->quantity = $request->quantity[$i];
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

    public function PendingOrder()
    {

        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.oder.pending_order', compact('orders'));
    } // End Method

    public function OrderDetails($order_id)
    {

        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItem);
        // $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.oder.order_details', compact('order', 'orderItem'));
    } // End Method


    public function OrderStatusUpdate(Request $request)
    {

        $order_id = $request->id;

        // $product = Orderdetails::where('order_id', $order_id)->get();
        // foreach ($product as $item) {
        //     Product::where('id', $item->product_id)
        //         ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);

        //     $item->status = 'complete';
        //     $item->save();
        // }

        Order::findOrFail($order_id)->update(['status' => 'completed']);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.oder')->with($notification);
    } // End Method

    public function CompleteOrder()
    {

        $orders = Order::where('status', 'completed')->orderBy('id', 'DESC')->get();
        return view('backend.oder.complete_order', compact('orders'));
    } // End Method

    public function PrintSale($id)
    {
        $order = Order::where('id', $id)->first();
        $orderItem = OrderItem::where('order_id', $order->id)->get();

        $pdf = Pdf::loadView('backend.oder.bill', compact('order', 'orderItem'))->setPaper('a5')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),

        ]);
        return $pdf->download('invoice.pdf');
    } // End method

}
