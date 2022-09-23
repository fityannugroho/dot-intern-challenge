<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Song;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['albums'] = Album::paginate(10);
        $data['songs'] = Song::paginate(10);

        return view('pages.dashboard', $data);
    }
}
