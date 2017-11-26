<?php
class EntregaDao {
    private $db;
    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function update($entrega){
        $dbEntrega = $this->db->entrega()->where("id", $entrega["id"])->fetch();

        if ($dbEntrega != false) {
            $dbEntrega["nome_recebedor"] = $entrega["nome_recebedor"];
            $dbEntrega["cpf_recebedor"] =  $entrega["cpf_recebedor"];
            $dbEntrega["data_hora_entrega"] = $entrega["data_hora_entrega"];

            return $dbEntrega->update();
        }
        
        return false;
    }

    public function delete($entregaId){        
        return $this->db->entrega()->where("id", $entregaId)->delete();
    }
}
?>