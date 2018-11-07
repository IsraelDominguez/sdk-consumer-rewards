<?php namespace ConsumerRewards\SDK\Tools;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

class LinksHateoasEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => Events::PRE_DESERIALIZE,
                'method' => 'onPreDesarialize',
                'class' => 'ConsumerRewards\\SDK\\Transfer\\Qr', // if no class, subscribe to every serialization
                'format' => 'json',
            ),
        );
    }
    public function onPreDesarialize(PreDeserializeEvent $event) {
        $data = $event->getData();

        if (isset($data['_links'])) {
            $data = $this->extractLinks($data, $event->getType()['name']);
        }
        if (isset($data['_embedded'])) {
            $data = $this->extractEmbedded($data);
        }
        $event->setData($data);
    }

    /**
     * @var array $data
     * @var string $className Full qualified class name of target
     * @return array
     */
    private function extractLinks(array $data, $className) {

        foreach ($data['_links'] as $key => $value) {

            if ($key == 'pack') {
                var_dump($value);
                //$packsApi = Container::get('packsApi')->findById();

                //var_dump($value);
//                $id = $value['href'];
//                if (!is_null($this->router) && isset($routeMap[$key])) {
//                    $id = $this->router->match($id, $routeMap[$key]);
//                    $id = $id['id'];
//                }
//                $data[$key]['id'] = $id;
//                $data[$key]['__partialDeserialized'] = true;
            }
            unset($data['_links'][$key]);
        }
die;
        return $data;
    }

    /**
     * @var string $className Full qualified class name of target
     * @return array
     */
    private function buildRouteMap($className) {

//        $meta = $this->metadataFactory->getMetadataForClass($className);
//        $relations = $meta->getRelations();
//        $routeMap = [];
//        foreach ($relations as $relation) {
//            if ($relation->getName() != 'self' && $relation->getHref() instanceof Route) {
//                $routeMap[$relation->getName()] = $relation->getHref()->getName();
//            }
//        }
//        return $routeMap;
    }

    /**
     * @param array $data
     * @return array
     */
    private function extractEmbedded(array $data) {
        foreach ($data['_embedded'] as $key => $value) {
            $data[$key] = $value;
            unset($data['_embedded'][$key]);
        }
        return $data;
    }
}