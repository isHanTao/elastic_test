<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Imagick;
use Intervention\Image\Facades\Image;

class ImgDell extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'img';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $img = new Imagick();
        $img->newImage(100,100,'#ffffff');
        $img->setImageFormat('png');
        $img = Image::make($img->getImageBlob());
        $img->text('hello world',20,20);
        $img->save(__DIR__.'/test.png');

    }
}
