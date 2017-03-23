<?php
/*
 * This file is part of the zhenggg/easy-ihuiyi.
 * (c) zhenggg <bianzhenggg@gmail.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Zhenggg\Huyi\Contracts;

interface GatewayInterface
{
    /**
     * Send a short message.
     *
     * @param string|int $to
     *
     * @return mixed
     */
    public function send($to);

    /**
     * Send a short message.
     *
     * @param array      $params
     *
     * @return string
     */
    public function generateSign($params);


}