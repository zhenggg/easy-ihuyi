<?php
/*
 * This file is part of the zhenggg/easy-ihuiyi.
 * (c) zhenggg <bianzhenggg@gmail.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhenggg\Huyi\Gateways;

use Zhenggg\Huyi\Support\Config;
use Zhenggg\Huyi\HasHttpRequest;
class MmsGateway extends Gateway
{
    use HasHttpRequest;

    const ENDPOINT_URL = 'http://10658.cc/webservice/api?method=SendMms';
    const ENDPOINT_FORMAT = 'json';

    /**
     * @var array
     */
    protected $params = ['mmsid' => '', 'pid'=>''];

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
            'mmsid' => $this->params['mmsid'],
            'time' => time(),
            'pid' => 'pid',
            'format' => self::ENDPOINT_FORMAT
        ];
        $params['password'] = Config::get('APIKEY');
        return $this->post(self::ENDPOINT_URL, $params);
    }
}