<?php

namespace controller;

use config\Nettoyer;
use config\Validation;
use controller\AdminController;
use controller\UserController;

class FrontController
{
    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        try {
            global $actions, $actionsAdmin, $actionsSU;

            $v = new Validation();
            $n = new Nettoyer();

            if (!isset($_SESSION['role'])) {
                $_SESSION['role'] = 'user';
            }
            $_SESSION['role'] = $n->nettoyer_string($_SESSION['role']);
            if ($_SESSION['role'] == 'admin') {
                $c = new  AdminController();
                if (!isset($_REQUEST['action'])) {
                    $c->home();
                    return;
                }
                $_REQUEST['action'] = $n->nettoyer_string($_REQUEST['action']);
                if (!in_array($_REQUEST['action'], $actions) && !in_array($_REQUEST['action'], $actionsAdmin) && !in_array($_REQUEST['action'], $actionsSU)) {
                    $c->error('Unknown action: ' . $_REQUEST['action']);
                    return;
                }

                switch ($_REQUEST['action']) {
                    case null:
                        $c->error('Unknown action: ' . $_REQUEST['action']);
                        break;
                    case "graph":
                        $c->graph();
                        break;
                    case "data":
                        $c->data();
                        break;
                    case "deconnection":
                        $c->disconnect();
                        break;
                    case "adminPage":
                        $c->adminPage();
                        break;
                    case "home":
                        $c->home();
                        break;
                    default:
                        $c->error('Not implemented action: ' . $_REQUEST['action']);
                        break;
                }
            } elseif ($_SESSION['role'] == 'superuser') {
                $c = new SuperUserController();
                if (!isset($_REQUEST['action'])) {
                    $c->home();
                    return;
                }
                $_REQUEST['action'] = $n->nettoyer_string($_REQUEST['action']);
                if (!in_array($_REQUEST['action'], $actionsSU) && !in_array($_REQUEST['action'], $actions)) {
                    $c->error('Unknown action: ' . $_REQUEST['action']);
                    return;
                }

                switch ($_REQUEST['action']) {
                    case null:
                        $c->error('Unknown action: ' . $_REQUEST['action']);
                        break;
                    case "graph":
                        $c->graph();
                        break;
                    case "data":
                        $c->data();
                        break;
                    case "deconnection":
                        $c->disconnect();
                        break;
                    case "adminPage":
                        $c->adminPage();
                        break;
                    case "home":
                        $c->home();
                        break;
                    default:
                        $c->error('Not implemented action: ' . $_REQUEST['action']);
                        break;
                }
            } else {
                $c = new UserController();
                if (!isset($_REQUEST['action'])) {
                    $c->home();
                    return;
                }
                $_REQUEST['action'] = $n->nettoyer_string($_REQUEST['action']);
                if (!in_array($_REQUEST['action'], $actions)) {
                    $c->error('Unknown action: ' . $_REQUEST['action']);
                    return;
                }
                switch ($_REQUEST['action']) {
                    case null:
                        $c->home();
                        break;
                    case "data":
                        $c->data();
                        break;
                    case "graph":
                        $c->graph();
                        break;
                    case "connection":
                        $c->connection();
                        break;
                    case "home":
                        $c->home();
                        break;
                    case "register":
                        $c->register();
                        break;
                    default:
                        $c->error('Not implemented action: ' . $_REQUEST['action']);
                        break;
                }
            }
        }
        catch(\Exception $e){
            $c = new UserController();
<<<<<<< HEAD
            $c->error($e->getMessage());
=======
            if (!isset($_REQUEST['action'])) {
                $c->home();
                return;
            }
            $_REQUEST['action']=$n->nettoyer_string($_REQUEST['action']);
            if(!in_array($_REQUEST['action'],$actions)){
                $c->error('Unknown action: '.$_REQUEST['action']);
                return;
            }
            switch($_REQUEST['action']){
                case null:
                    $c->home();
                    break;
                case "data":
                    $c->data();
                    break;
                case "graph":
                    $c->graph();
                    break;
                case "connection":
                    $c->connection();
                    break;
                case "home":
                    $c->home();
                    break;
                case "register":
                    $c->register();
                    break;
                default:
                    $c->error('Not implemented action: '.$_REQUEST['action']);
                    break;
            }
        }
>>>>>>> origin/master
    }
}
}