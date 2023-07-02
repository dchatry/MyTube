<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SubscriptionController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('subscriptions', [
            'videos' => Video::query()
                ->with('subscription')
                ->processed()
                ->orderBy('published_at', 'desc')
                ->get(),
        ]);
    }
}
