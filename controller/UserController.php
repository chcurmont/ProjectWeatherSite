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
        global $dir,$vues;
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
            header("index.php?action=".$vue);
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
}