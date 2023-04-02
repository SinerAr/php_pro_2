<?php

namespace Sinerar\PhpPro\shorturl;

use Sinerar\PhpPro\shorturl\Interfaces\IUrlEncoder;

class ShortCode implements IUrlEncoder
{
//    private string $db_filename = 'my_short_codes.db';
    protected string $shortCode;
    public function __construct(protected Url $url)
    {
        $this->shortCode = $this->encode($url->getUrl());
    }

    public function encode(string $url): string
    {
        return mb_substr(hash('md5', $url), 0, 10);
    }

    public function saveToFile($db_filename)
    {
        $existingCodestxt = file_get_contents($db_filename);
        if (!str_contains($existingCodestxt, $this->url->getUrl()))
            file_put_contents($db_filename, $this->shortCode.' '.$this->url->getUrl().PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}