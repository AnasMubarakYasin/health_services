<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Order\StoreRequest;
use App\Http\Requests\Resource\Order\UpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(StoreRequest $request)
    {
        $this->authorize('create', Order::class);
        $data = $request->validated();
        Order::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Order $order)
    {
        $this->authorize('update', $order);
        $data = $request->validated();
        $order->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();
        return back();
    }
    public function delete_any(Request $request)
    {
        $this->authorize('delete_any', Order::class);
        if ($request->input('all')) {
            Order::truncate();
        } else {
            Order::destroy($request->input('id', []));
        }
        return back();
    }
    public function restore(Order $order)
    {
        $this->authorize('restore', $order);
        return abort(501);
    }
}
