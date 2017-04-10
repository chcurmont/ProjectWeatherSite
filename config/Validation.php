<?php

namespace config;

class Validation
{
    /**
     * @param $val
     * @return bool
     */
    public function validateInt($val)
    {
        return preg_match("#^[0-9]{1,}$#",$val);
    }

    /**
     * @param $val
     * @return int
     */
    public function validateHeure($val){
        return preg_match("#^[[0-9]{2}:]{2}[0-9]$#",$val);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateEmail($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateBoolean($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateIp($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_IP);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateUrl($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_URL);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateMac($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_MAC);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return bool
     */
    public function validateFloat($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_FLOAT);
        return ($val !== FALSE);
    }

    /**
     * @param $val
     * @return int
     */
    public function validateAlnum($val)
    {
        $filter="#^[a-zA-Z0-9]*$#";
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @return int
     */
    public function validateAlpha($val)
    {
        $filter="#^[a-zA-Z]*$#";
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @param $longueur
     * @return bool|int
     */
    public function validateAlnumLongueur($val, $longueur)
    {
        if($this->validateInt($longueur)) {
            $filter = "#^[a-zA-Z0-9]{".$longueur."}.$#";
        }
        else{
            return false;
        }
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @param $longueur
     * @return bool|int
     */
    public function validateAlphaLongueur($val, $longueur)
    {
        if($this->validateInt($longueur)) {
            $filter = "#^[a-zA-Z]{".$longueur."}.$#";
        }
        else{
            return false;
        }
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @param $min
     * @param $max
     * @return bool
     */
    public function validateEntierIntervalleInclus($val, $min, $max)
    {
        if($this->validateInt($min) && $this->validateInt($max) && $this->validateInt($val)){
            if($val>=$min && $val<=$max)
                return true;
            else
                return false;
        }
        else{
            return false;
        }
    }

    /**
     * @param $val
     * @param $min
     * @param $max
     * @return bool|int
     */
    public function validateReelIntervalle($val, $min, $max)
    {
        if($this->validateFloat($min) && $this->validateFloat($max)){
            $filter="#^[".$min."-".$max."].$#";
        }
        else{
            return false;
        }
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @param $tab
     * @return bool|int
     */
    public function validateStringDansTab($val, $tab)
    {
        if($tab==null){
            return false;
        }
        $filter='#^(';
        foreach($tab as $ligne){
            if($ligne==$tab[count($tab)-1]){
                $filter=$filter.$ligne;
            }
            else {
                $filter = $filter . $ligne . '|';
            }
        }
        $filter=$filter.'){1,}$#';
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @param $tab
     * @return bool|int
     */
    public function validateMorceauStringDansTab($val, $tab)
    {
        if($tab==null){
            return false;
        }

        $filter='#(';
        foreach($tab as $ligne){
            if($ligne==$tab[count($tab)-1]){
                $filter=$filter.$ligne;
            }
            else {
                $filter = $filter . $ligne . '|';
            }
        }
        $filter=$filter.'){1,}#';
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @return int
     */
    public function validatePrintable($val)
    {
        $filter="#^[\x20-\x7E]*$#";
        $val = preg_match($filter, $val);
        return $val;
    }

    /**
     * @param $val
     * @return int
     */
    public function validatePrintableSansEspaces($val)
    {
        $filter="#^[\x21-\x7E]*$#";
        $val = preg_match($filter, $val);
        return $val;
    }
}