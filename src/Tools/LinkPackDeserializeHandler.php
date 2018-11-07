<?php namespace ConsumerRewards\SDK\Tools;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;

class LinkPackDeserializeHandler implements SubscribingHandlerInterface
{

    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'ConsumerRewards\SDK\Transfer\Pack',
                'method' => 'deserializeDateTimeToJson',
            ],
        ];
    }

    public function deserializeDateTimeToJson(JsonDeserializationVisitor $visitor, $data, array $type, Context $context)
    {
        var_dump($visitor->getNavigator());
        die;
    }
}