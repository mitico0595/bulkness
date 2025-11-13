<?php

namespace App;

class Carto 
{
    public $items=null;
    public $totalQty =0;
    public $totalPrice =0;
    public $totalPrecioEnvio = 0;
    public $totalEnvio = 0;
    public $totalPrecioProv =0;
    public $chargeProv = 0;
    public $purchaseNumber = 0;
    public $transfer =0;
    public $charge = 0;
    public $k =0;
    
    public $Bprice =0;
    public $BpriceLocal=0;
    public $send = 0;
    public $BpriceV=0;
    public $sendV = 0;
    public $email = 0;
    public $datosEnvio =0;
    public $booleanEnvio =0;
    public $TipoEnvio =0;
    
    public function __construct($oldCarto){
    	if($oldCarto){
    	   
            $send = 10;
            $sendV = 14.9;
            $this->send = number_format($send,2);
            $this->sendV = number_format($sendV,2);
            $this->datosEnvio = $oldCarto->datosEnvio ?? null;
            $this->booleanEnvio = $oldCarto->booleanEnvio ?? 0;
            $this->TipoEnvio = $oldCarto->TipoEnvio ?? null;
            
            $this->email=$oldCarto->email;
    		$this->items=$oldCarto->items;
    		$this->totalQty=$oldCarto->totalQty;
    		$this->totalPrice=$oldCarto->totalPrice;            
            $this->totalPrecioEnvio = ($oldCarto->totalPrice+10);
            $this->totalPrecioProv= ($oldCarto->totalPrice+14.90);
            $this->transfer = ($this->totalPrice);   
            $this->charge= ($this->totalPrecioEnvio)*0.0399;
            $this->chargeProv = ($this->totalPrecioProv)*0.0399;
            
            
            // CRIPTOMONEDA
            $this->Bprice =  $oldCarto->totalPrice;
            $this->Bprice = number_format($this->Bprice,2);
            $this->BpriceLocal = $this->Bprice + $this->send;
            $this->BpriceV = $this->Bprice + $this->sendV;
            
           
    	}
    }
    

    
    
    public function add($item,$id){

    	$storedItem = ['qty'=>0,'precio'=> $item->precio,'item'=>$item];
    	if($this->items){
    		if(array_key_exists($id, $this->items)){
    			$storedItem = $this->items[$id];
    		}
    	};
        
    	$storedItem['qty']++;
    	$storedItem['precio'] = $item->precio*$storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->precio;
        
        
    }
    public function reduceByOne($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['precio'] -= $this->items[$id]['item']['precio'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['precio'];

        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }
    }
    

    public function removeItem($id){
        $this->totalQty-= $this->items[$id]['qty'] ;
        $this->totalPrice -= $this->items[$id]['precio'];
        unset($this->items[$id]);      
    }
    public function guardar($datosEnvio) {
        // Asumiendo que tienes una propiedad en Cart para almacenar los datos de envío
        $this->datosEnvio = $datosEnvio;
        $this->booleanEnvio = '1';
    }
    public function envio(){$this->TipoEnvio = '1';}
    
    public function noenvio(){$this->TipoEnvio = '0';}


}
