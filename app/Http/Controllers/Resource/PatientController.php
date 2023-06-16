<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\DeleteAnyRequest;
use App\Http\Requests\Resource\Patient\CreateRequest;
use App\Http\Requests\Resource\Patient\UpdateRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    public function create(CreateRequest $request)
    {
        $this->authorize('create', Patient::class);
        $data = $request->validated();
        Patient::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        $data = $request->validated();
        $patient->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Patient $patient)
    {
        $this->authorize('delete', $patient);
        $patient->delete();
        return back();
    }
    public function delete_any(DeleteAnyRequest $request)
    {
        $this->authorize('delete_any', Patient::class);
        $data = $request->validated();
        if (count($data['id']) == Patient::count()) {
            Patient::truncate();
        } else {
            Patient::destroy($data['id']);
        }
        return back();
    }
    public function restore(Patient $patient)
    {
        $this->authorize('restore', $patient);
        return abort(501);
    }
}
