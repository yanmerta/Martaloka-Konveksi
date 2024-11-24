<?php


namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Get all notifications, ordered by created_at
        $notifications = Notification::query()
            ->orderBy('created_at', 'desc')
            ->when(true, function ($query) {
                // First get unread notifications
                return $query->whereNull('read_at')
                    ->union(
                        // Then get read notifications
                        Notification::whereNotNull('read_at')
                            ->orderBy('created_at', 'desc')
                            ->limit(5) // Limit read notifications
                    );
            })
            ->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title ?? 'Notifikasi Baru',
                    'message' => $notification->message,
                    'type' => $notification->type ?? 'info',
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at,
                    'data' => $notification->data
                ];
            })
        ]);
    }
    
    public function markAsRead($id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $notification->update(['read_at' => now()]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi telah dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menandai notifikasi sebagai dibaca'
            ], 500);
        }
    }
    
    public function markAllAsRead()
    {
        try {
            Notification::whereNull('read_at')
                ->update(['read_at' => now()]);
                
            return response()->json([
                'status' => 'success',
                'message' => 'Semua notifikasi telah dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menandai semua notifikasi sebagai dibaca'
            ], 500);
        }
    }
}