<?php

namespace Driver\third;


/**
 * Class Extra
 * @package Driver\third
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/11 14:33
 * 网络、论坛、demo 收集到的方法类库
 * 感谢开源支持
 */

class Tool {
    /**
     * 根据文件后缀获取文件MINE
     * @param array $ext 文件后缀
     * @param array $mine 文件后缀MINE信息
     * @return string
     * @throws //LocalCacheException
     */
    public static function getExtMine($ext, $mine = [])
    {
        $mines = self::getMines();
        foreach (is_string($ext) ? explode(',', $ext) : $ext as $e) {
            $mine[] = isset($mines[strtolower($e)]) ? $mines[strtolower($e)] : 'application/octet-stream';
        }
        return join(',', array_unique($mine));
    }
    /**
     * 获取所有文件扩展的mine
     * @return array
     * @throws //LocalCacheException
     */
    private static function getMines()
    {
        $content = file_get_contents('http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');
        preg_match_all('#^([^\s]{2,}?)\s+(.+?)$#ism', $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) foreach (explode(" ", $match[2]) as $ext) {
            $mines[$ext] = $match[1];
        }
    }
    /**
     * 创建CURL文件对象
     * @param $filename
     * @param string $mimetype
     * @param string $postname
     * @return \CURLFile|string
     * @throws //LocalCacheException
     */
    public static function createCurlFile($filename, $mimetype = null, $postname = null)
    {
        is_null($postname) && $postname = basename($filename);
        is_null($mimetype) && $mimetype = self::getExtMine(pathinfo($filename, 4));
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $mimetype, $postname);
        }
        return "@{$filename};filename={$postname};type={$mimetype}";
    }
    /**
     * 随机字符串
     * @param int $length 指定字符长度
     * @param string $str 字符串前缀
     * @return string
     */
    public static function createNoncestr($length = 32, $str = "")
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 数组转XML内容
     * @param array $data
     * @return string
     */
    public static function arr2xml($data)
    {
        return "<xml>" . self::_arr2xml($data) . "</xml>";
    }

    /**
     * XML内容生成
     * @param array $data 数据
     * @param string $content
     * @return string
     */
    private static function _arr2xml($data, $content = '')
    {
        foreach ($data as $key => $val) {
            is_numeric($key) && $key = 'item';
            $content .= "<{$key}>";
            if (is_array($val) || is_object($val)) {
                $content .= self::_arr2xml($val);
            } elseif (is_string($val)) {
                $content .= '<![CDATA[' . preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/", '', $val) . ']]>';
            } else {
                $content .= $val;
            }
            $content .= "</{$key}>";
        }
        return $content;
    }

    /**
     * 解析XML内容到数组
     * @param string $xml
     * @return array
     */
    public static function xml2arr($xml)
    {
        $entity = libxml_disable_entity_loader(true);
        $data = (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        libxml_disable_entity_loader($entity);
        return json_decode(self::arr2json($data), true);
    }

    /**
     * 数组转xml内容
     * @param array $data
     * @return null|string|string
     */
    public static function arr2json($data)
    {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function ($matches) {
            return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");
        }, ($jsonData = json_encode($data)) == '[]' ? '{}' : $jsonData);
    }

    /**
     * 解析JSON内容到数组
     * @param string $json
     * @return array
     * @throws \Exception
     */
    public static function json2arr($json)
    {
        $result = json_decode($json, true);
        if (empty($result)) {
            throw new \Exception('invalid response.', '0');
        }
        if (!empty($result['errcode'])) {
            $result['errmessage']=\Driver\core\Error::toMessage($result['errcode']);
        }
        return $result;
    }


}