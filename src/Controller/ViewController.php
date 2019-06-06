<?php
namespace Src\Controller;

use Src\Dao\ViewMapper;
use Src\Utill\DatabaseConnection;
use Src\Utill\ServiceHelpers;


class ViewController {

    private $db;
    private $requestMethod;
    private $searchCriteria;
 

    private $messageInformationMapper;

    public function __construct($db, $requestMethod, $searchCriteria = NULL) {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->viewMapper = new ViewMapper($this->db);
        $this->serviceHelper = new ServiceHelpers();
        if ($searchCriteria) $this->searchCriteria = $searchCriteria;
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                    $response = $this->getViewByCriteria($this->searchCriteria);
                break;
            default:
                $response = $this->serviceHelper->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
             echo ($response['body']);
        }
        
    }


    private function getViewByCriteria($searchCriteria) {

        $result = $this->viewMapper->findByCriteria($searchCriteria);
        if ($result || empty($result)) {
            $response = $this->serviceHelper->validViewResponse($result); 
        } else {
            return $this->serviceHelper->notFoundResponse();
        }
        return $response;
    }
    

    
}