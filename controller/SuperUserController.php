<?php
/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 26/02/2017
 * Time: 22:22
 */

namespace controller;


use DAL\LogGateway;
use modele\MdlSuperUser;
use modele\MdlUser;

class SuperUserController
{
    public function checkSuperUser(){
        if(isset($_SESSION)){
            if($_SESSION['role']=='superuser'){
                return;
            }
        }
        global $dir,$vues;
        require_once ($dir.$vues['header']);
        $err='Vous n\'avez pas les droits nécessaires pour effectuer cette action';
        require ($dir.$vues['error']);
        exit(1);
    }

    public function home()
    {
        $this->checkSuperUser();
        global $dir, $vues,$URL_API;
        $m=new MdlSuperUser();
        $data = $m->home($URL_API);
        $statut = $data->query->results->channel->item->condition->code;
        if($statut>47 or $statut<0) $statut = 3200;
        $temp = intval((intval($data->query->results->channel->item->condition->temp)-32)/1.800);
        require($dir . $vues['home']);
    }


    public function graph()
    {
        $this->checkSuperUser();
        global $dir, $vues;
        $m = new MdlSuperUser();
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
            $this->checkSuperUser();
            global $db_host,$db_name,$db_login,$db_password;
            $lg = new LogGateway($db_host,$db_name,$db_login,$db_password);
            $lg->insertData($_SESSION['login'],"Déconnexion de l'utilisateur.");
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
        $this->checkSuperUser();
        global $dir, $vues;
        $m = new MdlSuperUser();
        $m->data();
        require($dir.$vues['data']);
    }

    public function adminPage(){
        $this->checkSuperUser();
        global $dir,$vues;
        $m = new MdlSuperUser();
        $m->adminPage();
        require($dir.$vues['admin']);
    }
}