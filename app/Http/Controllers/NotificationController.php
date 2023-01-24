<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function marcarUnaNotificación($idNotificacion,$idSolicitud){
        Auth()->user()->unreadNotifications->when($idNotificacion,function($query) use
        ($idNotificacion){
            return$query->where('id',$idNotificacion);
        })->markAsRead();
        $solicitud=Solicitud::find($idSolicitud);
        return redirect()->route('vistaSolicitud',$solicitud);
    }

    public function marcarTodasLasNotificaciones(){
        Auth()->user()->unreadNotifications->markAsRead();
        redirect()->route('solicitud');
    }
}
