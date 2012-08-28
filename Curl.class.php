<?php

/**
 * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
 *
 */
namespace kaLibrary;
class Curl
{
    protected $options = array(CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false, CURLOPT_FAILONERROR => false,
            CURLOPT_FRESH_CONNECT => true, CURLOPT_TIMEOUT => 86400,
            CURLOPT_CONNECTTIMEOUT => 10, CURLOPT_FOLLOWLOCATION => true,
            CURLINFO_HEADER_OUT => true);

    private $curlInfo = null;

    /**
     * 
     * @param unknown_type $url
     * @param unknown_type $data
     * @return mixed
     */
    public function get($url, $data = null)
    {
        $this->setOption(CURLOPT_HTTPGET, true);

        return $this->request($url, $data);
    }

    /**
     * 
     * @param unknown_type $url
     * @param unknown_type $data
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
     * 
     * @param unknown_type $url
     * @param unknown_type $data
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
     * 
     * @param unknown_type $url
     * @param unknown_type $data
     * @return Ambigous <\kaLibrary\mixed, mixed>
     */
    public function delete($url, $data = null)
    {
        $this->setOption(CURLOPT_CUSTOMREQUEST, "DELETE");

        return $this->request($url, $data);
    }

    /**
     * 
     * @param unknown_type $option
     * @param unknown_type $value
     */
    public function setOption($option, $value)
    {
        $this->setOptions(array($option => $value));
    }

    /**
     * 
     * @param array $options
     */
    public function setOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->options[$option] = $value;
        }
    }

    /**
     * 
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
     * 
     * @param unknown_type $url
     * @param unknown_type $data
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
        } else {
            $this->curlInfo = curl_getinfo($ch);
            curl_close($ch);
            return $result;
        }
    }

}
