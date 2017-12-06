<?php 

$connection = mysqli_connect('localhost', 'root', '', 'database777');

if ($connection == false) {
    echo ('Ошибка подключения к БД');
    echo mysqli_connect_error();
    exit();
}


$SHOP_ID = "264131"; //Идентификатор магазина
$REST_ID = "10167161"; //API ID
$PWD = "XtIp5FtEJutJRXK1g0Fa"; //API пароль

$BILL_ID = 'bill' . rand(1, 1000); //ID счета
// echo $BILL_ID . '<br>';

$PHONE = preg_replace('/[^0-9]/', '', $_POST['tel']);
$COMMENT = $_POST['comment'];
$AMOUNT = $_POST['amount'];

$data = array(
 "user" => "tel:+" . $PHONE,
 "amount" => $AMOUNT,
 "ccy" => "RUB",
 "comment" => $COMMENT,
 "lifetime" => "2017-12-30T23:59:59"
);


$ch = curl_init('https://api.qiwi.com/api/v2/prv/'.$SHOP_ID.'/bills/'.$BILL_ID);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $REST_ID.":".$PWD);
curl_setopt($ch, CURLOPT_HTTPHEADER,array (
 "Accept: application/json"
));

$results = curl_exec ($ch) or die(curl_error($ch));
echo $results;
echo curl_error($ch);
curl_close ($ch);

$url = 'https://qiwi.com/order/external/main.action?shop='.$SHOP_ID.'&
transaction='.$BILL_ID.'&iframe=true&qiwi_phone='.$PHONE;

echo '<br><br><b><a href="'.$url.'">Ссылка переадресации для оплаты счета</a></b>';


//print_r($data); //вывод массива

#лог в БД
mysqli_query($connection, "INSERT INTO orders(tel, comment, amount, currency, lifetime, billid) VALUES ('{$PHONE}', '{$COMMENT}', '{$AMOUNT}', 'RUB', '2017-12-30T23:59:59', '{$BILL_ID}')");

//echo 'Элемент ' . $BILL_ID . ' был успешно добавлен в  базу';


mysqli_close($connection);

?>
