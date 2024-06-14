<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Order;
use App\Models\Address;
use App\Models\Shipping;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\ProductAssessment;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with([
            'user', 
            'product', 
            'cartProducts.product', 
            'cartProducts.cart', 
            'shippingMethod', 
            'productAssessment.product'
            ])
            ->whereNotIn('order_status', ['unpaid', 'pending'])
            ->when($request->order_status , function ($query) use ($request) {
                $query->where('order_status', $request->order_status);
            })->paginate(20);

        foreach ($orders as $order) {
            $order->formatted_status = $this->getStatusLabel($order->order_status);
        }

        $prosesCount = Order::where('order_status', 'proceed')
        ->orWhere('order_status', 'shipped')
        ->orWhere('order_status', 'completed')->count();
        $shippedCount = Order::where('order_status', 'shipped')
        ->orWhere('order_status', 'completed')->count();
        $completedCount = Order::where('order_status', 'completed')->count();

        return view('OPERATOR.partial.main', 
        compact('orders', 'prosesCount', 'shippedCount', 'completedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */

    private function getStatusLabel($status)
    {
        $statusLabels = [
            'unpaid' => 'Unpaid',
            'pending' => 'Pending',
            'paid' => 'PAID',
            'failed' => 'Failed',
            'proceed' => 'PROSES',
            'shipped' => 'SHIPPED',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'completed' => 'COMPLETED',
        ];

        return $statusLabels[$status] ?? $status;
    }

    public function filterOrders($category)
    {
        $filteredOrders = Order::where('order_status', $category)->get();

        return response()->json($filteredOrders);
    }


    public function updateProses(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->input('order_status');
        $order->save();

        return response()->json(['success' => 'Order status updated successfully.']);
    }

    public function updateShipping(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $shipping = $order->shipping;

        $shipping->resi = $request->input('resi');
        $shipping->save();

        return response()->json(['success' => 'Shipping information updated successfully.']);
    }

    public function updateCompleted(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'completed';
        $order->save();

        return response()->json(['success' => true]);
    }

    public function updateResi(Request $request)
    {
        $orderId = $request->input('orderId');
        $newResi = $request->input('resi');

        $request->validate([
            'orderId' => 'required|exists:order,id',
            'resi' => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($orderId);

        $shipping = Shipping::findOrFail($order->shipping_id);

        $shipping->resi = $newResi;
        $shipping->save();

        return response()->json(['success' => true, 'message' => 'Resi updated successfully']);
    }

    public function responseOperator(Request $request, $id)
    {
        \Log::info('Assessment ID: ' . $id);
        \Log::info('Request Data: ' . json_encode($request->all()));

        $assessment = ProductAssessment::find($id);

        if ($assessment) {
            $assessment->response_operator = $request->input('response_operator');
            $assessment->save();

            return response()->json(['success' => true, 'message' => 'Response saved successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Assessment not found.'], 404);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
