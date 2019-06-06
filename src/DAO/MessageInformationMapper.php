<?php



namespace Src\Dao;

use Src\Factory\MessageInformationFactory;
use Src\Model\MessageInformation;
use Src\Utill\ServiceHelpers;



/**
 * Description of MessageInformationMaper
 *
 * 
 */
class MessageInformationMapper {

    

    private $db = null;

    public function __construct( $db ) {
        $this->db = $db;
    }


    public function findByCriteria($searchCriteria){
        $stmt = " SELECT * FROM MESSAGEINFORMATION  ";
        $entry = array(); 
        $bindParamArray = array();
        if (!empty($searchCriteria['filter'])) {
          $stmt .= " WHERE ";
          $searchClauseArray =  (array) $searchCriteria['filter'];
          $bindParamArray = ServiceHelpers::buildWhereClause($searchClauseArray, $stmt);
        }
       
        if (isset($searchCriteria['order']) && isset($searchCriteria['sort'])) {
           ServiceHelpers::buildOrderClause($searchCriteria, $stmt, $bindParamArray);
        }

        if (isset($searchCriteria['limit']) && isset($searchCriteria['offset'])) {
            ServiceHelpers::buildLimitClause($searchCriteria, $stmt, $bindParamArray);
        }

        try {
             $stmt = $this->db->prepare($stmt);
             $stmt->execute($bindParamArray);
             $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
             // asigning values to object properties
             foreach ($result as $row) {
                $entry[] = MessageInformationFactory::hydrate($row);
            }
            $entry['rowCount'] = $this->rowCount();

        } catch (\Exception $e) {
            error_log('Could not get  Record ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
        }
        return $entry;
    }


    public function insert(Array $data) {
        
        $stmt = "INSERT INTO MessageInformation 
                        ( RecordId, 
                          UserId, 
                          CurrencyFrom, 
                          CurrencyTo, 
                          AmountSell, 
                          AmountBuy, 
                          Rate,
                          TimePlaced, 
                          OriginatingCountry)
                 VALUES
                        ( :recordId, 
                          :userId, 
                          :currencyFrom, 
                          :currencyTo, 
                          :amountSell,
                          :amountBuy, 
                          :rate, 
                          :timePlaced, 
                          :originatingCountry);";
        try {
            
            $stmt = $this->db->prepare($stmt);
            foreach ($data as $key => $value) {
                  $this->messageInformation =  MessageInformationFactory::setValues($value);
                  $stmt->execute(array(
                     'recordId' => $this->messageInformation->recordId,
                     'userId' => $this->messageInformation->userId,
                     'currencyFrom'  => $this->messageInformation->currencyFrom,
                     'currencyTo' =>  $this->messageInformation->currencyTo,
                     'amountSell' => $this->messageInformation->amountSell,
                     'amountBuy' => $this->messageInformation->amountBuy,
                     'rate' => $this->messageInformation->rate,
                     'timePlaced' => $this->messageInformation->timePlaced,
                     'originatingCountry' => $this->messageInformation->originatingCountry,
                  ));
            }
                    

            
        } catch (\Exception $e) {
            error_log('Could not Insert Record ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
        }
        return $stmt->rowCount();
    }


    public function delete($recordIds) {
        $delete  = $recordIds['delete'];
        $stmt = " DELETE 
                  FROM MessageInformation 
                  WHERE RecordId IN  ($delete) ";

        try {
            $stmt = $this->db->prepare($stmt);
            $stmt->execute();
            
        } catch (\PDOException $e) {
            error_log('Could not Delete Record ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
        }   
            return $stmt->rowCount();
    }

    public function rowCount() {
        $stmt = "SELECT 
                    COUNT(*)
                FROM
                    MessageInformation";
        try {
          $stmt = $this->db->query($stmt);
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            error_log('Could not get Row Count ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
        }
        return $result[0]['COUNT(*)'];
    }

  

}


