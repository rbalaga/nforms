<?php

class Model_forms extends CI_Model
{
    function __construct()
    {
        parent::__construct(); //call the model constructor
    }

    function generateNewForm()
    {
        $QryStmt = $this->db->query("INSERT INTO fm_forms(Title) VALUES('New Form title')");
        if ($QryStmt) {
            return $this->db->insert_id();
        }else {
            return NULL;
        }
    }

    function getFormDetails($formId){

        $Query = "SELECT * FROM fm_forms WHERE Id = ?";
        
        $QryStmt = $this->db->query($Query, array($formId));
        
        if ($QryStmt->num_rows() > 0) {
            return $QryStmt->result();
        }else{
            return null;
        }

    }

    function getQuestions($formId)
    {
        $Query = "SELECT `A`.`QuestionId`, `A`.`FormId`, `A`.`Question`, `A`.`QType`, ". 
                        " `A`.`IsRequired`, `B`.`OptionId`, `B`.`QOption` ". 
                        " FROM `fm_questions` A  ". 
                        " LEFT JOIN `fm_options` B  ". 
                        " ON `A`.`QuestionId` = `B`.`QuestionID`  ". 
                        " WHERE `A`.`FormId` = ? ORDER BY `A`.`QuestionId` ASC, `B`.`OptionId` ASC";
        
        $QryStmt = $this->db->query($Query, array($formId));
        
        if ($QryStmt->num_rows() > 0) {
            return $QryStmt->result();
        }else{
            return NULL;
        }
    }

    function updateForm($form){
        $OptionsQuery = "DELETE FROM `fm_options` WHERE QuestionId IN ( SELECT QuestionId from `fm_questions` WHERE FormId = ? )";
        $OptionsQryStmt = $this->db->query($OptionsQuery, array($form['FormId']));
        $QuestionsQuery = "DELETE FROM `fm_questions` WHERE `FormId` = ?";
        $QuestionsQryStmt = $this->db->query($QuestionsQuery, array($form['FormId']));
        if ($OptionsQryStmt && $QuestionsQryStmt) {
            $FormDetailsQry = "UPDATE `fm_forms` SET `Title`= ? WHERE Id = ?";
            $FormDetailsStmt = $this->db->query($FormDetailsQry, array($form['FormTitle'], $form['FormId']));
            foreach ($form['Questions'] as $Question) {
                $QuestionsInsertQry = "INSERT INTO `fm_questions`(`FormId`, `Question`, `QType`, `IsRequired`) VALUES (?,?,?,?)";
                $QType = $Question['QuestionType'] == "MultipleChoice" ? 1 : 0;
                $isRequired = $Question['isRequired'] == "true" ? 1 : 0;
                $QuestionsQryStmt = $this->db->query($QuestionsInsertQry, 
                                        array($form['FormId'], $Question['QuestionTitle'], $QType, $isRequired));
                $QuestionId = $this->db->insert_id();
                if ($Question['QuestionType'] == "MultipleChoice") {
                    foreach ($Question['Options'] as $Option) {
                        $OptionsInsertQry = "INSERT INTO `fm_options`(`QuestionId`, `QOption`) VALUES (?,?)";
                        $OptionsQryStmt = $this->db->query($OptionsInsertQry, array($QuestionId, $Option));
                    }
                }
            }
            return "Form saved successfully";
        }else{
            return NULL;
        }
    }

    function getFormsList(){
        $formsList = $this->db->query("SELECT F.Id, F.Title, COUNT(Q.QuestionId) QuestionsCnt FROM `fm_forms` F, `fm_questions` Q WHERE F.Id = Q.FormId GROUP BY F.Id, F.Title");
        if ($formsList->num_rows() > 0) {
            return $formsList->result();
        }else{
            return NULL;
        }
    }

}
