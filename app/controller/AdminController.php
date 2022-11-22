<?php 

class AdminController {
    public function index() // listando coisas [postagens]
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        $objetosPostagens = Postagem::getPostagem();
         
        $parametros = array();
        $parametros['postagens'] = $objetosPostagens;
        
        $conteudo = $template->render($parametros);
        echo $conteudo; 
    }
    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();
        $conteudo = $template->render($parametros);
        echo $conteudo; 
    }
    public function insert()
    {
        try {
            Postagem::insert($_POST);
            echo '<script>alert("Publicacao inserida com sucesso!");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=index"</script>';            
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=create"</script>';            
        }
    }
    public function delete($params)
    {
        try {
            Postagem::delete($params);
            echo '<script>alert("Publicacao deletada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=index"</script>';            
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=index"</script>';            
        }
    }
    public function showRecord()
    {
        $postagem =  Postagem::getPostByid($_GET['id']);       
            
                //exibição da view
                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('update.html');
                
                $parametros = array();
                $parametros['id'] =  $postagem->id_postagem;
                $parametros['titulo'] =  $postagem->titulo_postagem;
                $parametros['conteudo'] = $postagem->conteudo_postagem;
                $conteudo = $template->render($parametros);
                echo $conteudo;    
    }
    public function update()
    {
        try{
            Postagem::update($_GET['id'],$_POST['titulo'], $_POST['conteudo']);
            echo '<script>alert("Publicacao editada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=index"</script>';
        }catch(PDOException $e){
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/mvc-php/?pagina=admin&metodo=create"</script>';  
        }
    }

}