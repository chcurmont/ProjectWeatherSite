<?php

namespace config;

class Nettoyer
{
    /**
     * @param $valeur
     * @return mixed
     */
    public static function nettoyer_int($valeur){
        return filter_var($valeur,FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * @param $valeur
     * @return mixed
     */
    public static function nettoyer_string($valeur){
        return filter_var($valeur,FILTER_SANITIZE_STRING);
    }

    /**
     * @param $valeur
     * @return mixed
     */
    public static function nettoyer_float($valeur){
        return filter_var($valeur,FILTER_SANITIZE_NUMBER_FLOAT);
    }

    /**
     * @param $valeur
     * @return mixed
     */
    public static function nettoyer_email($valeur){
        return filter_var($valeur,FILTER_SANITIZE_EMAIL);
    }

    /**
     * @param $valeur
     * @return mixed
     */
    public static function nettoyer_url($valeur){
        return filter_var($valeur,FILTER_SANITIZE_URL);
    }
}