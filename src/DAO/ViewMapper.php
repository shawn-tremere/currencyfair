<?php



namespace Src\Dao;

use Src\Factory\ViewFactory;
use Src\Utill\ServiceHelpers;



/**
 * Description of MessageInformationMaper
 *
 * 
 */
class ViewMapper {

    

    private $db = null;

    public function __construct( $db ) {
        $this->db = $db;
    }


    public function findByCriteria($searchCriteria){
        $view = $searchCriteria['view']; 
         if (!$this->getViews($view)) return FALSE;
        $stmt = " SELECT * FROM $view  ";
        $entry = array(); 
        
        try {
             $stmt = $this->db->prepare($stmt);
             $stmt->execute();
             $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
             // asigning values to object properties
             foreach ($result as $row) {
                $entry[] = ViewFactory::hydrate($row);
            }

        } catch (\Exception $e) {
            error_log('Could not get  Record ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
        }
        return $entry;
    }


    public function getViews($view) {

      $stmt = "SHOW FULL TABLES IN CurrencyFair WHERE TABLE_TYPE LIKE 'VIEW';";
      try {
             $viewFound = FALSE;
             $stmt = $this->db->prepare($stmt);
             $stmt->execute();
             $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
             foreach ($result as $key => $row) {
                if ($result[$key]['Tables_in_currencyfair'] == $view) {
                  return TRUE;
                } 
             }
      } catch (\Exception $e) {
            error_log('Could not get  Record ' . $e->getMessage() .' line # '. __LINE__);
            return FALSE;
      }
        return $viewFound;
    }


    

  

}


