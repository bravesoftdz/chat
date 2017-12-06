<?php

namespace Dykyi\Common;

use Dykyi\Entity\UserEntity;
use Exception;
use InvalidArgumentException;
use LengthException;

/**
 * Class SignUp
 */
class SignUp
{
    const PASSWORD_LENGTH = 6;
    const EMAIL_LENGTH    = 3;

    const EROR_EMAIL    = 'Email Error';
    const EROR_PASSWORD = 'Password Error';
    const EROR_CAPTCHA  = 'Captcha not found!';
    const ERROR_SPAMMER = "You are spammer ! Get the @$%K out";

    private $error;
    private $captcha;
    private $confirmPassword;

    protected $user = null;

    /**
     * SignUp constructor.
     * @throws \Exception
     * @param array $post
     */
    public function __construct($post)
    {
        foreach ($post as &$one) {
            $one = trim($one);
        }
        unset($one);

        $this->user            = new UserEntity($post);
        $this->captcha         = $post['g-recaptcha-response'];
        $this->confirmPassword = $post['confirm-password'];
    }

    /**
     * @param bool $use
     * @throws Exception
     * @return bool
     */
    private function validationCaptcha($use = true)
    {
        if (!$use) {
            return true;
        }

        $recaptcha = Config::get('recaptcha');
        if (!$this->captcha) {
            throw new InvalidArgumentException(self::EROR_CAPTCHA);
        }

        $secretKey = $recaptcha['secret'];
        $ip        = $_SERVER['REMOTE_ADDR'];
        $response  = file_get_contents($recaptcha['url'] . '?secret=' . $secretKey . '&response=' . $this->captcha . '&remoteip=' . $ip);
        $result    = json_decode($response, true);
        if ((int)$result['success'] !== 1) {
            throw new Exception(self::ERROR_SPAMMER);
        }
        return true;
    }

    /**
     * @throws Exception
     * @return bool
     */
    private function validationEmail()
    {
        if (!$result = strlen($this->user->getUserEmail()) >= self::EMAIL_LENGTH) {
            throw new LengthException(self::EROR_EMAIL);
        }
        return $result;
    }

    /**
     * @throws Exception
     * @return bool
     */
    private function passwordValidate()
    {
        $result = (strlen($this->user->getPassword()) >= self::PASSWORD_LENGTH) &&
            ($this->user->getPassword() === $this->confirmPassword);

        if (!$result) {
            throw new LengthException(self::EROR_PASSWORD);
        }
        return $result;
    }

    /**
     * @param bool $validationCaptcha
     * @return bool
     * @throws Exception
     */
    public function validation($validationCaptcha = true)
    {
        try {
            $this->validationCaptcha($validationCaptcha);
            $this->validationEmail();
            $this->passwordValidate();
            $this->error = '';

            return true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            throw $e;
        }
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

}