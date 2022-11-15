<?php

class ProductModel{
    
    
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_comestibles;charset=utf8', 'root', '');
    }


    public function getAll($sort = null, $order = null, $page = null, $limit = null, $filter = null) {
          
        var_dump($sort,$order,$page, $limit, $filter);

        $sql_query = "SELECT productos.*, categorias.categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id";

            if($filter != null){

                $query = $this->db->prepare($sql_query .= " WHERE producto LIKE '%$filter%'");
            }
    
            if($sort != null && $order != null && isset($page) ){
                
                $query = $this->db->prepare($sql_query .= " ORDER BY $sort $order LIMIT $page,$limit");
            }

            else if($sort != null && isset($page)){

                $query = $this->db->prepare($sql_query .= " ORDER BY $sort ASC LIMIT $page,$limit");
            }

            else if ($sort == null && $order != null && isset($page)){

                $query = $this->db->prepare($sql_query .= " ORDER BY id $order LIMIT $page,$limit");
            }

            else if(isset($page)){

                $query = $this->db->prepare($sql_query .= " ORDER BY id ASC LIMIT $page,$limit");
            }
            
            else if($sort == null && $order == null && isset($page)){

                $query = $this->db->prepare($sql_query .= " LIMIT $page,$limit");
            } 
            
            else if($sort != null && $order != null){
        
                $query = $this->db->prepare($sql_query .= " ORDER BY $sort $order");
                }

            else if($sort == null && $order != null){

                $query = $this->db->prepare($sql_query .= " ORDER BY id $order");
            }
            
            else if( $sort != null && $order == null){

                $query = $this->db->prepare($sql_query .= " ORDER BY $sort ASC");
            }

            else{
                
                $query = $this->db->prepare($sql_query);
            }
                
            $query->execute();

            $products = $query->fetchAll(PDO::FETCH_OBJ);

            return $products;
        }

    public function get($id){
        
        // traemos todos los productos donde coincida con el id marcado.
        $query = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $query->execute([$id]);
        
        $product = $query->fetch(PDO::FETCH_OBJ);
        
        return $product;
    }

    
    public function DeleteByID($id){

        $query = $this->db->prepare('DELETE FROM productos WHERE id = ?');
        $query->execute([$id]);
    }


    public function Insert($producto, $precio, $categoria){

        $query = $this->db->prepare('INSERT INTO productos (producto, precio, id_categoria) VALUES (?,?,?)');
        $query->execute([$producto,$precio,$categoria]);

        return $this->db->lastInsertId();
    }   

    public function getColumnsName($sort = null){

            // compara el valor de sort con el nombre de las columnas de productos.

            // $query = $this->db->prepare("SELECT *
            // FROM INFORMATION_SCHEMA.COLUMNS
            // WHERE COLUMN_NAME = '$sort' AND TABLE_NAME = 'productos'");
            $query = $this->db->prepare("SELECT productos.*, categorias.categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id, INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$sort'");

            $query->execute();
            $columns = $query->fetchAll(PDO::FETCH_OBJ);


            //si el array de columns existe retorna true, en caso contrario false.
             $columns = empty($columns) ? false :  true;
            
                 return $columns;
        }
}