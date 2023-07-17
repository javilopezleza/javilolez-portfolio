<?php
class Electrodomestico
{
    private $precioBase;
    private $color;
    private $consumoEnergetico;
    private $peso;

    public function __construct($precioBase, $color, $consumoEnergetico, $peso)
    {
        $this->precioBase = $precioBase;
        $this->color = $color;
        $this->consumoEnergetico = $consumoEnergetico;
        $this->peso = $peso;
    }

    /**
     * Get the value of precioBase
     */
    public function getPrecioBase()
    {

        if ($this->precioBase == "") {
            $this->precioBase = 100;
        } else {
            $this->precioBase = $this->precioBase;
        }

        return $this->precioBase;
    }

    /**
     * Set the value of precioBase
     *
     * @return  self
     */
    public function setPrecioBase($precioBase)
    {
        $this->precioBase = $precioBase;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        if ($this->color == "") {
            $this->color = "blanco";
        }elseif ($this->color != "blanco" && $this->color != "negro" && $this->color != "rojo"
        && $this->color != "azul"  && $this->color != "gris") {
            $this->color = "blanco";
        }
         else {
            $this->color = $this->color;
        }


        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {

        return $this;
    }

    /**
     * Get the value of consumoEnergetico
     */
    public function getConsumoEnergetico()
    {

        if ($this->consumoEnergetico == "") {
            $this->consumoEnergetico = "A";
        } elseif ($this->consumoEnergetico != "A" && $this->consumoEnergetico != "B" && $this->consumoEnergetico != "C" 
        && $this->consumoEnergetico != "D" && $this->consumoEnergetico != "E" && $this->consumoEnergetico != "F") {
            $this->consumoEnergetico = "A";
        } else {
            $this->consumoEnergetico = $this->consumoEnergetico;
        }


        return $this->consumoEnergetico;
    }

    /**
     * Set the value of consumoEnergetico
     *
     * @return  self
     */
    public function setConsumoEnergetico($consumoEnergetico)
    {
        $this->consumoEnergetico = $consumoEnergetico;

        return $this;
    }

    /**
     * Get the value of peso
     */
    public function getPeso()
    {

        if ($this->peso == "") {
            $this->peso = 5;
        } else {
            $this->peso = $this->peso;
        }

        return $this->peso;
    }

    /**
     * Set the value of peso
     *
     * @return  self
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    public function comprobarConsumoEnergetico()
    {
        if (
            $this->consumoEnergetico != "A" && $this->consumoEnergetico != "B" && $this->consumoEnergetico != "C"
            && $this->consumoEnergetico != "D"  && $this->consumoEnergetico != "E" && $this->consumoEnergetico != "F"
        ) {
            $this->consumoEnergetico == "A";
        }
    }

    public function precioFinal()
    {
        $total = 0;
        $totalConPeso = $total;


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
        }else {
            echo "Selecciona Un consumo electrico valido";
        }

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

        $totalFinal = $totalConPeso;

        return $totalFinal;
    }

    public function __toString()
    {
        return "<strong>Datos del electrodomestico</strong> <br>
        Precio base: {$this->getPrecioBase()} <br>
        Color: {$this->getColor()} <br>
        Consumo energético: {$this->getConsumoEnergetico()}<br>
        Peso: {$this->getPeso()}";
    }
}