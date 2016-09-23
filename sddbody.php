<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 23/09/16
 * Time: 15:16
 */


$produzione=true;

$tipo="INC-SDDC-01";
$distinta_codice="DISTINTA1"; //univoco nel file
date_default_timezone_set("UTC");
$distinta_data=str_replace("UTC","T",date("Y-m-dTH:i:s"));

$distinta_somma="XX";

$aziendaMittente_nome="XXXXXXXX";
$aziendaMittente_cuc="";
if($produzione)
    $aziendaMittente_cuc="XXXXXXXX";
else
    $aziendaMittente_cuc="XXXXXXXX";

$sottodistinta=[];
$sottodistinta['codice']="SOTTODISTINTA1"; //univoco nel file
$sottodistinta['schema']="CORE"; // CORE COR1 B2B
$sottodistinta['tipo_sequenza_incasso']="OOFF"; //FRST RCUR FNAL OOFF
$sottodistinta['data_scadenza']="YYYY-MM-DD";
$sottodistinta['azienda_creditrice']="XXXXXX";
$sottodistinta['azienda_creditrice_iban']="ITXXXXXXXXXXXXXXXXXXXXXXXXX";
$sottodistinta['azienda_creditrice_abi']="XXXXX";
$sottodistinta['azienda_creditrice_codicecreditore']="ITXXXXXXXXXXXXXXXXXXXXXXXXX";


$disposizione=[];
$disposizione['id']="DISPOSIZIONE1";
$disposizione['uri']=$distinta_codice."-".$disposizione['id']; //identificativo univoco assegnato dal mittente
$disposizione['importo']="XX";
$disposizione['id_mandato']="0000001";
$disposizione['data_mandato']="YYYY-MM-DD";
$disposizione['debitore']="XXXXXX"; //titolare del conto corrente
$disposizione['iban_debitore']="ITXXXXXXXXXXXXXXXXXXXXXXXXX";
$disposizione['codice_causale']="GDSV";
$disposizione['causale']="addebito";


?>
<CBIBdySDDReq xsi:schemaLocation="urn:CBI:xsd:CBIBdySDDReq.00.01.00 CBIBdySDDReq.00.01.00.xsd" xmlns="urn:CBI:xsd:CBIBdySDDReq.00.01.00" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:LMSG="urn:CBI:xsd:CBISDDReqLogMsg.00.01.00">
    <PhyMsgInf>
        <PhyMsgTpCd><?=$tipo?></PhyMsgTpCd>
        <NbOfLogMsg>1</NbOfLogMsg>
    </PhyMsgInf>

    <CBIEnvelSDDReqLogMsg>
        <CBISDDReqLogMsg>


            <?php // Informazioni generali della distinta ?>
            <LMSG:GrpHdr>
                <LMSG:MsgId><?=$distinta_codice?></LMSG:MsgId>
                <LMSG:CreDtTm><?=$distinta_data?></LMSG:CreDtTm>
                <LMSG:NbOfTxs>1</LMSG:NbOfTxs>
                <LMSG:CtrlSum><?=$distinta_somma?></LMSG:CtrlSum>
                <LMSG:InitgPty>
                    <LMSG:Nm><?=$aziendaMittente_nome?></LMSG:Nm>
                    <LMSG:Id>
                        <LMSG:OrgId>
                            <LMSG:Othr>
                                <LMSG:Id><?=$aziendaMittente_cuc?></LMSG:Id>
                                <LMSG:Issr>CBI</LMSG:Issr>
                            </LMSG:Othr>
                            <!--<LMSG:Othr>
                                    <LMSG:Id>RSSMRC80A01F205Z</LMSG:Id>
                                    <LMSG:Issr>ADE</LMSG:Issr>
                            </LMSG:Othr>-->
                        </LMSG:OrgId>
                    </LMSG:Id>
                </LMSG:InitgPty>
            </LMSG:GrpHdr>

            <?php // Informazioni di accredito della distinta ?>


            <LMSG:PmtInf>
                <LMSG:PmtInfId><?=$sottodistinta['codice']?></LMSG:PmtInfId>
                <LMSG:PmtMtd>DD</LMSG:PmtMtd>
                <LMSG:BtchBookg>true</LMSG:BtchBookg>
                <LMSG:PmtTpInf>
                    <LMSG:SvcLvl>
                        <LMSG:Cd>SEPA</LMSG:Cd>
                    </LMSG:SvcLvl>
                    <LMSG:LclInstrm>
                        <LMSG:Cd><?=$sottodistinta['schema']?></LMSG:Cd>
                    </LMSG:LclInstrm>
                    <LMSG:SeqTp><?=$sottodistinta['tipo_sequenza_incasso']?></LMSG:SeqTp>
                    <?php /*<LMSG:CtgyPurp>
                                                <LMSG:Cd>CORT</LMSG:Cd>
                                        </LMSG:CtgyPurp>*/ ?>
                </LMSG:PmtTpInf>
                <LMSG:ReqdColltnDt><?=$sottodistinta['data_scadenza']?></LMSG:ReqdColltnDt>

                <?php // Azienda di accredito ?>
                <LMSG:Cdtr>
                    <LMSG:Nm><?=$sottodistinta['azienda_creditrice']?></LMSG:Nm>
                    <?php /*<LMSG:PstlAdr>
                                                <LMSG:AdrTp>ADDR</LMSG:AdrTp>
                                                <LMSG:Dept>a</LMSG:Dept>
                                                <LMSG:SubDept>a</LMSG:SubDept>
                                                <LMSG:StrtNm>a</LMSG:StrtNm>
                                                <LMSG:BldgNb>a</LMSG:BldgNb>
                                                <LMSG:PstCd>a</LMSG:PstCd>
                                                <LMSG:TwnNm>a</LMSG:TwnNm>
                                                <LMSG:CtrySubDvsn>a</LMSG:CtrySubDvsn>
                                                <LMSG:Ctry>IT</LMSG:Ctry>
                                                <LMSG:AdrLine>a_1</LMSG:AdrLine>
                                                <LMSG:AdrLine>a_2</LMSG:AdrLine>
                                        </LMSG:PstlAdr>*/ ?>
                    <?php /*<LMSG:Id>
                                                <LMSG:PrvtId>
                                                        <LMSG:Othr>
                                                                <LMSG:Id>RSSMRC80A01F205Z</LMSG:Id>
                                                                <LMSG:Issr>ADE</LMSG:Issr>
                                                        </LMSG:Othr>
                                                </LMSG:PrvtId>
                                        </LMSG:Id> */?>
                </LMSG:Cdtr>

                <?php // Iban di accredito ?>
                <LMSG:CdtrAcct>
                    <LMSG:Id>
                        <LMSG:IBAN><?=$sottodistinta['azienda_creditrice_iban']?></LMSG:IBAN>
                    </LMSG:Id>
                </LMSG:CdtrAcct>

                <?php // Iban di accredito ?>
                <LMSG:CdtrAgt>
                    <LMSG:FinInstnId>
                        <LMSG:ClrSysMmbId>
                            <LMSG:MmbId><?=$sottodistinta['azienda_creditrice_abi']?></LMSG:MmbId>
                        </LMSG:ClrSysMmbId>
                    </LMSG:FinInstnId>
                </LMSG:CdtrAgt>


                <?php
                /*
                <LMSG:UltmtCdtr>
                        <LMSG:Nm>Creditore Effettivo</LMSG:Nm>
                        <LMSG:PstlAdr>
                                <LMSG:AdrTp>PBOX</LMSG:AdrTp>
                                <LMSG:Dept>a</LMSG:Dept>
                                <LMSG:SubDept>a</LMSG:SubDept>
                                <LMSG:StrtNm>a</LMSG:StrtNm>
                                <LMSG:BldgNb>a</LMSG:BldgNb>
                                <LMSG:PstCd>a</LMSG:PstCd>
                                <LMSG:TwnNm>a</LMSG:TwnNm>
                                <LMSG:CtrySubDvsn>a</LMSG:CtrySubDvsn>
                                <LMSG:Ctry>IT</LMSG:Ctry>
                                <LMSG:AdrLine>a_1</LMSG:AdrLine>
                                <LMSG:AdrLine>a_2</LMSG:AdrLine>
                        </LMSG:PstlAdr>
                        <LMSG:Id>
                                <LMSG:OrgId>
                                        <LMSG:BICOrBEI>AAAAAA20</LMSG:BICOrBEI>
                                </LMSG:OrgId>
                        </LMSG:Id>
                </LMSG:UltmtCdtr>
                <LMSG:ChrgBr>SLEV</LMSG:ChrgBr>
                <LMSG:ChrgsAcct>
                        <LMSG:Id>
                                <LMSG:IBAN>IT46D0306310001123400004321</LMSG:IBAN>
                        </LMSG:Id>
                </LMSG:ChrgsAcct>
                */?>

                <?php // Identificativo creditore  ?>

                <LMSG:CdtrSchmeId>
                    <LMSG:Nm><?=$sottodistinta['azienda_creditrice']?></LMSG:Nm>
                    <?php /*<LMSG:PstlAdr>
                                                <LMSG:AdrTp>HOME</LMSG:AdrTp>
                                                <LMSG:Dept>a</LMSG:Dept>
                                                <LMSG:SubDept>a</LMSG:SubDept>
                                                <LMSG:StrtNm>a</LMSG:StrtNm>
                                                <LMSG:BldgNb>a</LMSG:BldgNb>
                                                <LMSG:PstCd>a</LMSG:PstCd>
                                                <LMSG:TwnNm>a</LMSG:TwnNm>
                                                <LMSG:CtrySubDvsn>a</LMSG:CtrySubDvsn>
                                                <LMSG:Ctry>IT</LMSG:Ctry>
                                                <LMSG:AdrLine>a</LMSG:AdrLine>
                                        </LMSG:PstlAdr> */ ?>
                    <LMSG:Id>
                        <LMSG:PrvtId>
                            <LMSG:Othr>
                                <LMSG:Id><?=$sottodistinta['azienda_creditrice_codicecreditore']?></LMSG:Id>
                                <?php //<LMSG:Issr>XXX</LMSG:Issr> ?>
                            </LMSG:Othr>
                        </LMSG:PrvtId>
                    </LMSG:Id>
                    <?php /*<LMSG:CtryOfRes>IT</LMSG:CtryOfRes>*/ ?>
                </LMSG:CdtrSchmeId>





                <?php // Dettaglio singole operazioni  ?>

                <LMSG:DrctDbtTxInf>
                    <LMSG:PmtId>
                        <LMSG:InstrId><?=$disposizione['id']?></LMSG:InstrId>
                        <LMSG:EndToEndId><?=$disposizione['uri']?></LMSG:EndToEndId>
                    </LMSG:PmtId>
                    <LMSG:InstdAmt Ccy="EUR"><?=$disposizione['importo']?></LMSG:InstdAmt>
                    <?php /*<LMSG:PmtTpInf>
                                                <LMSG:CtgyPurp>
                                                        <LMSG:Cd>CORT</LMSG:Cd>
                                                </LMSG:CtgyPurp>
                                        </LMSG:PmtTpInf>*/ ?>
                    <?php /*<LMSG:ChrgBr>SLEV</LMSG:ChrgBr>*/ ?>
                    <LMSG:DrctDbtTx>
                        <LMSG:MndtRltdInf>
                            <LMSG:MndtId><?=$disposizione['id_mandato']?></LMSG:MndtId>
                            <LMSG:DtOfSgntr><?=$disposizione['data_mandato']?></LMSG:DtOfSgntr>
                            <LMSG:AmdmntInd>false</LMSG:AmdmntInd>
                            <?php /*<LMSG:AmdmntInd>false</LMSG:AmdmntInd>*/ ?>
                            <?php /*<LMSG:AmdmntInfDtls>
                                                                <LMSG:OrgnlMndtId>ID_Mandato_Originario</LMSG:OrgnlMndtId>
                                                                <LMSG:OrgnlCdtrSchmeId>
                                                                        <LMSG:Nm>Id schema creditore originario</LMSG:Nm>
                                                                        <LMSG:PstlAdr>
                                                                                <LMSG:AdrTp>ADDR</LMSG:AdrTp>
                                                                                <LMSG:Dept>a</LMSG:Dept>
                                                                                <LMSG:SubDept>a</LMSG:SubDept>
                                                                                <LMSG:StrtNm>a</LMSG:StrtNm>
                                                                                <LMSG:BldgNb>a</LMSG:BldgNb>
                                                                                <LMSG:PstCd>a</LMSG:PstCd>
                                                                                <LMSG:TwnNm>a</LMSG:TwnNm>
                                                                                <LMSG:CtrySubDvsn>a</LMSG:CtrySubDvsn>
                                                                                <LMSG:Ctry>IT</LMSG:Ctry>
                                                                                <LMSG:AdrLine>a_1</LMSG:AdrLine>
                                                                                <LMSG:AdrLine>a_2</LMSG:AdrLine>
                                                                        </LMSG:PstlAdr>
                                                                        <LMSG:Id>
                                                                                <LMSG:PrvtId>
                                                                                        <LMSG:Othr>
                                                                                                <LMSG:Id>RSSMRC80A01F205Z</LMSG:Id>
                                                                                                <LMSG:SchmeNm>
                                                                                                        <LMSG:Cd>a</LMSG:Cd>
                                                                                                </LMSG:SchmeNm>
                                                                                                <LMSG:Issr>ADE</LMSG:Issr>
                                                                                        </LMSG:Othr>
                                                                                </LMSG:PrvtId>
                                                                        </LMSG:Id>
                                                                        <LMSG:CtryOfRes>IT</LMSG:CtryOfRes>
                                                                </LMSG:OrgnlCdtrSchmeId>
                                                                <LMSG:OrgnlCdtrAgt>
                                                                        <LMSG:FinInstnId>
                                                                                <LMSG:BIC>AAAAAA20</LMSG:BIC>
                                                                        </LMSG:FinInstnId>
                                                                </LMSG:OrgnlCdtrAgt>
                                                                <LMSG:OrgnlFnlColltnDt>1967-08-13</LMSG:OrgnlFnlColltnDt>
                                                                <LMSG:OrgnlFrqcy>YEAR</LMSG:OrgnlFrqcy>
                                                        </LMSG:AmdmntInfDtls>
                                                        <LMSG:ElctrncSgntr>a</LMSG:ElctrncSgntr>
                                                        <LMSG:FrstColltnDt>1967-08-13</LMSG:FrstColltnDt>
                                                        <LMSG:FnlColltnDt>1967-08-13</LMSG:FnlColltnDt>
                                                        <LMSG:Frqcy>MNTH</LMSG:Frqcy> */ ?>
                        </LMSG:MndtRltdInf>
                        <?php /* <LMSG:PreNtfctnId>a</LMSG:PreNtfctnId> */ ?>
                        <?php /* <LMSG:PreNtfctnDt>1967-08-13</LMSG:PreNtfctnDt> */ ?>
                    </LMSG:DrctDbtTx>
                    <LMSG:Dbtr>
                        <LMSG:Nm><?=$disposizione['debitore']?></LMSG:Nm>
                        <?php /*<LMSG:PstlAdr>
                                                        <LMSG:AdrTp>ADDR</LMSG:AdrTp>
                                                        <LMSG:Dept>a</LMSG:Dept>
                                                        <LMSG:SubDept>a</LMSG:SubDept>
                                                        <LMSG:StrtNm>a</LMSG:StrtNm>
                                                        <LMSG:BldgNb>a</LMSG:BldgNb>
                                                        <LMSG:PstCd>a</LMSG:PstCd>
                                                        <LMSG:TwnNm>a</LMSG:TwnNm>
                                                        <LMSG:CtrySubDvsn>a</LMSG:CtrySubDvsn>
                                                        <LMSG:Ctry>IT</LMSG:Ctry>
                                                        <LMSG:AdrLine>a</LMSG:AdrLine>
                                                </LMSG:PstlAdr>
                                                <LMSG:Id>
                                                        <LMSG:OrgId>
                                                                <LMSG:BICOrBEI>AAAAAA20</LMSG:BICOrBEI>
                                                        </LMSG:OrgId>
                                                </LMSG:Id>
                                                <LMSG:CtryOfRes>IT</LMSG:CtryOfRes>*/ ?>
                    </LMSG:Dbtr>
                    <LMSG:DbtrAcct>
                        <LMSG:Id>
                            <LMSG:IBAN><?=$disposizione['iban_debitore']?></LMSG:IBAN>
                        </LMSG:Id>
                    </LMSG:DbtrAcct>
                    <?php /*<LMSG:InstrForCdtrAgt>a</LMSG:InstrForCdtrAgt>*/ ?>
                    <LMSG:Purp>
                        <LMSG:Cd><?=$disposizione['codice_causale']?></LMSG:Cd>
                    </LMSG:Purp>
                    <?php /*<LMSG:RgltryRptg>
                                                <LMSG:DbtCdtRptgInd>CRED</LMSG:DbtCdtRptgInd>
                                                <LMSG:Dtls>
                                                        <LMSG:Cd>INF</LMSG:Cd>
                                                        <LMSG:Amt Ccy="EUR">100</LMSG:Amt>
                                                        <LMSG:Inf>informazioni RgltryRptg</LMSG:Inf>
                                                </LMSG:Dtls>
                                        </LMSG:RgltryRptg>*/ ?>
                    <LMSG:RmtInf>
                        <LMSG:Ustrd><?=$disposizione['causale']?></LMSG:Ustrd>
                    </LMSG:RmtInf>

                </LMSG:DrctDbtTxInf>

            </LMSG:PmtInf>
        </CBISDDReqLogMsg>
    </CBIEnvelSDDReqLogMsg>
</CBIBdySDDReq>







