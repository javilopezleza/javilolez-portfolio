<?php

require "Electrodomestico.php";
include "Lavadora.php";

class Television extends Electrodomestico
{
    private $resolucion;
    private $netflix;

    function __construct($precioBase, $color, $consumoEnergetico, $peso, $resolucion, $netflix)
    {
        parent::__construct($precioBase, $color, $consumoEnergetico, $peso);
        $this->resolucion = $resolucion;
        $this->netflix  = $netflix;
    }

    /**
     * Get the value of resolucion
     */
    public function getResolucion()
    {

        if ($this->resolucion == "") {
            $this->resolucion = 20;
        } else {
            $this->resolucion = $this->resolucion;
        }

        return $this->resolucion;
    }

    /**
     * Get the value of netflix
     */
    public function getNetflix()
    {

        if ($this->netflix == "") {
            $this->netflix = "false";
        } else {
            $this->netflix = $this->netflix;
        }
        return $this->netflix;
    }
    public function precioFinal()
    {
        $total = 0;
        $totalConPeso = $total;
        $totalConResolucion = 0;
        $netflix = 50;

        //Calculo para el consumo energetico

        if ($this->getConsumoEnergetico() == "A") {
            $total = $this->getPrecioBase() + 100;
        } elseif ($this->getConsumoEnergetico() == "B") {
            $total = $this->getPrecioBase() + 80;
        } elseif ($this->getConsumoEnergetico() == "C") {
            $total = $this->getPrecioBase() + 60;
        } elseif ($this->getConsumoEnergetico() == "D") {
            $total = $this->getPrecioBase() + 50;
        } elseif ($this->getConsumoEnergetico() == "E") {
            $total = $this->getPrecioBase() + 30;
        } elseif ($this->getConsumoEnergetico() == "F") {
            $total = $this->getPrecioBase() + 10;
        } else {
            echo "Selecciona Un consumo electrico valido";
        }

        //Calculo para el peso

        if ($this->getPeso() >= 0 && $this->getPeso() <= 19) {
            $totalConPeso = $total + 10;
        } elseif ($this->getPeso() >= 20 && $this->getPeso() <= 49) {
            $totalConPeso = $total + 50;
        } elseif ($this->getPeso() >= 50 && $this->getPeso() <= 79) {
            $totalConPeso = $total + 80;
        } elseif ($this->getPeso() >= 80) {
            $totalConPeso = $total + 100;
        } else {
            echo "No entro";
        }

        //Precio para la resolucion

        if ($this->getResolucion() >= 20) {
            $calculo = ($totalConPeso * 0.3);
            $totalConResolucion = $this->getPrecioBase() + $calculo;
            $totalConIncremento= $calculo + $totalConPeso;
            $totalFinal = $totalConIncremento;

        } else {

            $totalSinResolucion = $totalConPeso;
            $totalFinal = $totalSinResolucion;
        }

        if ($this->getResolucion() >= 20 && $this->getNetflix() == "true") {
           $totalFinal = $totalConIncremento + $netflix; 
        }elseif ($this->getResolucion() < 20 && $this->getNetflix() == "true") {
            $totalFinal = $totalConPeso + $netflix;
        }elseif ($this->getResolucion() < 20 && $this->getNetflix() == "false") {
            $totalFinal = $totalConPeso;
        }elseif($this->getResolucion() >= 20 && $this->getNetflix() == "false"){
            $totalFinal = $totalConIncremento;
        }

        return "Precio final: $totalFinal"."€<br>";
    }

    public function __toString()
    {
        return "<h3>Datos del televisor</h3> <br>
        Precio base: {$this->getPrecioBase()}€ <br>
        Consumo energético: {$this->getConsumoEnergetico()}<br>
        Peso: {$this->getPeso()}kg <br>
        Resolucion: {$this->getResolucion()}''<br>
        Netflix: {$this->getNetflix()}";
    }
}
