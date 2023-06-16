<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\DeleteAnyRequest;
use App\Http\Requests\Resource\Midwife\CreateRequest;
use App\Http\Requests\Resource\Midwife\UpdateRequest;
use App\Models\Midwife;

class MidwifeController extends Controller
{
    public function create(CreateRequest $request)
    {
        $this->authorize('create', Midwife::class);
        $data = $request->validated();
        Midwife::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Midwife $midwife)
    {
        $this->authorize('update', $midwife);
        $data = $request->validated();
        $midwife->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Midwife $midwife)
    {
        $this->authorize('delete', $midwife);
        $midwife->delete();
        return back();
    }
    public function delete_any(DeleteAnyRequest $request)
    {
        $this->authorize('delete_any', Midwife::class);
        $data = $request->validated();
        if (count($data['id']) == Midwife::count()) {
            Midwife::truncate();
        } else {
            Midwife::destroy($data['id']);
        }
        return back();
    }
    public function restore(Midwife $midwife)
    {
        $this->authorize('restore', $midwife);
        return abort(501);
    }
}
