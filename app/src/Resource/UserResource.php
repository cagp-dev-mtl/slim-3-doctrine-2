<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class UserResource extends AbstractResource
{
    /**
     * @param string|null $slug
     *
     * @return array
     */
    public function get($slug = null)
    {
        // Storm path logic goes here

        echo "Function get inside user resource";

        /*
        if ($slug === null) {
            $photos = $this->entityManager->getRepository('App\Entity\Photo')->findAll();
            $photos = array_map(
                function ($photo) {
                    return $photo->getArrayCopy();
                },
                $photos
            );

            return $photos;
        } else {
            $photo = $this->entityManager->getRepository('App\Entity\Photo')->findOneBy(
                array('slug' => $slug)
            );
            if ($photo) {
                return $photo->getArrayCopy();
            }
        }
        */

        return false;
    }
}
