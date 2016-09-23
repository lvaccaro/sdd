# sdd
Php Sdd - sepa direct debit

Call the main php script page and download the result
php sdd.php > result.xml

View beauty result
xmllint result.xml

Rename the result file into wanted format
mv result.xml TCP.FTSS.BIDTB.L1D01.D160610.T105300

Upload the file to the server as the following
SERVER_IP
SERVER_PORT
SERVER_USER
SERVER_CERT

sftp -i SERVER_CERT -P SERVER_PORT SERVER_USER@SERVER_IP:/
