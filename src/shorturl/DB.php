<?php

namespace Sinerar\PhpPro\shorturl;

use Sinerar\PhpPro\shorturl\Interfaces\IUrlDecoder;

class DB implements IUrlDecoder
{

    public function __construct(protected string $db_filename)
    {
        $this->validateDB($this->db_filename);
    }

    protected function validateDB($db_filename){
        if (!file_exists($db_filename))
            throw new \Error('DB not found');
    }

    public function decode(string $code): string
    {
        if (strlen($code)!=10)
            throw new \InvalidArgumentException('Code must contain 10 symbols');
        $url_code='';
        $existingCodes = file($this->db_filename);
        foreach ($existingCodes as $existingCode)
            if(str_contains($existingCode, $code))
                $url_code = explode(' ', $existingCode);
        if (!$url_code)
            throw new \Exception('Code "'.$code.'" not found');
        return $url_code[1];
    }
}