<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Src\Model;

/**
 * Description of ApplicantInformation
 *
 * @author ouikede
 */
class MessageInformation {
    
    public $recordId;
    public $userId;
    public $currencyFrom;    
    public $currencyTo;
    public $amountSell; 
    public $amountBuy; 
    public $rate;
    public $timePlaced;
    public $originatingCountry;
    public $dateCreated;
    
    
    public function __construct() {
        
    }
            
    
}
