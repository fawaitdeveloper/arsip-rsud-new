<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getUser(Request $request)
    {
        $query = User::query();
        if ($request->job_position_id) {
            $query = $query->where('job_position_id', $request->job_position_id);
        }
        $results =  $query->get();

        return $results;
    }
}
