<?php
class person {
    private $fname, $lname;
    function __construct($fname = "noFirstName", $lname = "noLastName") {
        $this->fname = $fname;
        $this->lname = $lname;
    }
    // Names methods are here.
    function getFullName()
    {
        return $this->fname . " " . $this->lname;
    }
    function getFName()
    {
        return $this->fname;
    }
    function getLName()
    {
        return $this->lname;
    }

    private $marks;
    // Marks methods are here.
    function setMarks($marks)
    {
        $this->marks = $marks;
    }
    function getMarks()
    {
        return $this->marks;
    }

    private $phoneNo;
    // Phone Number methods here. 
    function setPhoneNo($phoneNo){
        $this->phoneNo=$phoneNo;
    }

    function getPhoneNo(){
        return $this->phoneNo;
    }

    public $mailId;
    // Mail id methods here. 
    function setMailId($mailId){
        $this->mailId=$mailId;
    }

    function getMailId(){
        return $this->mailId;
    }

} ?>