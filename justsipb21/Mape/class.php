<?php
class Prece
{
    private $conn;

    private $table_name = "Prece";

    public $preceID;
    public $kategorijaID;
    public $produkts;
    public $bilde;
    public $apraksts;
    public $cena;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);

        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }
}
?>