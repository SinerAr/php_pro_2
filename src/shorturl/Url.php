<?php

namespace Sinerar\PhpPro\shorturl;

class Url
{
    public function __construct(protected string $url)
    {
        $this->validateUrl($url);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


    protected function validateUrl($url):bool
    {
        if (!((bool)filter_var($url, FILTER_VALIDATE_URL) && $this->checkServerResponse200($url)))
            throw new \InvalidArgumentException('URL "'.$url.'" is not valid');
        return true;
    }

    protected function checkServerResponse200($url):bool
    {
        return str_contains(get_headers($url)[0],'200');
    }
}