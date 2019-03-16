<?php
namespace Driver\core;


/**
 * Rsa加密
 * Class RsaService
 * @package Driver\core
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/16 8:41
 *
 */
class Rsa
{
    public static  $PRIVATE_KEY;
    public static  $PUBLIC_KEY ;
    public $data;

    public function __construct($config)
    {
        self::$PRIVATE_KEY=$config['rsa_private_key'];
        self::$PUBLIC_KEY=$config['rsa_public_key'];
    }

    /**
     *返回对应的私钥
     */
    private function getPrivateKey()
    {
        $privateKey = self::$PRIVATE_KEY;
        return openssl_pkey_get_private($privateKey);
    }

    /**
     *返回对应的公钥
     */
    private function getPublicKey()
    {
        $publicKey = self::$PUBLIC_KEY;
        return openssl_pkey_get_public($publicKey);
    }
    /**
     * @param $decrypted
     * @return null
     * 公钥加密
     */
    private function publicEncrypt($decrypted)
    {
        if (!is_string($decrypted)) {
            return null;
        }
        return (openssl_public_encrypt($decrypted, $encrypted, self::getPublicKey())) ? $encrypted : null;


    }
    /**
     * 私钥解密
     * @param $encrypted //解密字符
     * @return null
     */
    private function privDecryptNB64($encrypted)
    {
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_private_decrypt($encrypted, $decrypted, self::getPrivateKey())) ? $decrypted : null;
    }

    /**
     * @param string $decrypted
     * @return $this
     * 分段公钥加密
     */
    public function partPubEncrypt($decrypted='')
    {
        if(empty($decrypted)) $decrypted=$this->data;
        $dataArray = str_split($decrypted, 117);
        $bContent = '';
        foreach ($dataArray as $key => $subData) {
            $bContent .= self::publicEncrypt($subData);
        }
        $this->data=base64_encode($bContent);

        return $this;
    }
    /**
     * 分段私钥解密
     * @param string $encrypted
     * @return //Ambigous <string, NULL, Ambigous>
     */
    public function partPrivDecrypt($encrypted='')
    {
        if(empty($encrypted)) $encrypted=$this->data;
        $encrypted = base64_decode($encrypted);
        $dataArray = str_split($encrypted, 128);
        $bContent = '';
        foreach ($dataArray as $key => $subData) {
            $bContent .= self::privDecryptNB64($subData);
        }
        $this->data=$bContent;
        return $this;
    }

    /**
     * @return mixed
     * 数据输出
     */
    public function toEcho(){
        return $this->data;
    }
}
