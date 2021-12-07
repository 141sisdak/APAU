<?php 



class inicioController{

    public function inicio()

    {

        $m = new Model();

        $params["datosDash"] = array(
            "totalRescates"=> $m->getTotalRescates(),
            "totalGastos" => $m->getTotalGatos(),
            "totalSocios"=>$m->getTotalSocios(),
            "totalDonaciones"=>$m->getTotalDonaciones()

        );

        require('../app/templates/inicio.php');
    }
}

?>