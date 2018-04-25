<?php

namespace RestApiBundle\Serializer;

use RestApiBundle\Annotation\DeserializeEntity;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Annotations\AnnotationReader;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctrineEntityDeserializationSubscriber implements EventSubscriberInterface
{
	/**
	 * @var AnnotationReader
	 */
	private $annotationReader;
	/**
	 * @var Registry
	 */
	private $doctrineRegistry;


	public static function getSubscribedEvents()
	{
		return [
			[
				'event' => 'serializer.pre_deserialize',
				'method' => 'onPreDeserialize',
				'format' => 'json'
			],
			[
				'event' => 'serializer.post_deserialize',
				'method' => 'onPostDeserialize',
				'format' => 'json'
			]
		];
	}

	public function onPreDeserialize(PreDeserializeEvent $event)
	{
		dump($event->getType(), $event->getData());die;
	}

	public function onPostDeserialize(ObjectEvent $event)
	{
	}
}