<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Service\StoreRequest;
use App\Http\Requests\Resource\Service\UpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create(StoreRequest $request)
    {
        $this->authorize('create', Service::class);
        $data = $request->validated();
        Service::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Service $service)
    {
        $this->authorize('update', $service);
        $data = $request->validated();
        $service->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Service $service)
    {
        $this->authorize('delete', $service);
        $service->delete();
        return back();
    }
    public function delete_any(Request $request)
    {
        $this->authorize('delete_any', Service::class);
        if ($request->input('all')) {
            Service::truncate();
        } else {
            Service::destroy($request->input('id', []));
        }
        return back();
    }
    public function restore(Service $service)
    {
        $this->authorize('restore', $service);
        return abort(501);
    }
}
