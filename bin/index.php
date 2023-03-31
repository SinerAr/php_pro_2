<?php

function mail2(string $to, string $subject, string $message){
    echo "=== Sending mail ===";
    return true;
}
class Email{
    public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->validateEmail();
    }

    public function validateEmail():void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException('Email "'. $this->email. '" is invalid');
        }
    }
}

try {
    $objEmail = new Email('example@gmail.com');
    mail2($objEmail->email, 'Subject', 'Msg');
} catch (\Exception $e){
    //log to file
    //send msg to tgbot
    echo $e->getMessage();
}








echo PHP_EOL;
echo '------ Program end -------';
echo PHP_EOL;