<?php
namespace Src\Controller;

use Src\Dao\MessageInformationMapper;
use Src\Utill\DatabaseConnection;
use Src\Utill\ServiceHelpers;


class MessageInformationController {

    private $db;
    private $requestMethod;
    private $searchCriteria;
 

    private $messageInformationMapper;

    public function __construct($db, $requestMethod, $searchCriteria = NULL) {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->MessageInformationMapper = new MessageInformationMapper($this->db);
        $this->serviceHelper = new ServiceHelpers();
        if ($searchCriteria) $this->searchCriteria = $searchCriteria;
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                    $response = $this->getMessageByCriteria($this->searchCriteria);
                break;
            case 'POST':
                $response = $this->addMessageInformation();
                break;
            case 'DELETE':
                $response = $this->deleteRecord($this->searchCriteria);
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

   

    private function getMessageByCriteria($searchCriteria) {

        $result = $this->MessageInformationMapper->findByCriteria($searchCriteria);
        if ($result || empty($result)) {
            $response = $this->serviceHelper->validResponse($result); 
        } else {
            return $this->serviceHelper->notFoundResponse();
        }
        return $response;
    }
    

    private function addMessageInformation() { 
        
        $inputHolder = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($inputHolder[0])) {
            $data[] = $inputHolder;
        } else {
            $data = $inputHolder;
        } 
        $postResponse = $this->MessageInformationMapper->insert($data);
        if (!$postResponse) {
            return $this->serviceHelper->unprocessableEntityResponse();
        }
        return $response = $this->serviceHelper->validPostResponse($postResponse);
    }

    private function deleteRecord($criteria) {
        $deleteResponse = $this->MessageInformationMapper->delete($criteria);
        if ($deleteResponse) {
            $response = $this->serviceHelper->recordDeleted();
        } else {
            return $this->serviceHelper->unprocessableEntityResponse();
        }
        return $response;
    }
    

    
}
