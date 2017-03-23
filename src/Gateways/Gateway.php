<?php
/*
 * This file is part of the zhenggg/easy-ihuiyi.
 * (c) zhenggg <bianzhenggg@gmail.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Zhenggg\Huyi\Gateways;


use Zhenggg\Huyi\Contracts\GatewayInterface;
use Zhenggg\Huyi\Support\Config;

/**
 * Class Gateway
 */
abstract class Gateway implements GatewayInterface
{
    const DEFAULT_TIMEOUT = 5.0;
    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var array
     */
    protected $params = ['content' => ''];

    /**
     * @var float
     */
    protected $timeout;

    /**
     * Generate Sign.
     *
     * @param array $params
     *
     * @return string
     */
    public function generateSign($params)
    {
        return md5($params['account'] . Config::get('APIKEY') . $params['mobile'] . $params['content'] . $params['time']);
    }



    public function __call($method, $param)
    {
        if (isset($param) && array_key_exists($method,$this->params))
            $this->params[$method] = implode('.',$param);

        return $this;
    }


    public function checkParams()
    {
        foreach ($this->params as $key => $param)
            if (!$param) throw new \InvalidArgumentException(sprintf('缺少 "%s" 参数.',$key));
    }

    /**
     * Return base uri.
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Return timeout.
     *
     * @return int|mixed
     */
    public function getTimeout()
    {
        return $this->timeout ?: Config::get('timeout', self::DEFAULT_TIMEOUT);
    }

    /**
     * Set timeout.
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function timeout($timeout)
    {
        $this->timeout = floatval($timeout);

        return $this;
    }
}