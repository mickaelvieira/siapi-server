<?php

namespace Siapi\IndexerBundle\Entity;

class Hydrator
{
    /**
     * @param $entity
     * @param array $data
     * @return mixed
     */
    public static function populate($entity, array $data)
    {
        foreach ($data as $key => $value) {
            $setter = "set" . self::underscoreToCamelCase($key);
            if (method_exists($entity, $setter)) {
                $entity->$setter($value);
            }
        }
        return $entity;
    }

    /**
     * @param string $key
     * @return string
     */
    public static function underscoreToCamelCase($key)
    {
        $parts = preg_split("/_/", strtolower($key));
        $parts = array_map("ucfirst", $parts);
        return implode("", $parts);
    }
} 