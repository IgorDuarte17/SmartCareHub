<?php

if (!function_exists('validate_cns')) {
    /**
     * @param $cns
     * @return mixed
     */
    function validate_cns($cns) {
        if (strlen(trim($cns)) != 15) {
            return false;
        }

        $soma = 0;
        $resto = 0;
        $dv = 0;
        $pis = substr($cns, 0, 11);
        $resultado = "";

        for ($i = 0; $i < 11; $i++) {
            $soma += (int) $pis[$i] * (15 - $i);
        }

        $resto = $soma % 11;
        $dv = 11 - $resto;

        if ($dv == 11) {
            $dv = 0;
        }

        if ($dv == 10) {
            $soma += 2;
            $resto = $soma % 11;
            $dv = 11 - $resto;
            $resultado = $pis . "001" . (int) $dv;
        } else {
            $resultado = $pis . "000" . (int) $dv;
        }

        return $cns === $resultado;
    }
}

if (!function_exists('validate_cns_prov')) {
    /**
     * @param $cns
     * @return mixed
     */
    function validate_cns_prov($cns) {
        if (strlen(trim($cns)) != 15) {
            return false;
        }

        $dv = 0;
        $resto = 0;
        $soma = 0;

        for ($i = 0; $i < 15; $i++) {
            $soma += (int) $cns[$i] * (15 - $i);
        }

        $resto = $soma % 11;

        return $resto == 0;
    }
}
