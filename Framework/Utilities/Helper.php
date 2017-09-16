<?php

namespace Utilities;

/**
 * Utility helper class which implements range of static methods to support small, often used actions.
 *
 * @version 1.0.1
 */
class Helper
{
    /**
     * Get current languag code.
     *
     * @return string Returns current langusge code.
     */
    public static function getCurrentLanguage()
    {
        return 'eng';
    }

    /**
     * Converts comma separated string to int array.
     *
     * @param string $source Comma separated string
     *
     * @return array Array of in numbers
     */
    public static function convertArrayStringToInt($source)
    {
        if ($source != null) {
            return  array_map('intval', explode(',', $source));
        } else {
            return array();
        }
    }

    /**
     * Evaluates if value is null or empty.
     *
     * @param string $value Source value.
     *
     * @return bool Return true if value is null or empty.
     */
    public static function isNullOrEmpty($value)
    {
        if ($value == null || strlen(trim($value)) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function isDarkThemeAdmin()
    {
        $isDark = false;
        $themeName = \Utilities\HttpHelper::getAdminTheme();

        switch ($themeName) {
            case 'cerulean':
                $isDark = false;
                break;
            case 'cosmo':
                $isDark = false;
                break;
            case 'cyborg':
                $isDark = true;
                break;
            case 'darkly':
                $isDark = true;
                break;
            case 'bootstrap':
                $isDark = false;
                break;
            case 'flatly':
                $isDark = false;
                break;
            case 'journal':
                $isDark = false;
                break;
            case 'lumen':
                $isDark = false;
                break;
            case 'paper':
                $isDark = false;
                break;
            case 'readable':
                $isDark = false;
                break;
            case 'sandstone':
                $isDark = false;
                break;
            case 'simplex':
                $isDark = false;
                break;
            case 'slate':
                $isDark = true;
                break;
            case 'spacelab':
                $isDark = false;
                break;
            case 'superhero':
                $isDark = false;
                break;
            case 'united':
                $isDark = false;
                break;
            case 'yeti':
                $isDark = false;
                break;
            default:
                $isDark = false;
                break;
        }

        return $isDark;
    }

    /**
     * Gets top menu element status: active or not.
     *
     * @param string $context    ApplicationContext class instant.
     * @param string $controller Controller name.
     *
     * @return bool Return top menu element status: active or not.
     */
    public static function isActive($context, $controller)
    {
        if (!isset($context) || !isset($controller)) {
            return '';
        }

        if ($context->application->controllerName() == $controller) {
            return 'active';
        } else {
            return '';
        }
    }

    /**
     * Gets clean value for specific query string parameter.
     * http://www.sitepoint.com/php-security-cross-site-scripting-attacks-xss/.
     *
     * @param string $name Query string parameter name.
     *
     * @return string Returns Query string parameter value or empty if forbdenn chars exists.
     */
    public static function getGet($name)
    {
        if (isset($_GET[$name])) {
            return preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET[$name]);
        } else {
            return '';
        }
    }

    /**
     * Gets POST parameters as stdClass class instance with properties.
     *
     * @return stdClass Returns stdClass class instance with properties.
     */
    public static function getPost()
    {
        if (isset($_POST) && count($_POST) > 0) {
            return (object) $_POST;
        } else {
            return json_decode(file_get_contents('php://input'));
        }
    }

    /**
     * Gets POST values array.
     *
     * @return array Returns POST values array.
     */
    public static function getPostVar()
    {
        return $_POST;
    }

    /**
     * Gets uploaded file content.
     * http://stackoverflow.com/questions/3586919/why-would-files-be-empty-when-uploading-files-to-php.
     *
     * @return array Returns uploaded file content.
     */
    public static function getPostFile()
    {
        return file_get_contents($_FILES['userfile']['tmp_name']);
    }

    /**
     * Redirects to specific location by URL.
     *
     * @param string $url URL location.
     */
    public static function reidrectToAction($url)
    {
        header('location: '.URL.$url);
    }

    /**
     * Performs formatting array according to string template.
     *
     * @link http://tmont.com/blargh/2010/1/string-format-in-php
     * @link http://stackoverflow.com/questions/7142077/php-equivalent-to-c-sharp-string-formatting
     *
     * @param array $format Plain text template string.
     *
     * @return string Returns formatted array according to string template.
     */
    public static function format($format /*, ... */)
    {
        $args = func_get_args();
        $format = array_shift($args);

        preg_match_all('/(?=\{)\{(\d+)\}(?!\})/', $format, $matches, PREG_OFFSET_CAPTURE);
        $offset = 0;
        foreach ($matches[1] as $data) {
            $i = $data[0];
            $format = substr_replace($format, @$args[$i], $offset + $data[1] - 1, 2 + strlen($i));
            $offset += strlen(@$args[$i]) - 2 - strlen($i);
        }

        return $format;
    }

    /**
     * Makes CSV file from array.
     *
     * @param array $array Source array.
     *
     * @return string Returns the current buffer contents and delete current output buffer.
     */
    public static function arrayToCSV($array)
    {
        if (count($array) == 0) {
            return;
        }

        ob_start();

        $df = fopen('php://output', 'w');

        foreach ($array as $row) {
            fputcsv($df, $row);
        }

        fclose($df);

        return ob_get_clean();
    }

    /**
     * Sets download file headers.
     *
     * @param string $filename File name.
     */
    public static function downloadSendHeaders($filename)
    {
        // disable caching
        $now = gmdate('D, d M Y H:i:s');
        header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        header('Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate');
        header("Last-Modified: {$now} GMT");

        // force download
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header('Content-Transfer-Encoding: binary');
    }

    /**
     * Gets time ago as readable string .
     *
     * @param DatTime $datetime Date time value.
     * @param string  $timeZone Time Zone value.
     * @param bool    $full     Full string flag.
     *
     * @return string returns time ago as readable string
     */
    public static function timeAgo2($datetime, $timeZone = '', $full = false)
    {
        if (\Utilities\Helper::IsNullOrEmpty($timeZone)) {
            $now = new \DateTime();
            $ago = new \DateTime($datetime);
        } else {
            $now = \Utilities\Helper::getUTCNow();
            $ago = clone $datetime;
            $ago = $ago->setTimezone(new \DateTimeZone($timeZone));
        }

        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'Year',
            'm' => 'Month',
            'w' => 'Week',
            'd' => 'Day',
            'h' => 'Hour',
            'i' => 'Minute',
            's' => 'Second',
        ];

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k.' '.$v.($diff->$k > 1 ? ' ' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string).'' : 'just now';
    }

    /**
     * Gets time ago as readable string .
     *
     * @link http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
     * @link http://stackoverflow.com/questions/5010016/php-time-since-function
     *
     * @param DatTime  $datetime Date time value.
     * @param DateTime $time_ago Date time value
     *
     * @return string returns time ago as readable string
     */
    public static function timeAgo($time_ago)
    {
        if (\Utilities\Helper::isNullOrEmpty($time_ago)) {
            return '';
        }

        $timeZone = \Core\UserIdentity::getTimeZone();

        $cur_time = strtotime(\Utilities\Helper::getUtcNow()->format('Y-m-d H:i:s'));
        $time_ago = strtotime($time_ago);
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return 'just now';
        } elseif ($minutes <= 60) { //Minutes

            if ($minutes == 1) {
                return 'one minute ago';
            } else {
                return "$minutes minutes ago";
            }
        } elseif ($hours <= 24) { //Hours
            if ($hours == 1) {
                return 'an hour ago';
            } else {
                return "$hours hrs ago";
            }
        } elseif ($days <= 7) { //Days
            if ($days == 1) {
                return 'yesterday';
            } else {
                return "$days days ago";
            }
        } elseif ($weeks <= 4.3) { //Weeks
            if ($weeks == 1) {
                return 'a week ago';
            } else {
                return "$weeks weeks ago";
            }
        } elseif ($months <= 12) { //Months
            if ($months == 1) {
                return 'a month ago';
            } else {
                return "$months months ago";
            }
        } else { //Years
            if ($years == 1) {
                return 'one year ago';
            } else {
                return "$years years ago";
            }
        }
    }

    /**
     * Gets local date time according to time zone.
     *
     * @param dateTime $date Date tiem value.
     *
     * @return string Returns local date time according to time zone.
     */
    public static function getLocalDateTime($date)
    {
        $timeZone = \Core\UserIdentity::getTimeZone();

        if (!\Utilities\Helper::IsNullOrEmpty($timeZone)) {
            $time_utc = new \DateTime($date, new \DateTimeZone('UTC'));
            $time_utc->setTimezone(new \DateTimeZone($timeZone));
            $date = $time_utc->format('Y-m-d H:i:s');
        }

        return $date;
    }

    /**
     * Gets time zone list array.
     *
     * @return array Returns time zone list array.
     */
    public function getTimeZoneList2()
    {
        $result = array();
        $timezones = array();

      // only process geographical timezones
        foreach (preg_grep('~^(?:A(?:frica|merica|ntarctica|rctic|tlantic|sia|ustralia)|Europe|Indian|Pacific)/~', timezone_identifiers_list()) as $timezone) {
            if (is_object($timezone = new \DateTimeZone($timezone)) === true) {
                $id = array();

                // get only the two most distant transitions
                foreach (array_slice($timezone->getTransitions($_SERVER['REQUEST_TIME']), -2) as $transition) {
                    // dark magic
                    $id[] = sprintf('%b|%+d|%u', $transition['isdst'], $transition['offset'], $transition['ts']);
                }

                if (count($id) > 1) {
                    sort($id, SORT_NUMERIC); // sort by %b (isdst = 0) first, so that we always get the raw offset
                }

                $timezones[implode('|', $id)][] = $timezone->getName();
            }
        }

        // sort offsets by -, 0, +
        if ((is_array($timezones) === true) && (count($timezones) > 0)) {
            uksort($timezones, function ($a, $b) {
                foreach (array('a', 'b') as $key) {
                    $$key = explode('|', $$key);
                }

                return intval($a[1]) - intval($b[1]);
            });

            foreach ($timezones as $key => $value) {
                $zone = reset($value); // first timezone ID is our internal timezone
                $result[$zone] = preg_replace(array('~^.*/([^/]+)$~', '~_~'), array('$1', ' '), $value); // "humanize" city names

                // "humanize" the offset
                if (array_key_exists(1, $offset = explode('|', $key)) === true) {
                    $offset = str_replace(' +00:00', '', sprintf('(UTC %+03d:%02u)', $offset[1] / 3600, abs($offset[1]) % 3600 / 60));
                }

                // sort city names
                if (asort($result[$zone]) === true) {
                    $result[$zone] = trim(sprintf('%s %s', $offset, implode(', ', $result[$zone])));
                }
            }
        }

        return $result;
    }

    /**
     * Gets local date time according to time zone.
     * Modified version of the timezone list function from @link http://stackoverflow.com/a/17355238/507629
     * Includes current time for each timezone (would help users who don't know what their timezone is).
     *
     * @link http://stackoverflow.com/questions/1727077/generating-a-drop-down-list-of-timezones-with-php
     *
     * @return array Returns time zone list array.
     */
    public static function getTimeZoneList()
    {
        static $regions = array(
            \DateTimeZone::AFRICA,
            \DateTimeZone::AMERICA,
            \DateTimeZone::ANTARCTICA,
            \DateTimeZone::ASIA,
            \DateTimeZone::ATLANTIC,
            \DateTimeZone::AUSTRALIA,
            \DateTimeZone::EUROPE,
            \DateTimeZone::INDIAN,
            \DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach ($regions as $region) {
            $timezones = array_merge($timezones, \DateTimeZone::listIdentifiers($region));
        }

        foreach ($timezones as $timezone) {
            $tz = new \DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new \DateTime());
        }

        // sort timezone by timezone name
        ksort($timezone_offsets);

        $timezone_list = array();
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H:i', abs($offset));

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $t = new \DateTimeZone($timezone);
            $c = new \DateTime(null, $t);
            $current_time = $c->format('g:i A');

            $timezone_name = str_replace('/', ' ', $timezone);

            $timezone_list[$timezone] = "(${pretty_offset}) $timezone_name"; // - $current_time";
        }

        return $timezone_list;
    }

    /**
     * Gets random string.
     *
     * @link http://stackoverflow.com/questions/4356289/php-random-string-generator
     *
     * @param int $length String length.
     *
     * @return string Returns random string.
     */
    public static function generateRandomString($length = 10)
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }

    /**
     * Gets password hash. Calculates password hash via custom algorithm in order to secure short passwords.
     *
     * @param string $password Password plain text string
     *
     * @return string Returns calculated password hash in hexadecimal format.
     */
    public static function computePasswordHash($password)
    {
        $hash = \Utilities\Helper::computePasswordHashSHA1($password);

        $value = \Utilities\Helper::computePasswordHashSHA1(\Utilities\Helper::computePasswordHashMD5($password.substr($hash, 7, 7).substr($hash, 7, 7)));

        return strtoupper(\Utilities\Helper::string2Hex($value));
    }

    /**
     * Gets password hash using SHA1 algorithm.
     *
     * @param string $password Password plain text string
     *
     * @return string Returns calculated password hash in base64 format.
     */
    public static function computePasswordHashSHA1($password)
    {
        return base64_encode(sha1($password, true));
    }

    /**
     * Gets password hash using MD5 algorithm.
     *
     * @link http://stackoverflow.com/questions/4433744/php-md5-base64-encryption-to-c-sharp-md5-base64-encryption
     *
     * @param string $password Password plain text string
     *
     * @return string Returns calculated password hash in base64 format.
     */
    public static function computePasswordHashMD5($password)
    {
        return base64_encode(md5($password, true));
    }

    /**
     * Gets hex string from plain text string.
     *
     * @param string $string Plain text string.
     *
     * @link http://www.jonasjohn.de/snippets/php/hex-string.htm
     *
     * @return string Returns hex string.
     */
    public static function string2Hex($string)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); ++$i) {
            $hex .= dechex(ord($string[$i]));
        }

        return $hex;
    }

    /**
     * Gets plain text string from hex string.
     *
     * @param string $hex Hex text string.
     *
     * @return string Returns plain text string.
     */
    public static function hex2String($hex)
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i].$hex[$i + 1]));
        }

        return $string;
    }

    /**
     * Gets alpha numeric flag.
     *
     * @link http://stackoverflow.com/questions/3938021/how-to-check-for-special-characters-php
     *
     * @param string $source Plain text string.
     *
     * @return bool Returns true if string is alpha numeric.
     */
    public static function isAlphaNumeric($source)
    {
        return !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $source);
    }

    /**
     * Validates if is address has email format.
     *
     * @param string $mail Email.
     *
     * @return bool Returns true if is address has email format.
     */
    public static function isEmail($mail)
    {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Gets current UTC time.
     *
     * @return DateTime Returns current UTC time.
     */
    public static function getUTCNow()
    {
        $date = new \DateTime('now');
        $date->setTimezone(new \DateTimeZone('UTC'));

        return $date;
    }

    /**
     * Implements the sing out for cross domain authentication supporting.
     * Gets user data by auth token and redirects to the requested page.
     *
     * @param \CVore\UserIdentity $userIdentity User identity class insatnce
     */
    public static function processSignInByToken($userIdentity)
    {
        if (APP_API_AUTHENTICATION) {
            $token = isset($_GET['token']) ? $_GET['token'] : '';

            if ($token != null) {
                // Try to find authentication token

                if ($token != '') {
                    // Do the API call and set session values.

                    $result = self::api(
                        'GET',
                        \Configuration\Config::generalProperties()->APIEndPoint,
                        \Configuration\Config::generalProperties()->APIUser,
                        \Configuration\Config::generalProperties()->APIToken,
                        'getUserByAuthenticationToken',
                        array('token' => $_GET['token']),
                        false
                    );

                    if (!is_null($result)) {
                        if ($result->status > 0) {
                            /*
                             * Some action nedded if server to server request has failed.
                             * Stop or redirect to a page with appropritae message
                             */
                            echo 'Authentication token not found or API server cannot be reached.';
                            die();

                        } else {
                            $userIdentity->signIn(
                                $result->data->user,
                                (array) $result->data->roles,
                                $result->data->socialNetwork
                            );
                        }
                    } else {
                        /*
                         * Some action nedded if server to server request has failed.
                         * Stop or redirect to a page with appropritae message
                         */
                        echo 'Authentication token not found or API server cannot be reached.';
                        die();
                    }

                    $url = self::getUrlWithoutParam('token');
                    header('location: '.$url);
                    die();
                }
            }
        }
    }

    /**
     * Implements the sing out for cross domain authentication supporting.
     */
    public static function processSignOutByParam()
    {
        if (APP_API_AUTHENTICATION) {
            $signout = isset($_GET['signout']) ? $_GET['signout'] : '';

            if ($signout != null) {
                if (session_status() != PHP_SESSION_NONE) {
                    // Unset all of the session variables.
                    $_SESSION = array();

                    // If it's desired to kill the session, also delete the session cookie.
                    // Note: This will destroy the session, and not just the session data!
                    if (ini_get('session.use_cookies')) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                    }

                    // Finally, destroy the session.
                    session_destroy();
                }

                $url = self::getUrlWithoutParam('signout');
                header('location: '.$url);
                die();
            }
        }
    }

    /**
     * Removes a param from a query.
     *
     * @param string $name Parameter name
     *
     * @return string Returns the query without the parameter.
     */
    public static function getUrlWithoutParam($name)
    {
        $url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        $parsed = parse_url($url);
        $query = $parsed['query'];

        parse_str($query, $params);
        unset($params[$name]);

        $url = '//'.$parsed['host'].$parsed['path'].http_build_query($params);

        return $url;
    }

    /**
     * Calls API methods using token based on basic authorization.
     *
     * @param string $method     GET, POST, PUT
     * @param string $base_url   API base url
     * @param string $api_user   API user string
     * @param string $api_token  API token string
     * @param string $api_method API method name
     * @param bool   $data       Data which will be send to API method
     *
     * @link http://php.net/manual/en/function.curl-error.php
     *
     * @return obejct Returns object which has been created from received JSON response.
     */
    public static function api($method, $base_url, $api_user, $api_token, $api_method, $data = false, $assoc = false)
    {
        $curl = curl_init();
        $url = $base_url.'/'.$api_method;
        $qry_str = '';

        switch ($method) {
            case 'GET':
                if ($data) {
                    $url = $url.'?'.$qry_str = http_build_query($data);
                }
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf('%s?%s', $url, http_build_query($data));
                }
        }

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $api_user.':'.$api_token);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result, $assoc);
    }
}
