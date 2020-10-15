<?php

namespace MyOrm;


use Nextras\Orm\Entity\Entity;


/**
 * School
 *
 * @property int                    $id        {primary}
 * @property String                 $nazev       
 * @property Town                   $mesto     {m:1 Town::$skola}  
 * @property double                 $glat        
 * @property double                 $glong       
 */
class School extends Entity
{
}
