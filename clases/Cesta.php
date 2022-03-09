<?php
spl_autoload_register(function ($clase){
    require ("$clase.php");
});

class Cesta{
    private $cesta;

    public function __construct(){
        $this->cesta=[];
    }
    /**
     * @param $cod
     * @return void
     */
    public function add_producto($cod){
        if (array_key_exists($cod, $this->cesta)){
            $this->cesta[$cod]++;}
        else{
            $this->cesta[$cod] = 1;}}
    /**
     * @param $cod
     * @return void
     */
    public function delete_producto($cod){
        if (array_key_exists($cod, $this->cesta)){
            if ($this->cesta[$cod] == 1){
                unset ($this->cesta[$cod]);}
            else{
                $this->cesta[$cod]--;}}
    }

    public function vaciar_cesta(){
        return new Cesta();
    }

    public function obtener_cesta(){
        if ($_SESSION['cesta']){
            return (unserialize($_SESSION['cesta']));}
        else{
            return new Cesta();}
    }

     public function guardar_cesta (){
        $_SESSION['cesta'] = serialize($this);
    }

    public function cesta_vacia(){
        if ($this->cesta == null){
            return true;}
        else{
            return false;}
    }

    public function getCesta(): array {
        return $this->cesta;}}