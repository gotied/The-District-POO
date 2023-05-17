<?php
class Categorie {
    private $table = 'categorie';

    public $id;
    public $libelle;
    public $image;
    public $active;

    public function __construct($id, $libelle, $image, $active){
        $this->id = $id;
        $this->libelle = $libelle;
        $this->image = $image;
        $this->active = $active;
    }
}
?>