<?php
/*
 * This file is part of the zhenggg/easy-ihuiyi.
 * (c) zhenggg <bianzhenggg@gmail.me>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Zhenggg\Huyi\Support;

/**
 * Class Config.
 */
class Config
{
    /**
     * @var array
     */
    protected static $config;

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $config = self::$config;

        if (is_null($key)) {
            return self::$config;
        }

        if (isset($config[$key])) {
            return $config[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($config) || !array_key_exists($segment, $config)) {
                return $default;
            }
            $config = $config[$segment];
        }

        return $config;
    }

    /**
     * Whether a offset exists.
     *
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     *              </p>
     *              <p>
     *              The return value will be casted to boolean if non-boolean was returned
     *
     */
    public static function exists($offset)
    {
        return array_key_exists($offset, self::$config);
    }

    /**
     * Offset to set.
     *
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     */
    public static  function set($offset, $value = '')
    {
        if (is_array($offset)) {
            foreach ($offset as $key => $segment) {
                self::$config[$key] = $segment;
            }
        } else {
            self::$config[$offset] = $value;
        }
    }

    /**
     * Offset to del.
     *
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     */
    public static function del($offset)
    {
        if (isset(self::$config[$offset])) {
            unset(self::$config[$offset]);
        }
    }
}