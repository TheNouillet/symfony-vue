<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction("json_encode", array($this, "jsonEncode")),
            new \Twig_SimpleFunction("serializeEntities", array($this, "serializeEntities")),
            new \Twig_SimpleFunction("serializeEntity", array($this, "serializeEntity"))
        );
    }

    public function jsonEncode($data)
    {
        return json_encode($data);
    }

    public function serializeEntities($entities)
    {
        return \array_map(function($entity){
            return $entity->serialize();
        }, $entities);
    }

    public function serializeEntity($entity)
    {
        return $entity->serialize();
    }
}