<?php

/**
 * This file contains only the class Curl.
 */

namespace kaLibrary;

/**
 * This class allows you to handle calls curl
 * 
 * @author Kévin ARBOUIN <lesmyrmidons@gmail.com>
 * 
 * @example
 * <?php
 * $curl = new Curl();
 * var_dump($curl->get($url, $data));
 *
 * @since 1.0
 * 
 * @license For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Curl
{
    /**
     * Table of the parameters of the curl.
     * @var array
     */
    protected $options = array(CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false, CURLOPT_FAILONERROR => false,
            CURLOPT_FRESH_CONNECT => true, CURLOPT_TIMEOUT => 86400,
            CURLOPT_CONNECTTIMEOUT => 10, CURLOPT_FOLLOWLOCATION => true,
            CURLINFO_HEADER_OUT => true);

    /**
     * The result of the response of the call after the curl_getinfo().
     * @var array $curlInfo
     */
    private $curlInfo = array();

    /**
     * GET method
     * @param string $url
     * @param array|string|null $data
     * @return mixed
     */
    public function get($url, $data = null)
    {
        $this->setOption(CURLOPT_HTTPGET, true);

        return $this->request($url, $data);
    }

    /**
     * POST method
     * @param string $url
     * @param array|string|null $data
     * @return mixed
     */
    public function post($url, $data = null)
    {
        $this->setOptions(array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data
        ));

        return $this->request($url, $data);
    }

    /**
     * PUT method
     * @param string $url
     * @param array|string|null $data
     * @return mixed
     */
    public function put($url, $data = null)
    {
        $this->setOptions(array(
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $data
        ));

        return $this->request($url, $data);
    }

    /**
     * DELETE method
     * @param string $url
     * @param array|string|null $data
     * @return mixed
     */
    public function delete($url, $data = null)
    {
        $this->setOption(CURLOPT_CUSTOMREQUEST, "DELETE");

        return $this->request($url, $data);
    }

    /**
     * Set a parameter of the call Curl.
     * @param integer $option
     * @param boolean|string|array $value
     */
    public function setOption($option, $value)
    {
        $this->setOptions(array($option => $value));
    }

    /**
     * Set the parameters of the call Curl.
     * @param array $options
     */
    public function setOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->options[$option] = $value;
        }
    }

    /**
     * The response of the call after the curl_getinfo()
     * @param  integer $opt 
     * @return boolean|string|array
     */
    public function getInfo($opt = null)
    {
        if ($opt) {
            return isset($this->curlInfo[$opt]) ? $this->curlInfo[$opt] : false;
        }
        
        return empty($this->curlInfo) ? false : $this->curlInfo;
    }

    /**
     * Initiating and executing method calls curl.
     * @param string $url
     * @param array|string|null $data
     * @throws Exception
     * @return mixed
     */
    protected function request($url, $data)
    {
        $ch = curl_init();
        $this->setOption(CURLOPT_URL, $url);
        $this->options[CURLOPT_RETURNTRANSFER] = true;
        curl_setopt_array($ch, $this->options);

        if (!$result = curl_exec($ch)) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
        $this->curlInfo = curl_getinfo($ch);
        curl_close($ch);
        
        return $result;
    }

}
