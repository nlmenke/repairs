<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Currency
| Category:     Helpers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      08/26/2012
| Description:  Converts normal numbers to currency.
*/

if(!function_exists('to_currency')) {
    /**
     * @param $number
     *
     * @return string
     */
    function to_currency($number) {
        $CI =& get_instance();

        $currency_symbol = $CI->config->item('currency_symbol') ? $CI->config->item('currency_symbol') : '$';

        if($number >= 0) {
            return $currency_symbol.number_format($number, 2, '.', '');
        } else {
            return '-'.$currency_symbol.number_format(abs($number), 2, '.', '');
        }
    }
}

if(!function_exists('to_currency_no_money')) {
    /**
     * @param $number
     *
     * @return string
     */
    function to_currency_no_money($number) {
        return number_format($number, 2, '.', '');
    }
}

/* End of file currency_helper.php */
/* Location: ./application/helpers/currency_helper.php */