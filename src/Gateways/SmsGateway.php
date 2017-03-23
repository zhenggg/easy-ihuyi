<?php
/*
 * This file is part of the overtrue/easy-sms.
 * (c) overtrue <i@overtrue.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhenggg\Huyi\Gateways;

use Zhenggg\Huyi\Support\Config;
use Zhenggg\Huyi\HasHttpRequest;

class SmsGateway extends Gateway
{

    use HasHttpRequest;

    const ENDPOINT_URL = 'http://106.ihuyi.com/webservice/sms.php?method=Submit';
    const ENDPOINT_FORMAT = 'json';
    /**
     * Send a short message.
     *
     * @param string|int $to
     *
     * @return mixed
     */
    public function send($to)
    {
        $this->checkParams();
        $params = [
            'account' => Config::get('APIID'),
            'mobile' => strval($to),
            'content' => $this->params['content'],
            'time' => time(),
            'format' => self::ENDPOINT_FORMAT
        ];
        $params['password'] = $this->generateSign($params);
        return $this->post(self::ENDPOINT_URL, $params);
    }
}