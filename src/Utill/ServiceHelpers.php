<?php
namespace Src\Utill;

Class ServiceHelpers {


    public function unprocessableEntityResponse() {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    public function validResponse($result)  {
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $responseArray['total'] =  $result['rowCount'];
        unset($result['rowCount']);
        $responseArray['rows'] = $result;
        $response['body'] = trim(json_encode($responseArray), '[]');
        return $response; 
    }

    public function validPostResponse($result)  {
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $responseArray['success'] =  TRUE;
        unset($result['rowCount']);
        $responseArray['rows'] = $result;
        $response['body'] = trim(json_encode($responseArray), '[]');
        return $response; 
    }
    public function validViewResponse($result)  {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response; 
    }

    public function recordDeleted() {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $succesArray['success'] = TRUE;
        $response['body'] = json_encode($succesArray);
        return $response;
    }

    public static function parseOutput($output) {
        
        $searchCriteria = array();
        if (isset($output['order']) && isset($output['sort'])) {
            $searchCriteria['order'] = (string) $output['order'];
            $searchCriteria['sort'] = (string) ucfirst($output['sort']);
        }
        if (isset($output['limit'])) {
            $searchCriteria['limit'] = (int) $output['limit'];
        }
        if (isset($output['offset'])) {
            $searchCriteria['offset'] = (int) $output['offset'];
        }
        if (isset($output['filter'])) {
            $searchCriteria['filter'] = json_decode($output['filter']);

        }
        if (isset($output['delete']) && !empty($output['recordId'])) {
              $searchCriteria['delete']  = (int) $output['recordId'];
        }
        if (isset($output['view'])) {

              $searchCriteria['view']  = (string) $output['view'];
        }
        return $searchCriteria;
    }

    public static function buildWhereClause (Array $whereArray, &$stmt) {
        $bindParamArray = array();
        $lastKey = array_key_last($whereArray);
        foreach($whereArray as $key => $value) {
            $key = ucfirst($key);
            if (($key != ucfirst(array_key_last($whereArray))) && (count($whereArray) > 1 )) {
                $stmt .= "$key = :$key  AND " ; 
            } else {
                $stmt .= "$key = :$key   " ;
            }
            $bindParamArray[$key] = $value;
        }
         return $bindParamArray;

    }

    public static function buildLimitClause (Array $criteria, &$stmt,  Array &$bindParamArray) {
        $limit =  $criteria['limit']; 
        $offset = $criteria['offset']; 
        $stmt .= " LIMIT $limit OFFSET $offset ";
    }


    public static function buildOrderClause (Array $criteria, &$stmt,  Array &$bindParamArray) {
        $order =  $criteria['order']; 
        $sort = $criteria['sort']; 
        if(!isset($criteria['filter'])) {
            $bindParamArray['order'] = $criteria['order'];
            $bindParamArray['sort'] = $criteria['sort'];
        } 
       
        $stmt .= " ORDER BY $sort $order ";
    }


}
