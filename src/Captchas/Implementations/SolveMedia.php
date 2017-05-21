<?php namespace Korri\Captchas;

use DominionEnterprises\SolveMedia\Service;
use Guzzle\Http\Client;

class SolveMedia implements CaptchaInterface
{
    private $service;
    private $canAnswer;
    private $secure;

    public function __construct($c_key, $v_key = '', $h_key = '', $secure = true)
    {
        $this->canAnswer = !empty($v_key);
        $this->service = new Service(new Client(), $c_key, $v_key, $h_key);
        $this->secure = $secure;
    }

    function getHtml()
    {
        return $this->service->getHtml(null, $this->secure);
    }

    /**
     * @param array $data Must contain adcopy_challenge and adcopy_response
     * @param null $ip
     * @return Response
     * @throws \Exception
     */
    function checkAnswer($data, $ip = null)
    {
        if (!$this->canAnswer) {
            throw new \Exception('You must specify the private key in order to user checkAnswer');
        }
        if (!isset($data['adcopy_challenge']) || !isset($data['adcopy_response'])) {
            return new Response(false, 'No challenge or adcopy field');
        }
        $ip = $ip ?: $_SERVER['REMOTE_ADDR'];
        $response = $this->service->checkAnswer($ip, $data['adcopy_challenge'], $data['adcopy_response']);

        return new Response($response->valid(), $response->getMessage());
    }

}
