<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
    <?php
        function bmr_calculator($age,$body_weight,$sex,$feet,$inches){
            $kilogramBW = floatval($body_weight * 0.45359237);
            $heightinCM = floatval(($feet * 30.48) + ($inches *2.54));
            
            if($sex == "male"){
                $BMR = round((10 * $kilogramBW) + (6.25*$heightinCM)-(5* floatval($age))+5);
            }
            if($sex == "female"){
                $BMR = round((10 * $kilogramBW) + (6.25*$heightinCM)-(5* floatval($age))-161);
            }
            return $BMR;
        }
    ?>
</body>
</html>