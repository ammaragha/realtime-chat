<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;


class HomeController extends Controller
{

    public function __construct(private readonly HomeService $homeService)
    {
    }

    public function index(): \Inertia\Response
    {

        return Inertia::render('Home', [
            'data' => $this->homeService->getUsers(10),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
