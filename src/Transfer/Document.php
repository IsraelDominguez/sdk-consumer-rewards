<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

/**
 * Class Document
 *
 * To visualize the Lob
 * <img src='data:$mimeType;base64,$LOB' />
 *
 * @package ConsumerRewards\SDK\Transfer
 *
 */
class Document
{
    /**
     * @var $mimeType
     * @Type("string")
     */
    protected $mimeType;

    /**
     *
     * @var $lob
     * @Type("string")
     */
    protected $lob;

    /**
     * Document constructor.
     * @param $mimeType
     * @param $base64
     */
    public function __construct($mimeType, $base64)
    {
        $this->mimeType = $mimeType;
        $this->lob = $base64;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param mixed $mimeType
     * @return Document
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLob()
    {
        return $this->lob;
    }

    /**
     * @param mixed $lob
     * @return Document
     */
    public function setLob($lob)
    {
        $this->lob = $lob;
        return $this;
    }



}