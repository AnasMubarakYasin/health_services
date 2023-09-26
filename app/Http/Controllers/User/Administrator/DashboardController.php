<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Administrator;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $visitors = new stdClass();
        $visitors->name = "visitor today";
        $visitors->icon = Blade::render('<x-icons.user_group stroke="2" />');
        $visitors->count = 100;
        $visitors->subcount = "200 yesterday";

        $service = Service::statable()->init(
            name: "service",
            icon: Blade::render('<x-icons.square stroke="2" />'),
        )->resourcing();
        $schedule = Schedule::statable()->init(
            name: "schedule",
            icon: Blade::render('<x-icons.calendar stroke="2" />'),
        )->resourcing();
        $order = Order::statable()->init(
            name: "orders",
            icon: Blade::render('<x-icons.shop_bag stroke="2" />'),
        )->resourcing();

        $patient = Patient::statable()->init(
            name: "patient",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        $midwife = Midwife::statable()->init(
            name: "midwife",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        $administrator = Administrator::statable()->init(
            name: "administrator",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        return view('pages.administrator.dashboard', [
            'visitors' => $visitors,

            'service' => $service,
            'schedule' => $schedule,
            'order' => $order,

            'patient' => $patient,
            'midwife' => $midwife,
            'administrator' => $administrator,
        ]);
    }
    public function database()
    {
        return view('pages.administrator.database', [
            'tables' => DB::connection()->getDoctrineSchemaManager()->listTables(),
        ]);
    }
    public function database_download()
    {
        $database = [];
        foreach (DB::connection()->getDoctrineSchemaManager()->listTableNames() as $table) {
            $database[$table] = DB::table($table)->get()->toArray();
        }
        Storage::put('database.json', json_encode($database, JSON_PRETTY_PRINT), 'public');
        return Storage::download('database.json');
    }
    public function database_upload(Request $request)
    {
        $database = json_decode($request->file('database')->get(), true);
        foreach ($database as $table => $value) {
            DB::table($table)->truncate();
            if ($database[$table]) {
                DB::table($table)->insert($value);
            }
        }
        return to_route('web.administrator.database');
    }
    public function table(int $table)
    {
        // dd(DB::connection()->getDoctrineSchemaManager()->listTables()[0]->getColumns()[0]->getLength()));
        return view('pages.administrator.table', [
            'table' => DB::connection()->getDoctrineSchemaManager()->listTables()[$table],
        ]);
    }

    public function profile()
    {
        $resource = Administrator::formable()->from_update(
            model: auth()->user(),
            fields: [
                'photo',
                'name',
                'fullname',
                'address',
                'telp',
                'email',
            ],
        );
        return view('pages.administrator.profile', ['resource' => $resource]);
    }
    public function change_profile(Request $request)
    {
        /** @var Administrator */
        $user = auth()->user();
        $user->update($request->only([
            'photo',
            'name',
            'fullname',
            'address',
            'telp',
            'email',
        ]));
        return back();
    }
    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        /** @var User */
        $user = auth()->user();
        if (!auth()->validate(['name' => $user->name, 'password' => $data['password_current']])) {
            return back()->withErrors(["password_current" => ['password mismatch']]);
        }
        if ($data['password_current'] == $data['password']) {
            return back()->withErrors(["password" => ['new password cannot same with current password']]);
        }
        $user->password = $data['password'];
        $user->save();

        return back();
    }
    public function notification()
    {
        return view('pages.administrator.notification');
    }
    public function offline()
    {
        return view('pages.administrator.offline');
    }
    public function empty()
    {
        return view('pages.administrator.empty');
    }
}
