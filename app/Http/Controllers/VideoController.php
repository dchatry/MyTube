<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class VideoController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function play(Video $video)
    {
        return view('play', [
            'video' => $video,
        ]);
    }
}
