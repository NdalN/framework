<?php

namespace Utilities;

use Configuration\Config as Config;

/**
 * Utility helper class which implements range of static methods to support small, often used http actions.
 *
 * @version 1.0.1
 */
class HttpHelper
{
    private static $_currentDomain;

    /**
     * Gets user sign in url.
     *
     * @return string Retuns user sign in url.
     */
    public static function getSingInUrl()
    {
        return Config::urlSecurity()->SignInUrl.
            '?domain='.base64_encode(self::getCurrentDomainName()).
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Gets user sign-out url.
     *
     * @return string Retuns user sign-out url.
     */
    public static function getSignOutUrl()
    {
        return Config::urlSecurity()->SignOutUrl.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Gets user sign-up url.
     *
     * @return string Retuns user sign-up url.
     */
    public static function getSignUp()
    {
        return Config::urlSecurity()->SignUpUrl.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Gets user forgot password url.
     *
     * @return string Retuns user forgot password url.
     */
    public static function getForgotPasswordlUrl()
    {
        return Config::urlSecurity()->ForgotPasswordUrl.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl'.urlencode(self::getOriginUrl());
    }

    /**
     * Gets user social sign-in url.
     *
     * @return string Retuns user social sign-in url.
     */
    public static function getSocialSignInUrl($name)
    {
        return Config::urlSecurity()->SignInUrlSocial.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&provider='.$name.'&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Gets user profil in url.
     *
     * @return string Retuns user profil in url.
     */
    public static function getUserProfileUrl()
    {
        return Config::urlSecurity()->ProfileUrl.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl()).
            '&domain='.base64_encode(self::getCurrentDomainName());
    }

    /**
     * Gets admin control panel url.
     *
     * @return string Retuns admin control panel url.
     */
    public static function getAdminControlPanelUrl()
    {
        return Config::urlSecurity()->AdminControlPanel.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Gets admin audit url.
     *
     * @return string Retuns admin audit url.
     */
    public static function getAuditUrl()
    {
        return Config::urlSecurity()->Audit.
            '?domain='.self::getCurrentDomainNameEncoded().
            (\Configuration\Config::generalProperties()->APIAuthentication ? '&authtoken=1' : '').
            '&returnurl='.urlencode(self::getReturnUrl()).
            '&originurl='.urlencode(self::getOriginUrl());
    }

    /**
     * Render html body for for specific layout.
     *
     * @var Template file name to render
     */
    public static function getCurrentDomainName()
    {
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * Gets encoded current domain name according url param domain.
     *
     * @return string Retuns encoded current domain name according url param domain.
     */
    public static function getCurrentDomainNameEncoded()
    {
        return base64_encode(self::getCurrentDomainName());
    }

    /**
     * Gets origin server url.
     *
     * @link http://stackoverflow.com/questions/6768793/get-the-full-url-in-php
     *
     * @param string $s                  Url.
     * @param bool   $use_forwarded_host Use forwarded host flag.
     *
     * @return string Returns origin server url.
     */
    public static function getOriginServerUrl($s, $use_forwarded_host = false)
    {
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')).(($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':'.$port;
        $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'].$port;

        return $protocol.'://'.$host;
    }

    /**
     * Builds origin Url.
     *
     * @return string Returns origin Url.
     */
    public static function buildOriginUrl()
    {
        return \Utilities\HttpHelper::getOriginServerUrl($_SERVER).$_SERVER['REQUEST_URI'];
    }

    /**
     * Gets the return url session variable.
     *
     * @return string Returns the return url session variable.
     */
    public static function getReturnUrl()
    {
        return self::getOriginServerUrl($_SERVER).$_SERVER['REQUEST_URI'];
    }

    /**
     * Get the origin url session variable.
     *
     * @return string Returns the origin url session variable.
     */
    public static function getOriginUrl()
    {
        return self::getOriginServerUrl($_SERVER) . APP_VIRTUAL_FOLDER;
    }

    /**
     * Gets referer domain name.
     *
     * @return string Returns referer domain name or emty string.
     */
    public static function getRefererDomain()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            return parse_url($_SERVER['HTTP_REFERER'])['host'];
        }

        return
            '';
    }

    /**
     * Gets url query string parameter value.
     *
     * @param string $url  Url.
     * @param string $name Parameter name.
     *
     * @return string Returns url query string parameter value.
     */
    public static function getUrlParam($url, $name)
    {
        $params = array();

        parse_str(parse_url($url)['query'], $params);

        if (isset($params[$name])) {
            return $params[$name];
        } else {
            return '';
        }
    }

    /**
     * Gets isLocalUrl flag.
     *
     * @param string $url Url.
     *
     * @return bool returns true if url is local.
     */
    public static function isLocalUrl($url)
    {
        $urlHost = parse_url($url, PHP_URL_HOST);
        $urlBaseHost = parse_url('http://'.\Utilities\HttpHelper::getCurrentDomainName(), PHP_URL_HOST);

        if ($urlHost == $urlBaseHost || empty($urlHost)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get sign-up domain.
     *
     * @return Domain Returns Domain class instance.
     */
    public static function getSignUpDomain()
    {
        //AppSession.SignUpDomain = Request.QueryString["domain"];
        //AppSession.SignUpDomain = String.IsNullOrEmpty(AppSession.SignUpDomain)  ? "" : AppSession.SignUpDomain;

        return \Utilities\HttpHelper::getCurrentDomain();
    }

    /**
     * Gets admin theme name.
     *
     * @return string Returns admin theme name.
     */
    public static function getAdminTheme()
    {
        return \Utilities\HttpHelper::getCurrentDomain()->ThemeAdmin;
    }

    /**
     * Gets public theme name.
     *
     * @return string Returns public theme name.
     */
    public static function getPublicTheme()
    {
        return \Utilities\HttpHelper::getCurrentDomain()->ThemePublic;
    }

    /**
     * Gets POST request method flag.
     *
     * @return bool Returns true if request method is POST.
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Gets GET request method flag.
     *
     * @return bool Returns true if request method is GET.
     */
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Gets isAjax glag.
     *
     * @return bool Returns true if request type is AJAX request.
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /**
     * Gets the after login url.
     *
     * @param string $parameters ApplicationParameters class instance.
     *
     * @return string Returns the after login url.
     */
    public static function getAfterLoginUrl($parameters)
    {
        $returnUrl = \Utilities\HttpHelper::getReturnUrl();

        $afterLoginUrl = '';

        if (!\Utilities\Helper::isNullOrEmpty($returnUrl)) {
            $afterLoginUrl = $returnUrl;
        } elseif ($parameters->RulesRedirectAfterLogin != null && strlen($parameters->RulesRedirectAfterLogin->Value) > 0) {
            $afterLoginUrl = $parameters->RulesRedirectAfterLogin->Value;
        }

        if (\Utilities\Helper::isNullOrEmpty($afterLoginUrl)) {
            $afterLoginUrl = '/profile';
        }

        return $afterLoginUrl;
    }

    /**
     * Gets the after logout url.
     *
     * @param string $parameters ApplicationParameters class instance.
     *
     * @return string Returns after loagout url.
     */
    public static function getAfterLogoutUrl($parameters)
    {
        $afterLogoutUrl = \Utilities\HttpHelper::getOriginUrl();

        if (\Utilities\Helper::isNullOrEmpty($afterLogoutUrl)) {
            if ($parameters->RulesRedirectAfterLogout != null && strlen($parameters->RulesRedirectAfterLogout->Value) > 0) {
                $afterLogoutUrl = $parameters->RulesRedirectAfterLogout->Value;
            }
        }

        if (\Utilities\Helper::isNullOrEmpty($afterLogoutUrl)) {
            $afterLogoutUrl = '/';
        }

        return $afterLogoutUrl;
    }

    /**
     * Gets the after sign-up url.
     *
     * @param string $parameters ApplicationParameters class instance.
     *
     * @return string Returns the after sign-up url.
     */
    public static function getAfterSignUpUrl($parameters)
    {
        $afterLogoutUrl = '';

        if ($parameters->RulesRedirectAfterSignUp != null && strlen($parameters->RulesRedirectAfterSignUp->Value) > 0) {
            $afterLogoutUrl = $parameters->RulesRedirectAfterSignUp->Value;
        }

        return $afterLogoutUrl;
    }

    /**
     * Gets IP info by user remote host IP addresss.
     *
     * @param string $ip          IP address.
     * @param string $purpose     Purpose.
     * @param bool   $deep_detect Deep detect flag.
     *
     * @link http://stackoverflow.com/questions/12553160/getting-visitors-country-from-their-ip
     * @link http://www.geoplugin.com/webservices/php
     * @link https://hungred.com/how-to/php-check-remote-email-url-image-link-exist/
     *
     * @return array Returns IP info: country, city, statte etc.
     */
    public static function getIPinfo($ip = null, $purpose = 'location', $deep_detect = true)
    {
        $output = null;

        //if (!HttpHelper::checkInternetConnection())
        //   return null;

        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = $_SERVER['REMOTE_ADDR'];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
            }
        }
        $purpose = str_replace(array('name', "\n", "\t", ' ', '-', '_'), null, strtolower(trim($purpose)));
        $support = array('country', 'countrycode', 'state', 'region', 'city', 'location', 'address');
        $continents = array(
            'AF' => 'Africa',
            'AN' => 'Antarctica',
            'AS' => 'Asia',
            'EU' => 'Europe',
            'OC' => 'Australia (Oceania)',
            'NA' => 'North America',
            'SA' => 'South America',
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case 'location':
                        $output = array(
                            'city' => @$ipdat->geoplugin_city,
                            'state' => @$ipdat->geoplugin_regionName,
                            'country' => @$ipdat->geoplugin_countryName,
                            'country_code' => @$ipdat->geoplugin_countryCode,
                            'continent' => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            'continent_code' => @$ipdat->geoplugin_continentCode,
                        );
                        break;
                    case 'address':
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1) {
                            $address[] = $ipdat->geoplugin_regionName;
                        }
                        if (@strlen($ipdat->geoplugin_city) >= 1) {
                            $address[] = $ipdat->geoplugin_city;
                        }
                        $output = implode(', ', array_reverse($address));
                        break;
                    case 'city':
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case 'state':
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case 'region':
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case 'country':
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case 'countrycode':
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }

        return $output;
    }
}
