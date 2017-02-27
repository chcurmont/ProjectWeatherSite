<?php

namespace controller;


use modele\MdlAdmin;

class AdminController
{
    /**
     *
     */
    public function checkAdmin(){
        if(isset($_SESSION)){
            if($_SESSION['role']=='admin'){
                return;
            }
        }
        global $dir,$vues;
        $err='Vous n\'avez pas les droits nécessaires pour effectuer cette action';
        require ($dir.$vues['error']);
        exit(1);
    }

    /**
     *
     */
    public function home()
    {
        $this->checkAdmin();
        global $dir, $vues;
        require($dir . $vues['home']);
    }

    /**
     *
     */
    public function graph()
    {
        $this->checkAdmin();
        global $dir, $vues;
        $m = new MdlAdmin();
        $m->graph();
        require($dir . $vues['graph']);
    }

    public function error($err)
    {
        try{
            global $dir, $vues;
            require($dir.$vues['error']);
        }
        catch(\Exception $e){
            echo 'Fatal  exception: '.$e->getMessage();
            exit(1);
        }
        catch(\Error $e){
            echo 'Fatal error: '.$e->getMessage();
            exit(1);
        }
    }

    public function disconnect(){
        try{
            $this->checkAdmin();
            session_unset();
            session_destroy();
            header('Location: index.php');
        }
        catch(\Exception $e){
            $this->error('Exception: '.$e->getMessage());
            exit(1);
        }
        catch(\Error $e){
            $this->error('Error: '.$e->getMessage());
            exit(1);
        }
    }

    public function data(){
        $this->checkAdmin();
        global $dir, $vues;
        $m = new MdlAdmin();
        $m->data();
        require($dir.$vues['data']);
    }

    public function adminPage(){
        $this->checkAdmin();
        global $dir,$vues;
        $m = new MdlAdmin();
        $m->adminPage();
        require($dir.$vues['admin']);
    }
}