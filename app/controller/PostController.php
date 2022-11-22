<?php 


class PostController {
    public function index($params)
    {
        try {
                $postagem =  Postagem::getPostByid($params);       
            
                //exibição da view
                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('single.html');
                
                $parametros = array();
                $parametros['titulo'] =  $postagem->titulo_postagem;
                $parametros['conteudo'] = $postagem->conteudo_postagem;
                $parametros['comentarios'] =  $postagem->comentarios;

                $conteudo = $template->render($parametros);
                echo $conteudo;    
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } 
    }
}