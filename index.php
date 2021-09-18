<?php
    require_once './views/includes/header.php';
    require_once './autoload.php';
    require_once './controllers/HomeController.php';

    $home=new HomeController();

    $pages=['home','add','delete','update','logout'];
    if(isset($_SESSION['logged']) && $_SESSION['logged'] === true){
        if(isset($_GET['page'])){
            if(in_array($_GET['page'],$pages)){
                $page=$_GET['page'];
                $home->index($_GET['page']);
            }else{
                include('views/includes/404.php');
            }
        }else{
            $home->index('home');
        }
        require_once './views/includes/footer.php';
    }else if(isset($_GET['page']) && $_GET['page'] === 'register'){
        $home->index('register');
    }else{
        $home->index('login');
    }

