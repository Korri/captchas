<?php

namespace Korri\Captchas;

/**
 * Response returned by \Korri\Captchas\BaseCaptcha::checkAnswer
 * @package Korri\Captchas
 */
final class Response
{
    private $_isValid;
    private $_error;

    /**
     * Construct a new Response with a valid flag and error message.
     *
     * @param boolean $isValid represents if the response received was valid
     * @param string $error the error message if the response is not valid
     */
    public function __construct($isValid = false, $error = null)
    {
        $this->_isValid = $isValid;
        $this->_error = $error;
    }

    /**
     * Return if the request was valid.
     *
     * @return boolean
     */
    public function valid()
    {
        return $this->_isValid;
    }

    /**
     * Return the error message, if one is set.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_error;
    }
}
