<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Src\Factory;

use Src\Model\View;

/**
 * Description of MessageInformationFactory
 *
 * @author Shawn Tremere
 */
class ViewFactory {
    const TABLE_NAME_FROM = 'currencyfrom_view';
    const TABLE_NAME_TO = 'currencyto_view';
    const TABLE_NAME_ORIGINATING = 'originatingcountry_view';
    const COL_TOTAL ='Total';
    const COL_COUNTRY ='Country';
    
  
    public static function hydrate($data) {
        $object = new View;
        $object->total = $data[self::COL_TOTAL];
        $object->country = $data[self::COL_COUNTRY];

      return $object;
    }
    
   
}
