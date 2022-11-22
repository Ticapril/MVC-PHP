<?php 

class HomeController {
    public function index() // listando coisas [postagens]
    {
        try {
                $postagens =  Postagem::getPostagem();  //armazeno todas as postagens na minha variavel
                $loader = new \Twig\Loader\FilesystemLoader('app/view'); // twig
                $twig = new \Twig\Environment($loader); // twig
                $template = $twig->load('home.html'); // twig
                
                $parametros = array(); // declara um array
                $parametros['postagens'] =  $postagens; // ai eu crio uma chave 'postagens' e associo as postagens que eu peguei do método getPostagem()

                $conteudo = $template->render($parametros); //renderiza com o twig
                
                echo $conteudo;    // exibe na tela com o echo 
        } catch (\Throwable $th) {
            echo $th->getMessage(); //caso não funcione exibe mensagem de erro
        } 
    }
}