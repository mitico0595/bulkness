<?php

namespace App;

class Cart
{   public $mochilas = [];
    public $totalQty = 0;
    public $totalPrice = 0; // usa centavos (int) para evitar flotantes


    
    
    public function __construct($oldCart){
    	if ($oldCart) {
            $this->mochilas   = $oldCart->mochilas ?? [];
            $this->totalQty   = $oldCart->totalQty ?? 0;
            $this->totalPrice = $oldCart->totalPrice ?? 0;
        }
    }
    
    public function tc(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // Datos listos para usar
        $tipoCambioSunat = json_decode($response,TRUE);
        $precioUSD = 3.72;
        return $precioUSD-0.02;


    }
    public function nuevaMochila(string $color = null): string {
        $id = 'mch_' . uniqid(); // o Ramsey\Uuid
        $this->mochilas[$id] = [
            'color'         => $color,
            'kit'           => null, // set más tarde
            'items'         => [],
            'subTotalQty'   => 0,
            'subTotalPrice' => 0,
        ];
        return $id;
    }
    public function addMochilaConItem(array $item, string $color = null, int $qty = 1): string
    {
    $mId = $this->nuevaMochila($color);
    $this->addItem($mId, $item, $qty); // esto ya recalcula subtotales y totales
    return $mId;
    }
      public function setKit(string $mochilaId, array $kit, int $qty = 1): void {
        // $kit = ['id'=>..., 'name'=>..., 'precio'=>int_centavos]
        $this->mochilas[$mochilaId]['kit'] = [
            'id' => $kit['id'],
            'name' => $kit['name'] ?? null,
            'precio' => $kit['precio'],
            'image' => $kit['image'],
            'qty' => $qty,
        ];
        
        $this->recalcularMochila($mochilaId);
    }

    public function addItem(string $mochilaId, array $item, int $qty = 1): void {
        // $item = ['id'=>..., 'name'=>..., 'precio'=>int_centavos]
        $pid = $item['id'];
      
        if (!isset($this->mochilas[$mochilaId]['items'][$pid])) {
            $this->mochilas[$mochilaId]['items'][$pid] = [
                'id' => $pid,
                'name' => $item['name'] ?? null,
                'precio' => $item['precio'],
                'image' => $item['image'],
                'qty' => 0,
            ];
        }
        $this->mochilas[$mochilaId]['items'][$pid]['qty'] += $qty;
        $this->recalcularMochila($mochilaId);
    }

    public function removeItem(string $mochilaId, int $productId): void {
        unset($this->mochilas[$mochilaId]['items'][$productId]);
        $this->recalcularMochila($mochilaId);
    }

    public function removeMochila(string $mochilaId): void {
        if (isset($this->mochilas[$mochilaId])) {
            unset($this->mochilas[$mochilaId]);
            $this->recalcularTotales();
        }
    }

    private function recalcularMochila(string $mochilaId): void {
        $m = &$this->mochilas[$mochilaId];
        $qty = 0; $price = 0;
        if ($m['kit']) {
            $qty   += $m['kit']['qty'];
            $price += $m['kit']['precio'] * $m['kit']['qty'];
        }
        foreach ($m['items'] as $it) {
            $qty   += $it['qty'];
            $price += $it['precio'] * $it['qty'];
        }
        $m['subTotalQty']   = $qty;
        $m['subTotalPrice'] = $price;
        $this->recalcularTotales();
    }

    private function recalcularTotales(): void {
        $this->totalQty = 0;
        $this->totalPrice = 0;
        foreach ($this->mochilas as $m) {
            $this->totalQty   += $m['subTotalQty'];
            $this->totalPrice += $m['subTotalPrice'];
        }
    }

    public function decrementItem(string $mochilaId, int $productId, int $delta = 1): void
    {
        if (!isset($this->mochilas[$mochilaId]['items'][$productId])) return;

        $this->mochilas[$mochilaId]['items'][$productId]['qty'] -= $delta;
        if ($this->mochilas[$mochilaId]['items'][$productId]['qty'] <= 0) {
            unset($this->mochilas[$mochilaId]['items'][$productId]);
        }
        $this->recalcularMochila($mochilaId);
    }

    public function removeKit(string $mochilaId): void
    {
        if (isset($this->mochilas[$mochilaId]['kit'])) {
            $this->mochilas[$mochilaId]['kit'] = null;
            $this->recalcularMochila($mochilaId);
        }
    }
}
