<?php
/*
 * This file is part of the zhenggg/easy-ihuiyi.
 * (c) zhenggg <bianzhenggg@gmail.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Zhenggg\Huyi\Gateways;

use Zhenggg\Huyi\Support\Config;
/**
 * Class ErrorLogGateway.
 */
class ErrorLogGateway extends Gateway
{
    /**
     * Send a short message.
     *
     * @param string|int $to
     *
     * @return mixed
     */
    public function send($to)
    {
        $this->params['content'] = sprintf(
            "[%s] to: %s, message: \"%s\", data: %s\n",
            date('Y-m-d H:i:s'),
            $to,
            addcslashes($this->params['content'], '"'),
            json_encode($this->params)
        );
        return error_log($this->params['content'], 3, Config::get('file', ini_get('error_log')));
    }
}