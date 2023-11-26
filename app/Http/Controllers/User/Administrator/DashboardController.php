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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\FileInfo;
use stdClass;
use ZipArchive;

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
        $orders_today = new stdClass();
        $orders_today->name = "orders today";
        $orders_today->count_all = Order::get_unfinish_today()->count();
        $orders_today->icon = Blade::render('<x-icons.shop_bag stroke="2" />');

        $orders_limit = new stdClass();
        $orders_limit->name = "orders limit";
        $orders_limit->count_all = Cache::get("orders_limit", ['limit' => ""])['limit'];
        $orders_limit->icon = Blade::render('<x-icons.shop_bag stroke="2" />');
        $orders_limit_action = new stdClass();
        $orders_limit_action->name = "change";
        $orders_limit_action->href = route('web.administrator.orders_limit_set');
        $orders_limit->actions = [$orders_limit_action];

        $location = new stdClass();
        $location->name = "location";
        $location->count_all = Cache::get("location", ['address' => ""])['address'];
        $location->icon = Blade::render('<x-icons.map stroke="2" />');
        $location_action = new stdClass();
        $location_action->name = "change";
        $location_action->href = route('web.administrator.location_set');
        $location->actions = [$location_action];

        return view('pages.administrator.dashboard', [
            'visitors' => $visitors,

            'service' => $service,
            'schedule' => $schedule,
            'order' => $order,

            'patient' => $patient,
            'midwife' => $midwife,
            'administrator' => $administrator,

            'orders_today' => $orders_today,
            'orders_limit' => $orders_limit,
            'location' => $location,
        ]);
    }
    public function database(Request $request)
    {
        $table = $request->query('table');
        $tables = DB::connection()->getDoctrineSchemaManager()->listTables();
        if ($table) {
            foreach ($tables as $value) {
                if ($value->getName() == $table) {
                    $table = $value;
                    break;
                }
            }
            return view('pages.administrator.table', [
                'table' => $table,
            ]);
        } else {
            return view('pages.administrator.database', [
                'tables' => $tables,
            ]);
        }
    }
    public function database_download(Request $request)
    {
        $table = $request->query('table');
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $database = [];
        $content = "";
        $name = "";
        if ($table) {
            $name = "$table.json";
            $content = json_encode(DB::table($table)->get()->toArray(), JSON_PRETTY_PRINT);
        } else {
            $name = "database.json";
            foreach ($tables as $table) {
                $database[$table] = DB::table($table)->get()->toArray();
            }
            $content = json_encode($database, JSON_PRETTY_PRINT);
        }
        Storage::put($name, $content, 'public');
        dispatch(fn () => Storage::delete($name))->afterResponse();
        return Storage::download($name);
    }
    public function database_upload(Request $request)
    {
        $table = $request->query('table');
        if ($table) {
            $value = json_decode($request->file('table')->get(), true);
            DB::table($table)->truncate();
            DB::table($table)->insert($value);
            return to_route('web.administrator.database', ['table' => $table]);
        } else {
            $database = json_decode($request->file('database')->get(), true);
            foreach ($database as $table => $value) {
                DB::table($table)->truncate();
                if ($database[$table]) {
                    DB::table($table)->insert($value);
                }
            }
            return to_route('web.administrator.database');
        }
    }
    public function folder(Request $request)
    {
        $path = $request->query('path');
        try {
            $files = [
                ...array_map(fn ($file) => new FileInfo($file), File::directories(storage_path($path))),
                ...File::files(storage_path($path), true),
            ];
            return view('pages.administrator.folder', [
                'files' => $files,
                'path' => $path ? $path . '/' : '',
            ]);
        } catch (\Throwable $th) {
            return back();
        }
    }
    public function folder_download(Request $request)
    {
        $relpath = $request->query('path');
        $abspath = storage_path($relpath);
        $realpath = "$abspath.zip";
        $name = basename($realpath);
        function files($path)
        {
            return [
                ...array_map(fn ($file) => new FileInfo($file), File::directories($path)),
                ...File::files($path, true),
            ];
        }
        function add_files($zip, $files, $dir = '')
        {
            foreach ($files as $file) {
                if ($file->isDir()) {
                    $subfiles = files($file->getPathname());
                    if (!$subfiles) {
                        $zip->addEmptyDir($file->getFilename());
                    }
                    add_files($zip, $subfiles, $dir . $file->getFilename() . "/");
                } else {
                    $zip->addFile($file, $dir . $file->getFilename());
                }
            }
        }
        $zip = new ZipArchive();
        $status = $zip->open(storage_path("app/public/$name"), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($status == true) {
            add_files($zip, files($abspath));
            $zip->close();
            dispatch(fn () => Storage::delete($name))->afterResponse();
            return Storage::download($name);
        } else {
            return back();
        }
    }
    public function folder_upload(Request $request)
    {
        $relpath = $request->query('path');
        $abspath = storage_path($relpath);
        $name = 'folder.zip';
        $zip = new ZipArchive();
        Storage::put($name, $request->file('folder')->get(), 'public');
        $status = $zip->open(storage_path("app/public/$name"));
        if ($status == true) {
            Storage::delete($abspath);
            $zip->extractTo($abspath);
            Storage::delete($name);
            return to_route('web.administrator.folder', ['path' => $relpath]);
        } else {
            return back();
        }
    }
    public function command(Request $request)
    {
        $input = $request->input('input');
        $output = "";
        $cwd = base_path();
        if ($input) {
            info("command", ['input' => $input]);
            $process = Process::path($cwd)->timeout(10)->run($input);
            $output .= trim($process->output());
        }
        return view('pages.administrator.command', [
            "input" => $input,
            "output" => $output,
            "cwd" => $cwd,
        ]);
    }
    public function command_async(Request $request)
    {
        $input = $request->query('input');
        $output = response();
        $cwd = base_path();
        if ($input) {
            info("command", ['input' => $input]);
            $output = $output->stream(function () use ($cwd, $input) {
                try {
                    set_time_limit(60 * 5);
                    $process = Process::timeout(60 * 5)->path($cwd)->start($input);
                    while ($process->running()) {
                        if (connection_aborted()) break;
                        $data = $process->latestOutput();
                        if (!trim($data)) continue;
                        echo 'data: ' . str_replace("\n", '$n', $data) . "\n\n";
                        ob_flush();
                        flush();
                        // usleep(1000);
                    }
                } catch (\Throwable $th) {
                    echo 'data: ' . str_replace("\n", '$n', $th->getMessage()) . "\n\n";
                    ob_flush();
                    flush();
                }
            });
            $output->headers->set('X-Accel-Buffering', 'no');
            $output->headers->set('Content-Type', 'text/event-stream');
            $output->headers->set('Cache-Control', 'no-cache');
        }
        return $output;
    }

    public function orders_limit_set()
    {
        return view('pages.administrator.orders_limit_set', Cache::get("orders_limit", [
            'date' => now()->toDateString(),
            'limit' => 3,
        ]));
    }
    public function orders_limit_set_handle(Request $request)
    {
        $data = Validator::make($request->all(), [
            'date' => 'required|string',
            'limit' => 'required|integer|min:1',
        ])->validate();
        Cache::set("orders_limit", $data, null);
        return to_route('web.administrator.dashboard');
    }

    public function location_set()
    {
        return view('pages.administrator.location_set', Cache::get("location", [
            'distance' => 5,
            'address' => "",
            'bounds' => "{}",
            'coordinates' => "[-5.152, 119.437]",
        ]));
    }
    public function location_set_handle(Request $request)
    {
        Cache::set("location", [
            'distance' => $request->input('distance'),
            'address' => $request->input('address'),
            'bounds' => $request->input('bounds'),
            'coordinates' => $request->input('coordinates'),
        ], null);
        return to_route('web.administrator.dashboard');
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
