<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // Lista las notificaciones del usuario
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return response()->json($notifications);
        //Tengo que mirar el middleware para poder hacer bien la autentificación, tanbien editar rutas del web 
    }

    // Marca una notificación como leída
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read'], 200);
    }
}
