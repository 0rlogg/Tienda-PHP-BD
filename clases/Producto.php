<?php

class Producto {
    protected $codigo;
    protected $nombre_corto;
    protected $PVP;

    /**
     * @param $producto
     */
    public function __construct($producto){
        $this->codigo = $producto['cod'];
        $this->nombre_corto = $producto['nombre_corto'];
        $this->PVP = $producto['PVP'];}//construct

    public function  getCodigo(){
        return $this->codigo;}

    public function getNombre() {
        return $this->nombre;}

    public function getNombre_corto() {
        return $this->nombre_corto;}

    public function getPVP() {
        return $this->PVP;}

}//Producto