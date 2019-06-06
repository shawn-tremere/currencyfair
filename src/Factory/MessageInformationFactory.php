<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Src\Factory;

use Src\Model\MessageInformation;

/**
 * Description of MessageInformationFactory
 *
 * @author Shawn Tremere
 */
class MessageInformationFactory {
    const TABLE_NAME = 'MessageInformation';
    const COL_RECORDID ='RecordId';
    const COL_USERID ='UserId';
    const COL_CURRENCYFROM ='CurrencyFrom';
    const COL_CURRENCYTO ='CurrencyTo';
    const COL_AMOUNTSELL ='AmountSell';
    const COL_AMOUNTBUY = 'AmountBuy';
    const COL_RATE = 'Rate';
    const COL_TIMEPLACED = 'TimePlaced';
    const COL_ORIGINATINGCOUNTRY = 'OriginatingCountry';
    const COL_DATECREATED = 'DateCreated';
    
  
    
    public static function hydrate($data) {
        $object = new MessageInformation;
        $object->recordId = $data[self::COL_RECORDID];
        $object->userId = $data[self::COL_USERID];
        $object->currencyFrom = $data[self::COL_CURRENCYFROM]; 
        $object->currencyTo = $data[self::COL_CURRENCYTO];
        $object->amountSell = $data[self::COL_AMOUNTSELL]; 
        $object->amountBuy = $data[self::COL_AMOUNTBUY];  
        $object->rate = $data[self::COL_RATE];    
        $object->timePlaced = $data[self::COL_TIMEPLACED];  
        $object->originatingCountry = $data[self::COL_ORIGINATINGCOUNTRY]; 
        $object->dateCreated = $data[self::COL_DATECREATED];         

      return $object;
    }
    
    public static function setValues($data) {
          $object = new MessageInformation();
          $object->recordId = NULL; 
          $object->userId = !empty($data['userId']) ? htmlspecialchars(strip_tags($data['userId'])) : null; 
          $object->currencyFrom = !empty($data['currencyFrom']) ? htmlspecialchars(strip_tags($data['currencyFrom'])) : null; 
          $object->currencyTo = !empty($data['currencyTo']) ? htmlspecialchars(strip_tags($data['currencyTo'])) : null; 
          $object->amountSell = !empty($data['amountSell']) ? htmlspecialchars(strip_tags($data['amountSell'])) :  null; 
          $object->amountBuy = !empty($data['amountBuy']) ? htmlspecialchars(strip_tags($data['amountBuy'])) : null; 
          $object->rate = !empty($data['rate']) ? htmlspecialchars(strip_tags($data['rate'])) : null;
          $object->timePlaced = !empty($data['timePlaced']) ? htmlspecialchars(strip_tags($data['timePlaced'])) : null; 
          $object->originatingCountry = !empty($data['originatingCountry']) ? htmlspecialchars(strip_tags($data['originatingCountry'])) : null; 
          $object->dateCreated = !empty($data['dateCreated']) ? htmlspecialchars(strip_tags($data['dateCreated'])) : null; 

          return $object;
    }
}
