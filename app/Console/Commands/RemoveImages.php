<?php

namespace App\Console\Commands;

use App\Models\Hotel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hotels = Hotel::all();
        foreach ($hotels as $hotel) {
            $services = $hotel->services;
            $rooms = $hotel->rooms;
            foreach ($services as $service) {
                $path = public_path('images/hotel/'.$hotel->id.'/services/'.$service->id.'/');
                $files = File::files($path);

                foreach ($files as $file) {
                    $filename = basename($file);
                    if (! $services->where('image', $filename)->first()) {
                        File::delete($file);
                        dd('ppp');
                    }
                }
                $files = File::files($path);
                if (empty($files)) {
                    File::deleteDirectory($path);
                }
            }
            foreach ($rooms as $room) {
                $path = public_path('images/hotel/'.$hotel->id.'/rooms/'.$room->id.'/');
                $files = File::files($path);

                foreach ($files as $file) {
                    $filename = basename($file);
                    if (! $services->where('image', $filename)->first()) {
                        File::delete($file);
                    }
                }
            }
            $rooms = $hotel->services;
//            dd($services);
        }
        print_r('ok');
    }
}
