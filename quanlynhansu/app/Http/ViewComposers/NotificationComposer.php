<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    
    public function __construct(){
    }
    public function compose(View $view){
        $user = Auth::user();
        $limit = config('apps.general.limit.notification', 30);
        $notifications = $user->notifications()
                            ->orderBy('created_at', 'desc')
                            ->limit($limit)
                            ->get();
        $view->with([
            'notifications' => $notifications,
        ]);
    }
}
