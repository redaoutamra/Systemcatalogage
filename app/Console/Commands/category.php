<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\CategoryResources;
use Illuminate\Http\Request;


class category extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'x';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $categories = Product::all();
        dd($categories);
        return CategoryResources::Collection($categories);

    }
}
