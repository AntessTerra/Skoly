<?php

namespace MyOrm;

use Nextras\Orm\Repository\Repository;


/**
 * @method School|NULL getById($id)
 */
class SchoolsRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [School::class];
    }

    /**
     * @return ICollection|School[]
     */
    public function findSchools()
    {
        return $this->findAll();
    }
}
