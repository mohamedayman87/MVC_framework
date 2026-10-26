<?php
namespace Moayman\Mvc\View;
class view
{
    public static function make($view, $params = [])
    {
        $basecontent = self::getBaseContent();
        $viewcontent = self::getViewContent($view, params: $params);

        echo str_replace("{{content}}", $viewcontent, $basecontent);
    }

    public static function makeError($error)
    {
        self::getViewContent($error, true);
    }

    protected static function getBaseContent()
    {
        ob_start();
        include base_path() . '\\Views\\layouts\\main.php';
        return ob_get_clean();
    }

    protected static function getViewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? view_path() . DIRECTORY_SEPARATOR . 'errors' : view_path();

        // "auth.register" -> "auth\register"
        $relative = str_replace('.', DIRECTORY_SEPARATOR, $view);

        $file = rtrim($path, '\\/') . DIRECTORY_SEPARATOR . $relative . '.php';

        extract($params);

        if ($isError) {
            include $file;
        } else {
            ob_start();
            include $file;
            return ob_get_clean();
        }

    }
}

