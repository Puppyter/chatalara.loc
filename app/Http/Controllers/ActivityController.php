<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function getAllActiveUsers(Request $request,ActivityService $activityService)
    {
        $users = $activityService->getAllActiveUsers();
        foreach ($users as $user) {
            $user->avatar =Storage::url($user->avatar);
        }
        return response(['users'=>$users]);
    }

}
