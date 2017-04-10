<?php
/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 08/01/2017
 * Time: 22:01
 */

namespace controller;


use config\Validation;
use Exception;
use modele\MdlUser;

class UserController
{
    /**
     *
     */
    public function home(){
        global $dir,$vues,$URL_API;
        $m=new MdlUser();
        $data = $m->home($URL_API);
        $statut = $data->query->results->channel->item->condition->code;
        if($statut>47 or $statut<0) $statut = 3200;
        $temp = intval((intval($data->query->results->channel->item->condition->temp)-32)/1.800);
        require($dir.$vues['home']);
    }

    /**
     *
     */
    public function graph(){
        global $dir,$vues;
        $m = new MdlUser();
        $m->graph();
        require($dir.$vues['graph']);
    }

    /**
     *
     */
    public function connection(){
        try {
            global $dir, $vues, $vue;
            $m = new MdlUser();
            $v = new Validation();

            if (isset($_REQUEST['err'])) {
                $err = $_REQUEST['err'];
            }

            if (isset($_REQUEST['login']) && isset($_REQUEST['pwd'])) {
                if ($v->validatePrintableSansEspaces($_REQUEST['login']) && $v->validatePrintableSansEspaces($_REQUEST['pwd'])) {
                    $logG = $m->connection();
                }
            }
            header('location: index.php');
        }
        catch(Exception $e){
            $err=$e->getMessage();
            require($dir.$vues['error']);
        }
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

    public function data(){
        global $dir, $vues;
        $m = new MdlUser();
        $m->data();
        require($dir.$vues['data']);
    }

    public function register(){
        global $vues,$dir;
        if(!isset($_REQUEST['idRegister'])){
            require($dir.$vues['register']);
        }
        else{
            $m = new MdlUser();
            $m->register();
            require($dir.$vues['home']);
        }
    }
}