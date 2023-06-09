<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Administrator\CreateRequest;
use App\Http\Requests\Resource\Administrator\UpdateRequest;
use App\Http\Requests\Resource\DeleteAnyRequest;
use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function create(CreateRequest $request)
    {
        $this->authorize('create', Administrator::class);
        $data = $request->validated();
        Administrator::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Administrator $administrator)
    {
        $this->authorize('update', $administrator);
        $data = $request->validated();
        $administrator->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Administrator $administrator)
    {
        $this->authorize('delete', $administrator);
        $administrator->delete();
        return back();
    }
    public function delete_any(DeleteAnyRequest $request)
    {
        $this->authorize('delete_any', Administrator::class);
        $data = $request->validated();
        if (count($data['id']) == Administrator::count()) {
            Administrator::truncate();
        } else {
            Administrator::destroy($data['id']);
        }
        return back();
    }
    public function restore(Administrator $administrator)
    {
        $this->authorize('restore', $administrator);
        return abort(501);
    }
}
