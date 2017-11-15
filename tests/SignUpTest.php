<?php

use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{

    /**
     * @dataProvider providerValidationException
     *
     * @param array $post
     * @param string $exceptionMessage
     */
    public function testValidationException($post, $exceptionMessage)
    {
        $this->expectExceptionMessage($exceptionMessage);
        $signUp = new \Dykyi\Common\SignUp($post);
        $signUp->validation(false);
    }

    /**
     * @return array
     */
    public function providerValidationException()
    {
        return [
            'VALIDATION EMAIL' => [
                [
                    'name'                 => 'test',
                    'email'                => 'te',
                    'password'             => 'password',
                    'confirm-password'     => 'password',
                    'g-recaptcha-response' => null,
                ],
                \Dykyi\Common\SignUp::EROR_EMAIL,
            ],
            'VALIDATION PASSWORD' => [
                [
                    'name'                 => 'test',
                    'email'                => 'test@gmail.com',
                    'password'             => 'password',
                    'confirm-password'     => 'asfasfsg',
                    'g-recaptcha-response' => null,
                ],
                \Dykyi\Common\SignUp::EROR_PASSWORD,
            ],
            'VALIDATION EMPTY DATA' => [
                [
                    //...
                ],
                \Dykyi\Common\UserEntity::ERROR_1,
            ],
        ];
    }

    public function testValidationSuccess()
    {
        $post   = [
            'name'                 => 'test',
            'email'                => 'test@gmail.com',
            'password'             => 'password',
            'confirm-password'     => 'password',
            'g-recaptcha-response' => null,
        ];
        $signUp = new \Dykyi\Common\SignUp($post);
        $this->assertTrue($signUp->validation(false));
    }

}
