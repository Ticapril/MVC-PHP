<?php


class Postagem 
{
    public static function getPostagem()
    {
        $connect = Connection::getConnection();
        // $connect = new PDO('mysql: host=localhost; dbname=mvc;', 'root', '');
        $query = "SELECT * FROM postagem ORDER BY id_postagem DESC";
        $statement = $connect->prepare($query);
        $statement->execute();
        
        while($row = $statement->fetchObject('Postagem')){
            $resultado[] = $row; // armazeno dentro do array v�rios objetos do tipo postagem
        }
        if(!$resultado){
            throw new Exception('Nao Existe nenhum Registro no banco de dados!');
        }
        return $resultado;
       // var_dump($statement->fetchAll());
    }
    public static function getPostByid($idPost)
    {
        $connect = Connection::getConnection();

        $query = "SELECT * FROM postagem WHERE id_postagem = :id";
        $statement = $connect->prepare($query);
        $statement->bindValue(":id", $idPost, PDO::PARAM_INT);
        $statement->execute();

        $resultado = $statement->fetchObject('Postagem');

        // var_dump($resultado);
        if(!$resultado){
            throw new Exception("Nao foi encontrado nenhum registro no banco!");
        }else {
            $resultado->comentarios = Comentario::getComment($resultado->id_postagem);
        }
        return $resultado;
    }
    public static function insert($dadosPost)
    {
        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
            throw new Exception("Preencha todos os campos", 1);
            return false;
        }
        var_dump($dadosPost['titulo']);
        $connect = Connection::getConnection();
        $sql = $connect->prepare("INSERT INTO `postagem` (`titulo_postagem`, `conteudo_postagem`) VALUES (:titulo, :conteudo)");
        $sql->bindValue(':titulo', $dadosPost['titulo']);
        $sql->bindValue(':conteudo', $dadosPost['conteudo']);
        $resultado = $sql->execute();

        if($resultado === 0){
            throw new Exception("Falha ao inserir publicacao!");
            return false;
        }
        return true;
    }
    public static function delete($idPost)
    {
        $connect = Connection::getConnection();
        $query = "DELETE FROM postagem WHERE id_postagem = :id";
        $statement = $connect->prepare($query);
        $statement->bindValue(":id", $idPost, PDO::PARAM_INT);
        $statement->execute();
    }
    public static function update($idPost, $tituloPost, $conteudoPost)
    {
        //metodo que irei chamar depois do submit na update.html
        $connect = Connection::getConnection();

        $query = "UPDATE `postagem` SET `titulo_postagem` = :titulo, `conteudo_postagem` = :conteudo WHERE `postagem`.`id_postagem` = :id";
        $statement = $connect->prepare($query);
        $statement->bindValue(":titulo", $tituloPost);
        $statement->bindValue(":conteudo", $conteudoPost);
        $statement->bindValue(":id", $idPost, PDO::PARAM_INT);
        $statement->execute();

    }
}