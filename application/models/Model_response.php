<?php

class Model_response extends CI_Model
{
    function __construct()
    {
        parent::__construct(); //call the model constructor
    }

    function saveResponse($Response)
    {
        $Qry = "INSERT INTO fm_responseentry(User, FormId) VALUES(?, ?)";
        $QryStmt = $this->db->query($Qry, array('Rammohan', $Response['FormId']));
        if ($QryStmt) {
            $ResponseId = $this->db->insert_id();
            $Qry = "INSERT INTO `fm_responses`(`ResponseId`, `QuestionId`, `Response`) 
                    VALUES (?,?,?)";
            foreach ($Response['Response'] as $key => $Question) {
                $ResponseStmt = $this->db->query($Qry, 
                    array($ResponseId, $Question['QuestionId'], $Question['Response']));
                if (!$ResponseStmt) {
                    return null;
                }
            }
            return "Response saved";
        }else {
            return null;
        }
    }
}