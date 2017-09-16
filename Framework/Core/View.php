<?php

namespace Core;

/**
 * The class represents methods to load and render normal full page and partial views (HTML+JS).
 * It implements simple MVC methodology to render full page and partial views.
 *
 * @version 1.0.1
 */
class View
{
    /**
     * Admin layout type constant.
     */
    const LAYOUT_ADMIN = 1;
    /**
     *  SignIn layout type  constant.
     */
    const LAYOUT_SIGNIN = 2;
    /**
     * Public layout type constant.
     */
    const LAYOUT_PUBLIC = 3;
    /**
     * Custom layout type constant.
     */
    const LAYOUT_CUSTOM = 4;
    /**
     * Profile layout type constant.
     */
    const LAYOUT_PROFILE = 5;

    const VIEW_PATH = 'views/default/';

    /**
     * Renders html body for for specific layout.
     *
     * @param string             $viewFile           Html body file name.
     * @param string             $viewModel          Data model.
     * @param ApplicationContext $applicationContext ApplicationContext instance.
     * @param int                $layout             Layout type.
     */
    public static function renderBody($viewFile, $viewModel = null, $applicationContext = null, $layout = self::LAYOUT_ADMIN)
    {
        $body = $viewFile;
        $model = $viewModel;
        $context = $applicationContext;

        switch ($layout) {
            case self::LAYOUT_ADMIN:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/_layout_admin.php';
                break;
            case self::LAYOUT_SIGNIN:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/_layout_public.php';
                break;
            case self::LAYOUT_PUBLIC:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/_layout_public.php';
                break;
            case self::LAYOUT_CUSTOM:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/_layout_custom.php';
                break;
            case self::LAYOUT_PROFILE:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/_layout_profile.php';
                break;

            deafult:
                require \Configuration\Config::path()->App.self::VIEW_PATH.'common/layout/layout_puyblic.php';
        }
    }

    /**
     * Renders html partial view.
     *
     * @param string             $viewFile           Partial view file name.
     * @param object             $viewModel          Data model.
     * @param ApplicationContext $applicationContext ApplicationContext instance.
     */
    public static function renderView($viewFile, $viewModel, $applicationContext = null)
    {
        $model = $viewModel;
        $context = $applicationContext;

        require \Configuration\Config::path()->App.self::VIEW_PATH.$viewFile;
    }

    /**
     * Renders html partial view to string.
     *
     * @param string             $viewFile           Partial view file name.
     * @param object             $viewModel          Data model.
     * @param ApplicationContext $applicationContext ApplicationContext instance.
     */
    public static function toString($viewFile, $viewModel = null, $applicationContext = null)
    {
        $model = $viewModel;
        $context = $applicationContext;

        // Render content to string
        ob_start();
        include \Configuration\Config::path()->App.self::VIEW_PATH.$viewFile;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Renders partial view to the json response.
     *
     * @param string             $viewFile           Partial view file name.
     * @param object             $viewModel          Data model.
     * @param array              $params             Additional parameters to render.
     * @param ApplicationContext $applicationContext ApplicationContext instance.
     */
    public static function toResponse($viewFile, $viewModel = null, $params = null, $applicationContext = null)
    {
        header('Content-Type: application/json');

        $content = self::toString($viewFile, $viewModel, $applicationContext);

        if (isset($params) && $params != null) {
            echo json_encode(array('Html' => $content) + $params, JSON_FORCE_OBJECT);
        } else {
            echo json_encode(array('Html' => $content), JSON_FORCE_OBJECT);
        }
    }

    /**
     * Renders array to json response.
     *
     * @param array $array Source array.
     */
    public static function jsonToResponse($array)
    {
        header('Content-Type: application/json');
        echo json_encode($array);
    }

    /**
     * Redirects to the specific url.
     *
     * @param string $url Redirect Url
     */
    public static function redirect($url)
    {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}
