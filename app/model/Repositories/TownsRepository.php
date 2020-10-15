<?php

namespace MyOrm;

use Nextras\Orm\Repository\Repository;


/**
 * @method Town|NULL getById($id)
 */
class TownsRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [Town::class];
    }

    /**
     * @return ICollection|Town[]
     */
    public function findTowns()
    {
        return $this->findAll();
    }
}
