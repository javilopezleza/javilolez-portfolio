<?php

class Lavadora extends Electrodomestico{
    private $carga;

    function __construct($precioBase, $color, $consumoEnergetico, $peso, $carga)
    {
        parent::__construct($precioBase, $color, $consumoEnergetico, $peso);
        $this->carga = $carga;
    }

    /**
     * Get the value of carga
     */ 
    public function getCarga()
    {

        if ($this->carga == "") {
            $this->carga = 5;
        }else{
            $this->carga = $this->carga;
        }


        return $this->carga;
    }
    public function precioFinal()
    {
        $total = 0;
        $totalConPeso = $total;
        $totalConCarga = 0;


        if ($this->getConsumoEnergetico() == "A") {
            $total = $this->getPrecioBase() + 100;
        }elseif ($this->getConsumoEnergetico() == "B") {
            $total = $this->getPrecioBase() + 80;
        }elseif ($this->getConsumoEnergetico() == "C") {
            $total = $this->getPrecioBase() + 60;
        }elseif ($this->getConsumoEnergetico() == "D") {
            $total = $this->getPrecioBase() + 50;
        }elseif ($this->getConsumoEnergetico() == "E") {
            $total = $this->getPrecioBase() + 30;
        }elseif ($this->getConsumoEnergetico() == "F") {
            $total = $this->getPrecioBase() + 10;
        }else{
           echo "Selecciona Un consumo electrico valido";
        }

        if ($this->getPeso() >= 0 && $this->getPeso() <= 19) {
            $totalConPeso = $total + 10;
        }elseif($this->getPeso() >= 20 && $this->getPeso() <= 49){
            $totalConPeso = $total + 50;
        }elseif($this->getPeso() >= 50 && $this->getPeso() <= 79) {
            $totalConPeso = $total + 80;
        }elseif ($this->getPeso() >= 80) {
            $totalConPeso = $total + 100;
        }else{
            echo "No entro";
        }

        if ($this->getCarga() >= 6) {
            $totalConCarga = $totalConPeso +50; 
            $totalFinal = $totalConCarga;
        }else{
            $totalFinal = $totalConPeso;
        }

                               
        
        

        return "Precio final: $totalFinal"."€<br>";
    }

    public function __toString()
    {
        return "<h3>Datos de la lavadora</h3> <br>
        Precio base: {$this->getPrecioBase()}€ <br>
        Consumo energético: {$this->getConsumoEnergetico()}<br>
        Peso: {$this->getPeso()}kg <br>
        Carga: {$this->getCarga()}kg";
    }
}
