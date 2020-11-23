<?php

namespace MyOrm;

use Nextras\Orm\Repository\Repository;

use Nextras\Orm\Entity\Entity;

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

    public function add($data, Entity $mesto)
    {
        $school = new School();
        $school->nazev = $data["nazev"];
        $school->mesto = $mesto;
        $school->glat = $data["glat"];
        $school->glong = $data["glong"];
        $this->persistAndFlush($school);
    }
}
