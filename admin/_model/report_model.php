<?php 
 
class ReportModel{

    function getSalesByDate($db,$strQuery){     
        $resultArrry = array();
        $result = $db->query("SELECT SUM(TotalAmount) AS totalSales FROM  finalbilling ".$strQuery." GROUP BY Status");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row); 
        } 
        return $resultArrry[0];
    }

    function getSalesListByDate($db,$strQuery){     
        $resultArrry = array();
        $result = $db->query("SELECT * FROM finalbilling ".$strQuery);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    } 

    function getMedListCountsByDate($db,$strQuery){     
        $resultArrry = array();
        $result = $db->query("
            SELECT
                medicine.Id
                , medicine.Name
                , medicine.Brand 
                , medicine.DosageForm 
                , medicine.Strength 
                , medicine.Manufacturer 
                , medicine.Description 
                , prq_laboratory_table.Status 
                , prq_laboratory_table.created_date
                , SUM(IF( prq_laboratory_table.AdjustQty != '' ,  prq_laboratory_table.AdjustQty , prq_laboratory_table.Qty )) AS totalQty	
            
            FROM 
                aaa.prq_laboratory_table
                INNER JOIN aaa.medicine 
                    ON (prq_laboratory_table.medicine_Id = medicine.Id)
            WHERE 
            prq_laboratory_table.Status = 'Paid'
            GROUP BY medicine.Id;
        ");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    function getLabListCountsByDate($db,$strQuery){     
        $resultArrry = array();
        $result = $db->query("
            SELECT 
                laboratory.Id
                ,laboratory.Name
                ,COUNT(laboratory.Id) AS LabCount
                , prq_laboratory_table.Status
                , prq_laboratory_table.created_date
            FROM
                aaa.prq_laboratory_table
                INNER JOIN aaa.laboratory 
                    ON (prq_laboratory_table.laboratory_Id = laboratory.Id)
            WHERE 
                prq_laboratory_table.Status = 'Paid'
            GROUP BY laboratory.Id
        ");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

}