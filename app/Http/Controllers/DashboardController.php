<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = 'Admin';

        switch ($role) {

            case auth()->user()->hasRole('Admin'):
                return redirect()->route('admin.dashboard');
                break;

            case auth()->user()->hasRole('Writer'):
                return redirect()->route('writer.child-categories.index');
                break;

            default:
                return redirect()->route('user.dashboard');
                break;
        }
    }
}
