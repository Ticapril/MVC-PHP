<?php 


class Core 
{
    public function start($urlGet)
    {
        // var_dump($urlGet);
        if(isset($urlGet['pagina'])) {
            // 1 -  armazeno o nome do controller ok
            $controller = ucfirst($urlGet['pagina'].'Controller'); 
            // ucfirst deixa a primeira letra da string maiuscula
        }else {
            $controller = 'HomeController';
        }
        // 2 - armazeno o nome do método
        if(isset($urlGet['metodo'])){
            $acao = $urlGet['metodo'];
        }else {
            $acao = 'index';
        }
        
        // 3 - verifico se esse controller existe
        if(!class_exists($controller)){
            $controller = 'ErrorController';
        }
        
        
        if(isset($urlGet['id']) && $urlGet['id'] != null){
            $id = $urlGet['id'];
        }else {
            $id = null;
        }

        if(isset($urlGet['titulo']) && $urlGet['titulo'] != null){
            $titulo = $urlGet['titulo'];
        }else {
            $titulo = null;
        }

        if(isset($urlGet['conteudo']) && $urlGet['conteudo'] != null){
            $conteudo = $urlGet['conteudo'];
        }else {
            $conteudo = null;
        }
        
        // essa função no array eu passo dois parametros a instancia do controller e no segundo o metodo que eu quero chamar
        call_user_func_array(array(new $controller,$acao), array('id' => $id, 'titulo' => $titulo, 'conteudo' => $conteudo));
    }
}