<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $perPage = $request->input('perPage') ?? 5;

        $query = Customer::query();
        
        if ($query) {
            $query->where('name', 'like', '%' . $keyword . '%');
            $query->orWhere('email', 'like', '%' . $keyword . '%');
        }

        return $query->orderByDesc('id')->paginate($perPage)->withQueryString();
    }
}
