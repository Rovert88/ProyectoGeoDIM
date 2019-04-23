<?php

    //Clase Nodo
    class Nodo{
        function __construct($dato, $siguiente) {
            $this->dato = $dato;
            $this->siguiente = $siguiente;
        }
    }
    
    //Clase ListaEnlazada
    class ListaEnlazada{
        function __construct() {
            $this->cabecera = null;
            $this->tamLista = 0;
        }
        
        //Agregar un elemento a la lista
        public function agregarElemento($dato){
            $nuevoNodo = new Nodo($dato, null);
            
            if(! $this->cabecera){
                $this->cabecera = $nuevoNodo;
            }else{
                $nodoActual = $this->cabecera;
                
                while($nodoActual->siguiente){
                    $nodoActual = $nodoActual->siguiente;
                }
                $nodoActual->siguiente = $nuevoNodo;
            }
            $this->tamLista++;
        }
        
        //Agregar un elemento a la lista en una posicion dada
        public function agregarElementoPos($dato, $indice){
            if($indice < 0 || $indice > $this->tamLista){
                echo "Posicion dada fuera del tamaño de la lista";
            }
            
            $nuevoNodo = new Nodo($dato, null);
            $nodoActual = $this->cabecera;
            $nodoAnterior;
            
            if($indice == 0){
                $nuevoNodo->siguiente = $nodoActual;
                $this->cabecera = $nodo;
            }else{
                for($i = 0; $i < $indice; $i++){
                    $nodoAnterior = $nodoActual;
                    $nodoActual = $nodoActual->siguiente;
                }
                $nuevoNodo->siguiente = $nodoActual;
                $nodoAnterior->siguiente = $nuevoNodo;
            }
            $this->tamLista++;
        }
        
        //Eliminar un elemento de la lista
        public function eliminarElemento($dato){
            $nodoActual = $this->cabecera;
            $nodoAnterior = null;
            
            while($nodoActual != null){
                if($nodoActual->dato == $dato){
                    if(! $nodoAnterior){
                        $this->cabecera = $nodoActual->siguiente;
                    }else{
                        $nodoAnterior->siguiente = $nodoActual->siguiente;
                    }
                    $this->tamLista--;
                    return $nodoActual->dato;
                }
                $nodoAnterior = $nodoActual;
                $nodoActual = $nodoAnterior->siguiente;
            }
            return NULL;
        }
        
        //Eliminar un elemento en una posicion dada
        public function eliminarElementoPos($indice){
            if($indice < 0 || $indice > $this->tamLista){
                return NULL;
            }
            $nodoActual = $this->cabecera;
            $nodoAnterior = null;
            
            if($indice == 0){
                $this->cabecera = $nodoActual->siguiente;
            }else{
                for($i = 0; $i < $indice; $i++){
                    $nodoAnterior = $nodoActual;
                    $nodoActual = $nodoActual->siguiente;
                }
                $nodoAnterior->siguiente = $nodoActual->siguiente;
            }
            $this->tamLista--;
            return $nodoActual->dato;
        }
        
        //Imprimir contenido de la lista
        public function imprimirContenido(){
            if(! $this->tamLista){
                echo "La lista está vacía";
            }
            
            $elementos = array();
            $nodoActual = $this->cabecera;
            
            while($nodoActual != null){
                array_push($elementos, $nodoActual->dato);
                $nodoActual = $nodoActual->siguiente;
            }
            
            $valores = '';
            
            foreach($elementos as $dato){
                $valores .= $dato. ' --> ';
            }
            
            echo $valores."X";
        }
        
        //Saber si la lista esta vacia
        public function listaVacia(){
            if($this->tamLista == 0){
                echo "Lista vacía";
            }else{
                echo "Lista con elementos";
            }
        }
        
        //Saber si el numero de elementos en la lista
        public function obtenerTamaño(){
            return $this->tamLista;
        }
    }

