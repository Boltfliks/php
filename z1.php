<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        interface IName{
           function GetName();
           function SetName($name);
        }
        interface IID{
            function GetID();
            function SetID($id);
        }

        Class Employer implements IName,IID{
            private $name;
            private $EGN;
            private $salary;
            
            function __construct($name, $EGN, $salary) {
                $this->name = $name;
                $this->EGN = $EGN;
                $this->salary = $salary;
            }

            
            public function GetName() {
                return $this->name;
            }

            public function SetName($name) {
                $this->name = $name;
            }
            public function GetID() {
                return $this->EGN;
            }

            public function SetID($id) {
                $this->EGN = $id;
            }
            
            

           }
          
        Class Student implements IName, IID{
            private $name;
            private $Fnom;
            private $Grade;
            
            function __construct($name, $Fnom, $Grade) {
                $this->name = $name;
                $this->Fnom = $Fnom;
                $this->Grade = $Grade;
            }

            
            public function GetName() {
                return $this->name;
            }

            public function SetName($name) {
                $this->name = $name;
            }
            public function GetID() {
                return $this->Fnom;
            }

            public function SetID($id) {
                $this->Fnom = $id;
            }
        }
        
        $Employer = new Employer("?","?", 1243);
        $Employer->SetName("Ivan Ivanov");
        $Employer->SetID("6737843789");
        echo $Employer->GetName() . " ". $Employer->GetID()."<br>";
        
        $Student = new Student("?","?", 5.50);
        $Student->SetName("Georgi Georgiev");
        $Student->SetID("22621613");
        echo $Student->GetName() . " ". $Student->GetID();
        
        
        
        ?>
    </body>
</html>
