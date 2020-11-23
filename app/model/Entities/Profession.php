<?php

namespace MyOrm;


use Nextras\Orm\Entity\Entity;


/**
 * Profession
 *
 * @property int                    $id        {primary}
 * @property String                 $nazev       
 * @property OneHasMany|Accept[]    $prijatych {1:m Accept::$obor}
 *  
 */
class Profession extends Entity
{
}
