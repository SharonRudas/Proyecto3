<?php
    class Model_Graf{
        private $conexion;
        function __construct()
        {
            require_once('conexion.php');
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

        function TraerGrafico(){
            $sql = "CALL SP_DATOS";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_VU = mysqli_fetch_array($consulta)){
                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
    }
?>
