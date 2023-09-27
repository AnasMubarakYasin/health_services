<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\FileInfo;

class StorageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = storage_path('app/public');
        $this->line("Clear Path " . $path);
        try {
            foreach (File::allFiles($path) as $file) {
                $status = File::delete($file->getPathname());
                $loc = str_replace($path, '', $file->getPathname());
                $this->info("file {$loc} " . ($status ? 'success' : 'fail'));
            }
            foreach (array_map(fn ($file) => new FileInfo($file), File::directories($path)) as $directory) {
                $status = File::deleteDirectory($directory->getPathname(), false);
                $loc = str_replace($path, '', $directory->getPathname());
                $this->info("directory {$loc} " . ($status ? 'success' : 'fail'));
            }
            // foreach (Storage::allFiles() as $file) {
            //     $status = Storage::delete($file);
            //     $this->info("Path " . $file . " " . ($status ? 'success' : 'fail'));
            // }
            // foreach (array_reverse(Storage::allDirectories()) as $dir) {
            //     if (is_file($dir)) continue;
            //     $status = Storage::deleteDirectory($dir);
            //     $this->info("Path " . $dir . " " . ($status ? 'success' : 'fail'));
            // }
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return Command::FAILURE;
        }
        $this->info("Clear Storage Success");

        return Command::SUCCESS;
    }
}
