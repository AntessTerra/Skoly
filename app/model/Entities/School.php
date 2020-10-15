<?php

namespace MyOrm;


use Nextras\Orm\Entity\Entity;


/**
 * School
 *
 * @property int                    $id        {primary}
 * @property String                 $nazev       
 * @property Town                   $mesto     {m:1 Town::$skola}  
 * @property double                 $geo-lat        
 * @property double                 $geo-long       
 */
class School extends Entity
{
}
