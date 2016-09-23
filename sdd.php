<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 23/09/16
 * Time: 15:15
 */


$produzione=true;
$prod_sender_cuc="XXXXXXXX";
$test_sender_cuc="XXXXXXXX";
$sia_cuc="XXXXXXXX";


echo '<?xml version="1.0" encoding="UTF-8"?>';
header("Content-type: text/xml");

if($produzione)
    $sender_cuc=$prod_sender_cuc;
else
    $sender_cuc=$test_sender_cuc;

date_default_timezone_set("UTC");
$date=str_replace("UTC","T",date("Y-m-dTH:i:s"));
$ref=$date;


?>

<CdiEnvReq xsi:noNamespaceSchemaLocation="CdiEnvReq.001.01.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <Hdr>
        <Snd>
            <Cd><?=$sender_cuc?></Cd>
            <Type>CUC</Type>
        </Snd>
        <Rcv>
            <Cd><?=$sia_cuc?></Cd>
            <Type>CUC</Type>
        </Rcv>
        <Ref><?=$ref?></Ref>
        <DtTm><?=$date?></DtTm>
    </Hdr>
    <BusObj>
        <SrvNm>INC-SDDC</SrvNm>
        <Ref><?=$ref?></Ref>
        <Type>SDD</Type>
        <Data><![CDATA[<?php
            echo '<?xml version="1.0" encoding="UTF-8"?>';
            require("sddbody.php");
            ?>]]></Data>
    </BusObj>
</CdiEnvReq>