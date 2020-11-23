<?php

namespace MyOrm;


use Nextras\Orm\Entity\Entity;


/**
 * Accept
 *
 * @property int                    $id        {primary}
 * @property Profession             $obor      {m:1 Profession::$prijatych} 
 * @property School                 $skola     {m:1 School::$prijatych} 
 * @property int                    $pocet
 * @property int                    $rok    
 *  
 */
class Accept extends Entity
{
}
