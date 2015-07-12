<?php namespace Korri\Captchas;

interface CaptchaInterface
{
    /**
     * Get the captcha's HTMl code wich should be embedded inside your form.
     * @return string The HTML to be embedded in the user's form.
     */
    function getHtml();

    /**
     * Check the captcha and returns a valid or invalid response
     *
     * @param $data array An array containing the required validation fields, usually $_POST
     * @return \Korri\Captchas\Response
     */
    function checkAnswer($data);
}
