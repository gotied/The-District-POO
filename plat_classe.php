<?php
class Plat {
    private $table = "plat";

    public $id;
    public $libelle;
    public $description;
    public $prix;
    public $image;
    public $id_categorie;
    public $active;

    public function __construct($id, $libelle, $description, $prix, $image, $id_categorie, $active){
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->image = $image;
        $this->id_categorie = $id_categorie;
        $this->active = $active;
    }
}
?>