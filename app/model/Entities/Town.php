<?php

namespace MyOrm;


use Nextras\Orm\Entity\Entity;


/**
 * Town
 *
 * @property int                    $id        {primary}
 * @property String                 $nazev       
 * @property OneHasMany|School[]    $skola     {1:m School::$mesto}
 */
class Town extends Entity
{
}
