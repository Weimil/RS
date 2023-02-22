<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;

class Home extends Controller
{
    protected function index()
    {
        Carbon::setLocale('ES');
        $images = Image::query()
            ->orderBy(Image::CREATED_AT, 'desc')
            ->get();
        return view('dashboard', ['images' => $images]);
    }
}
