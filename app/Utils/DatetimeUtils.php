<?php

namespace App\Utils;

use DateTime;

abstract class DatetimeUtils
{

    public static function getToday()
    {
        return date("Y-m-d H:i:s");
    }

    public static function getTodayWithoutHours()
    {
        return date("Y-m-d");
    }

    public static function addTime($date, $value, $format = "Y-m-d H:i:s")
    {
        return date($format, strtotime($value, strtotime($date)));
    }

    public static function diffMinutes($datestart, $dateend)
    {

        try {
            $dateStart = new DateTime($datestart);
            $dateEnd = new DateTime($dateend);
            $diff = $dateStart->diff($dateEnd);

            return ($diff->days * 24 * 60) + ($diff->h * 60) + ($diff->i);

        } catch (\Exception $e) {
            return 0;
        }


    }

    public static function diffDays($datestart, $dateend)
    {

        try {
            $dateStart = new DateTime($datestart);
            $dateEnd = new DateTime($dateend);
            $diff = $dateStart->diff($dateEnd);

            return $diff->days * ($diff->invert ? -1 : 1);

        } catch (\Exception $e) {
            return 0;
        }


    }

    public static function getDateFormat($fecha, $formato = "d/m/Y H:i:s")
    {
        try {
            if ($fecha == null || $fecha == "") {
                return "";
            }
            $fecha = new DateTime($fecha);
            return $fecha->format($formato);
        } catch (\Exception $er) {
            return "";
        }
    }

    public static function obtenerFechaLeible($fecha, $mostrarHoras = false)
    {

        if (!isset($fecha) || $fecha == null) return $fecha;

        try {
            $date = strtotime($fecha);

            $mes = self::getNombreMes(date('m', $date));
            if ($mostrarHoras) {
                return date('d', $date) . " de " . $mes . " del " . date('Y', $date) . " a las " . date('H:i:s', $date);
            } else {
                return date('d', $date) . " de " . $mes . " del " . date('Y', $date);
            }
        } catch (\Exception $err) {
            return $fecha;
        }
    }

    public static function getNombreMes($mes)
    {

        $txt = "";
        switch ($mes) {
            case '01':
                $txt = "Enero";
                break;
            case '02':
                $txt = "Febrero";
                break;
            case '03':
                $txt = 'Marzo';
                break;
            case '04':
                $txt = 'Abril';
                break;
            case '05':
                $txt = 'Mayo';
                break;
            case '06':
                $txt = 'Junio';
                break;
            case '07':
                $txt = 'Julio';
                break;
            case '08':
                $txt = 'Agosto';
                break;
            case '09':
                $txt = 'Setiembre';
                break;
            case '10':
                $txt = 'Octubre';
                break;
            case '11':
                $txt = 'Noviembre';
                break;
            case '12':
                $txt = 'Diciembre';
                break;
        }
        return $txt;
    }


}