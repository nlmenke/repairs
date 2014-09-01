<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         App Version
| Category:     Helpers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      04/01/2013
| Description:  Compiles version information.
*/

if(!function_exists('app_version')) {
    /**
     * @param null $full
     *
     * @return string
     */
    function app_version($full = null) {
        $version = APP_MAJOR_VER.'.'.APP_MINOR_VER;

        if($full != null) {
            $version .= '.'.APP_PATCH_VER;

            if(APP_STATUS == 'dev') {
                $version .= 'dev';
            } elseif(APP_STATUS == 'alpha') {
                $version .= '&alpha;';
            } elseif(APP_STATUS == 'beta') {
                $version .= '&beta;';
            }
        }

        return $version;
    }
}

/* End of file app_version_helper.php */
/* Location: ./application/helpers/app_version_helper.php */