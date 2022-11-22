<?php 

    class Comentario 
    {
        public static function getComment($id) 
        {
            $connect = Connection::getConnection();

            $query = 'SELECT * FROM comentario WHERE id_postagem = :id';
            $statement = $connect->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            
            while($row = $statement->fetchObject('Comentario')){
                $resultado[] = $row;
            }
            if(isset($resultado)){
                return  $resultado;
            }
        }
    }
