<?php 
require_once './app/models/productsmodel.php';
require_once "./app/views/api.view.php";


    class ComestiblesapiController{
        private $productmodel;
        private $view;

        private $data;
            
            public function __construct(){
                $this->productmodel = new ProductModel;
                $this->view = new ApiView;


                //lee el body del request
                
                $this->data = file_get_contents("php://input");
            }


            private function getData(){
                return json_decode($this->data);
            }



         public function getProducts($params = null){ 
            try{
                //inicializamos una variable Products como null
                $products = null;

               //almacenamos las variables querys mediante un metodo GET.
                if (!empty($_GET['sort']) ? $sort = $_GET ['sort'] : $sort= null); 
                if (!empty($_GET['order']) ? $order = $_GET['order'] : $order = null);
                if (isset($_GET['page']) ? $page = $_GET['page'] : $page = null);
                if (!empty($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 10); 
                if(!empty($_GET['filter']) ? $filter = $_GET['filter'] : $filter = null);
                    
                    if($page == null){
                    $limit = null;
                }
                 if($page && $page != null){
                    if($page <= 0){
                            $page = 1;
                    }
                    if((intval($page) && intval($limit)) &&  $limit >= 0){
                            $page = ($page-1) * $limit;

                            $columns = $this->productmodel->getColumnsName($sort);

                        if($sort == null && $order != null){

                            if($order == 'ASC' ||$order == 'asc' ||$order == 'DESC' ||$order == 'desc'){

                                $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);

                                if($products == null){

                                    $this->view->response('No se encontro el detalle del producto', 404);
                                    die();
                                }
                            }
                        }

                        else if(($columns == false) && ($order == 'ASC' ||$order == 'asc' ||$order == 'DESC' ||$order == 'desc')){
                
                            $this->view->response("La columna ingresada no existe", 400);
                            die();
                        }

                        else  if($columns == true && ($order == 'ASC' ||$order == 'asc' ||$order == 'DESC' || $order == 'desc')){

                            $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);

                                if($products == null){

                                    $this->view->response('No se encontro el detalle del producto', 404);
                                    die();
                                }
                            }
                        else if ($sort == null && $order == null){

                            $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);
                        }
                            else{
            
                                $this->view->response("$sort y $order no son valores validos",400);
                                die();
                            }
                    } 
                    else{

                        $this->view->response("Error, paginacion mal declarada", 400);
                        die();
                     }
                  }

                else if($page == null && $sort != null){

                    $columns = $this->productmodel->getColumnsName($sort);

                        if(($columns == false) && ($order == 'ASC' || $order == 'asc' ||$order == 'DESC' || $order == 'desc')){
                
                            $this->view->response("La columna ingresada no existe", 400);
                            die();
                        }

                        else if($columns == true && ($order == 'ASC' ||$order == 'asc' ||$order == 'DESC' || $order == 'desc')){

                        $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);

                            if($products == null){

                                $this->view->response('No se encontro el detalle del producto', 404);
                                die();
                            }

    

                        }
                        else if($columns == true && $order == null){

                                $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);
                        }

                        else{
        
                            $this->view->response("$sort y $order no son valores validos", 400);
                            die();
                        }
                }
                else if($sort == null && $page== null && $order != null){

                        if($order == 'ASC' ||$order == 'asc' ||$order == 'DESC' || $order == 'desc'){

                            $products = $this->productmodel->getAll($sort,$order,$page,$limit,$filter);

                        if($products == null){

                            $this->view->response('No se encontro el detalle del producto', 404);
                            die();
                        }
                    }
                }
                
                else if($products == null){
                    
                    $products = $this->productmodel->getAll();
                    
                 }
                 else{

                    $this->view->response("Su solicitud no se puede completar", 404);
                 }

                if($products != null){

                    $this->view->response($products, 200);
                }
                
                }catch(Exception $e){
                    $this->view->response($e, 500);
                }
                
            }
            
            public function PageError(){
                $this->view->response("Page Not Found", 404);
            }

            public function getProduct($params = null){
                // obtengo el id del producto a llamar.
                $id = $params[':ID'];
                
                $product = $this->productmodel->get($id);

                    if($product){
                        $this->view->response($product);
                    }
                    else{
                        $this->view->response("El producto con el id = $id no existe", 404);
                    }
            
            }

            public function DeleteProduct($params = null){
                // obtengo el id del producto a eliminar.
                    $id = $params[':ID'];

                    $product = $this->productmodel->get($id);

                if($product){
                    $this->productmodel->DeleteByID($id);
                    $this->view->response($product, 200);
                }
                else{
                    $this->view->response("El producto que desea eliminar no existe", 404);
                }
            }


            public function InsertProduct($params = null){
                
                $Nproduct = $this->getData();
                if(empty($Nproduct->producto)||empty($Nproduct->precio)||empty($Nproduct->id_categoria)){

                $this->view->response("Complete los datos", 400);

                }
                else{
                    $id = $this->productmodel->Insert($Nproduct->producto, $Nproduct->precio, $Nproduct->id_categoria);

                    $product = $this->productmodel->get($id);
                    $this->view->response($product, 201);
                }
            }

    }