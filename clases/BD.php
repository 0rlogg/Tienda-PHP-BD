<?php

spl_autoload_register(function ($clase){
    require ("BD.php");
});

class BD
{
    private $servername;
    private $user;
    private $password;
    private $dbname;
    private $conexion;

    public function __construct(){
        $this->servername = 'localhost';
        $this->user = 'root';
        $this->password = 'password';
        $this->dbname = 'dwes';
        $this->conexion = new mysqli($this->servername,$this->user,$this->password,$this->dbname);
        //comprovacion conexion
    }

    public function validar_login(String $user, String $pass){
        $consulta = "select * from usuarios where name = ? and pass = ?";
        $tipos= "ss";
        $valores = [$user, $pass];
        $rtdo = $this->ejecuta_consulta($consulta ,$tipos, $valores);
        return $rtdo->num_rows>0 ? true:false;
    }

    public function cerrar(){
        $this->conexion->close();
    }//cerrar

    public function lista_productos(){
        $consulta = "select * from producto";
        $productos =[]; //La vaiable de retorno
        $resultado = $this->conexion->query($consulta);
        $fila = $resultado->fetch_assoc();

        while ($fila){
            $productos[]=$fila;
            $fila = $resultado->fetch_assoc();

        }
        return $productos;

    }

    private function ejecuta_consulta($consulta, $tipos=null,$valores=[]){
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare($consulta);
        $stmt->bind_param($tipos, ...$valores);
        $stmt->execute();
        $stmt->store_result();//la guardamos en el buffer
        return $stmt;
    }

    public function obtiene_producto(String $cod){
        $consulta = "select cod, nombre_corto,PVP  from producto where cod=?";
        $tipos="s";
        $valores=[$cod];
        $rtdo = $this->ejecuta_consulta($consulta,$tipos,$valores);
        $rtdo->bind_result($c,$n,$p);
        $rtdo->fetch();
        $array=['cod'=>$c,'nombre_corto'=>$n,'PVP'=>$p];
        return new Producto($array);


    }
}//BD