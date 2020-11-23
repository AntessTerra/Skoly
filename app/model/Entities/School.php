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
 * @property OneHasMany|Accept[]    $prijatych     {1:m Accept::$skola}
 * 
 */
class School extends Entity
{
}
