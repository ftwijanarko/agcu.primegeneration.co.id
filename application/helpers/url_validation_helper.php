<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Validate URL
 *
 * @access    public
 * @param    string
 * @return    string
 */
function valid_url($url)
{
    $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
    if (!preg_match($pattern, $url))
    {
        return FALSE;
    }

    return TRUE;
}

// --------------------------------------------------------------------

/**
 * Real URL
 *
 * @access    public
 * @param    string
 * @return    string
 */
function real_url($url)
{
    return @fsockopen("$url", 80, $errno, $errstr, 30);
} 