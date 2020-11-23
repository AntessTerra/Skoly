<?php

namespace MyOrm;

use Nextras\Orm\Repository\Repository;

use Nextras\Orm\Entity\Entity;


/**
 * @method Accept|NULL getById($id)
 */
class AcceptsRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [Accept::class];
    }

    /**
     * @return ICollection|Accept[]
     */
    public function findAccepts()
    {
        return $this->findAll();
    }

    public function add($data, Entity $skola, Entity $obor)
    {
        $accept = new Accept();
        $accept->obor = $obor;
        $accept->skola = $skola;
        $accept->pocet = $data["pocet"];
        $accept->rok = $data["rok"];
        $this->persistAndFlush($accept);
    }
}
