<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Expediente;
use App\Models\User;

class ResumenExpedientes extends Component
{
    

    public $expedientes,$porRevisar,$observados,$aprobados,$desaprobados,$rol;
    

    public function mount(){      
        
        $user=User::find(Auth::id());
        if($user->hasRole('inspector')){
            $this->expedientes=Expediente::where('usuario_idusuario',Auth::id())->get();
            foreach($this->expedientes as $item){
                switch($item->estado){
                    case 1:
                        $this->porRevisar++;                    
                    break;
                    case 2:
                        $this->observados++;                    
                    break;
                    case 3:
                        $this->aprobados++;                    
                    break;
                    case 4:
                        $this->desaprobados++;                    
                    break;
                }
            }
        } elseif($user->hasRole('administrador')){
            $this->expedientes=Expediente::all();
            foreach($this->expedientes as $item){
                switch($item->estado){
                    case 1:
                        $this->porRevisar++;                    
                    break;
                    case 2:
                        $this->observados++;                    
                    break;
                    case 3:
                        $this->aprobados++;                    
                    break;
                    case 4:
                        $this->desaprobados++;                    
                    break;
                }
            }
        }            
    }

    public function render()
    {
               
        return view('livewire.resumen-expedientes');
    }
}
