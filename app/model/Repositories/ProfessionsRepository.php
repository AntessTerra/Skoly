<?php

namespace MyOrm;

use Nextras\Orm\Repository\Repository;


/**
 * @method Profession|NULL getById($id)
 */
class ProfessionsRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [Profession::class];
    }

    /**
     * @return ICollection|Profession[]
     */
    public function findProfessions()
    {
        return $this->findAll();
    }
}
