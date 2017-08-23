<?php

namespace Dykyi\Common;

/**
 * Class SignUp
 */
class SignUp
{
    const PASSWORD_LENGTH = 6;
    const EMAIL_LENGTH    = 3;

    private $error;
    private $captcha;
    private $confirmPassword;

    protected $user = null;

    /**
     * SignUp constructor.
     * @param $post
     */
    public function __construct($post)
    {
        foreach ($post as &$one) {
            $one = trim($one);
        }

        $this->user            = new User($post);
        $this->captcha         = $post['g-recaptcha-response'];
        $this->confirmPassword = $post['confirm-password'];
    }

    /**
     * @return bool
     */
    private function validationCapcha()
    {
        $recaptcha = Config::get('recaptcha');
        if (!$this->captcha) {
            $this->error = 'Captcha not found!';
            return false;
        }
        else {
            $secretKey = $recaptcha['secret'];
            $ip        = $_SERVER['REMOTE_ADDR'];
            $response  = file_get_contents($recaptcha['url'] . '?secret=' . $secretKey . '&response=' . $this->captcha . '&remoteip=' . $ip);
            $result    = json_decode($response, true);
            if (intval($result['success']) !== 1) {
                $this->error = "You are spammer ! Get the @$%K out";
                return false;
            }
            else {
                $this->error = '';
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function validationEmail()
    {
        if (!$result = strlen($this->user->getUserEmail()) >= self::EMAIL_LENGTH) {
            $this->error = 'Email Error';
        }
        return $result;
    }

    /**
     * @return bool
     */
    private function passwordValidate()
    {
        $result = (strlen($this->user->getPassword()) >= self::PASSWORD_LENGTH) &&
            ($this->user->getPassword() === $this->confirmPassword);

        if (!$result) {
            $this->error = 'Password Error';
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function validation()
    {
        return
            $this->validationCapcha() &&
            $this->validationEmail() &&
            $this->passwordValidate();
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

}