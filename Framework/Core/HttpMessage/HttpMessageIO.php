<?php

namespace Framework\Core\HttpMessage;

use Framework\Core\HttpMessage;

use Psr\Http\Message\ResponseInterface;

class HttpMessageIO
{    
    /**
     * Return a ServerRequest populated with superglobals:
     * $_GET
     * $_POST
     * $_COOKIE
     * $_FILES
     * $_SERVER
     *
     * @return ServerRequestInterface
     */
    public static function getfromGlobals()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $uri = self::getUriFromGlobals();
        $body = new LazyOpenStream('php://input', 'r+');
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? str_replace('HTTP/', '', $_SERVER['SERVER_PROTOCOL']) : '1.1';
        $serverRequest = new ServerRequest($method, $uri, $headers, $body, $protocol, $_SERVER);
        return $serverRequest
            ->withCookieParams($_COOKIE)
            ->withQueryParams($_GET)
            ->withParsedBody($_POST)
            ->withUploadedFiles(self::normalizeFiles($_FILES));
    }

	/**
     * Return an UploadedFile instance array.
     *
     * @param array $files A array which respect $_FILES structure
     * @throws InvalidArgumentException for unrecognized values
     * @return array
     */
    public static function normalizeFiles(array $files)
    {
        $normalized = [];
        foreach ($files as $key => $value) {
            if ($value instanceof UploadedFileInterface) {
                $normalized[$key] = $value;
            } elseif (is_array($value) && isset($value['tmp_name'])) {
                $normalized[$key] = self::createUploadedFileFromSpec($value);
            } elseif (is_array($value)) {
                $normalized[$key] = self::normalizeFiles($value);
                continue;
            } else {
                throw new InvalidArgumentException('Invalid value in files specification');
            }
        }
        return $normalized;
    }
    /**
     * Create and return an UploadedFile instance from a $_FILES specification.
     *
     * If the specification represents an array of values, this method will
     * delegate to normalizeNestedFileSpec() and return that return value.
     *
     * @param array $value $_FILES struct
     * @return array|UploadedFileInterface
     */
    private static function createUploadedFileFromSpec(array $value)
    {
        if (is_array($value['tmp_name'])) {
            return self::normalizeNestedFileSpec($value);
        }
        return new UploadedFile(
            $value['tmp_name'],
            (int) $value['size'],
            (int) $value['error'],
            $value['name'],
            $value['type']
        );
    }
    /**
     * Normalize an array of file specifications.
     *
     * Loops through all nested files and returns a normalized array of
     * UploadedFileInterface instances.
     *
     * @param array $files
     * @return UploadedFileInterface[]
     */
    private static function normalizeNestedFileSpec(array $files = [])
    {
        $normalizedFiles = [];
        foreach (array_keys($files['tmp_name']) as $key) {
            $spec = [
                'tmp_name' => $files['tmp_name'][$key],
                'size'     => $files['size'][$key],
                'error'    => $files['error'][$key],
                'name'     => $files['name'][$key],
                'type'     => $files['type'][$key],
            ];
            $normalizedFiles[$key] = self::createUploadedFileFromSpec($spec);
        }
        return $normalizedFiles;
    }

    /**
     * Get a Uri populated with values from $_SERVER.
     *
     * @return UriInterface
     */
    public static function getUriFromGlobals() {
        $uri = new Uri('');
        $uri = $uri->withScheme(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');
        $hasPort = false;

        if (isset($_SERVER['HTTP_HOST'])) {
            $hostHeaderParts = explode(':', $_SERVER['HTTP_HOST']);
            $uri = $uri->withHost($hostHeaderParts[0]);
            if (isset($hostHeaderParts[1])) {
                $hasPort = true;
                $uri = $uri->withPort($hostHeaderParts[1]);
            }
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $uri = $uri->withHost($_SERVER['SERVER_NAME']);
        } elseif (isset($_SERVER['SERVER_ADDR'])) {
            $uri = $uri->withHost($_SERVER['SERVER_ADDR']);
        }

        if (!$hasPort && isset($_SERVER['SERVER_PORT'])) {
            $uri = $uri->withPort($_SERVER['SERVER_PORT']);
        }

        $hasQuery = false;
        if (isset($_SERVER['REQUEST_URI'])) {
            $requestUriParts = explode('?', $_SERVER['REQUEST_URI']);
            $uri = $uri->withPath($requestUriParts[0]);
            if (isset($requestUriParts[1])) {
                $hasQuery = true;
                $uri = $uri->withQuery($requestUriParts[1]);
            }
        }

        if (!$hasQuery && isset($_SERVER['QUERY_STRING'])) {
            $uri = $uri->withQuery($_SERVER['QUERY_STRING']);
        }
        return $uri;
    }

    /**
	 * Send an HTTP response
	 *
	 * @return void
	 */
	public static function send(ResponseInterface $response)
	{
		$http_line = sprintf('HTTP/%s %s %s',
			$response->getProtocolVersion(),
			$response->getStatusCode(),
			$response->getReasonPhrase()
		);

		header($http_line, true, $response->getStatusCode());

		foreach ($response->getHeaders() as $name => $values) {
			foreach ($values as $value) {
				header("$name: $value", false);
			}
		}

		$stream = $response->getBody();

		if ($stream->isSeekable()) {
			$stream->rewind();
		}

		while (!$stream->eof()) {
			echo $stream->read(1024 * 8);
		}
    }
}
