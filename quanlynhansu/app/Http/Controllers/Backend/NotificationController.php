<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class NotificationController extends BackendController
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function get(Request $request){
        $user = Auth::user();
        $limit = config('apps.general.limit.notification', 30);
        $notifications = $user->notifications()
                            ->orderBy('created_at', 'desc')
                            ->limit($limit)
                            ->get();
        return response()->json([
            'status' => true,
            'data' => $notifications
        ]);
    }

    public function unreadCount(Request $request){
        $user = Auth::user();
        $counter = $user->unreadNotifications()->count();
        return response()->json([
            'status' => true,
            'count' => $counter
        ]);
    }
}
