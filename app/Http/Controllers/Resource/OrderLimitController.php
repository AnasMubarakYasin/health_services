<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\OrderLimit\StoreRequest;
use App\Http\Requests\Resource\OrderLimit\UpdateRequest;
use App\Models\OrderLimit;
use Illuminate\Http\Request;

class OrderLimitController extends Controller
{
    public function create(StoreRequest $request)
    {
        $this->authorize('create', OrderLimit::class);
        $data = $request->validated();
        OrderLimit::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, OrderLimit $order_limit)
    {
        $this->authorize('update', $order_limit);
        $data = $request->validated();
        $order_limit->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(OrderLimit $order_limit)
    {
        $this->authorize('delete', $order_limit);
        $order_limit->delete();
        return back();
    }
    public function delete_any(Request $request)
    {
        $this->authorize('delete_any', OrderLimit::class);
        if ($request->input('all')) {
            OrderLimit::truncate();
        } else {
            OrderLimit::destroy($request->input('id', []));
        }
        return back();
    }
    public function restore(OrderLimit $order_limit)
    {
        $this->authorize('restore', $order_limit);
        return abort(501);
    }
}
