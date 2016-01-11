<?php
/**
 * Created by PhpStorm.
 * User: dev48
 * Date: 28.07.15
 * Time: 11:32
 */
header('Content-Type: text/html; charset=utf-8');
ob_start();

//--------------------------------------------------------------------------------------------------------------------------
const DB_HOST = 'dbtrain.loc';
const DB_LOGIN = 'littus';
const DB_PASSWORD = '55555';
const DB_NAME = 'db_training';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) { printf("Подключение к БД не удалось: %s\n", mysqli_connect_error()); exit(); }
$link->query( "SET CHARSET utf8" );

echo 'hello <br><hr>';
/*
$logins= array(Аленин,
    Буриличева,
    Вышегородских,
    Вердеревский,
    Логвинова,
    Калинина,
    Калдярв,
    Свалова,
    Мосина,
    Лагутова);

foreach($logins as $log){
        $log.= microtime();
        echo "$log <br>";
}
*/

/*
// заполняем табл.(users)
for($i=1; $i <= 50; $i++ ) {

    // to login
    $name= substr(microtime(), 0,-11);
    $name.=" -Name";
        //echo "$name <br>";

    // to password
    $pass= substr(microtime(), 0,-11);
    $pass= md5($pass);
        //echo "$pass <br>";

    // to registration_date
    $time_reg= mktime(); //берем текущую TIMESTAMP
    $time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;
    $time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;$time_reg= $time_reg+$i;

    $t_reg= date("m-d-Y H:i:s", $time_reg); // получаем текущую дату
    $t_reg= substr($t_reg, 0,-3); // получаем текущую дату без секунд
    $t_reg= str_replace ('2015', '2013', $t_reg); // заменяем в текущей строке 2014г. на 2015г.
    $t_reg= str_replace (' ', '_', $t_reg); // заменяем в текущей строке пробел на знак "_".
        //echo "$t_reg <br>";

    // to last_visit_date
    $last= mktime(); //берем текущую TIMESTAMP
    $last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;
    $last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;$last= $last+$i;

    $l_reg= date("m-d-Y H:i:s", $last); // получаем текущую дату
    $l_reg= substr($l_reg, 0,-3); // получаем текущую дату без секунд
    $l_reg= str_replace ('2015', '2014', $l_reg); // заменяем в текущей строке 2014г. на 2015г.
    $l_reg= str_replace (' ', '_', $l_reg); // заменяем в текущей строке пробел на знак "_".
        //echo "$t_reg <br>";

    // to ip
    $num= '0.0.0.0';
    $num1= substr($num, 0,-6);
    $num1 = $num1+$i;
    $num1="1".$num1.".0.0";
        //echo "$num1 <br>";

    // to flag status
    $change='';
    if($i%2==0){ $change= 'active'; }
    else { $change= 'not_active'; }

    $sql= "INSERT INTO users (login,password,registration_date,last_visit_date,ip,flag)
           VALUES ('$name','$pass','$t_reg','$l_reg','$num1','$change')"; //"INSERT INTO users (login) VALUES ('$name')";
    mysqli_query($link, $sql);

} // END_For
*/


// Юзеров всего:
$sql= "SELECT COUNT(*) FROM users";
$obj_res= mysqli_query($link,$sql) or die(my_sqli_error($link));

$result=  mysqli_fetch_assoc($obj_res);
echo 'Всего пользователей в БД: <b>'.$result['COUNT(*)'].'</b><br>';

// Юзеров Активных:
$sql= "SELECT COUNT(*) FROM users WHERE flag='active'";
$obj_res= mysqli_query($link,$sql) or die(my_sqli_error($link));

$result=  mysqli_fetch_assoc($obj_res);
echo '&nbsp;&nbsp;&nbsp;&nbsp; из них Активных пользователей: <b>'.$result['COUNT(*)'].'</b><br>';

// Юзеров Не Активных:
$sql= "SELECT COUNT(*) FROM users WHERE flag='not_active'";
$obj_res= mysqli_query($link,$sql) or die(my_sqli_error($link));

$result=  mysqli_fetch_assoc($obj_res);
echo '&nbsp;&nbsp;&nbsp;&nbsp; из них Не активных пользователей: <b>'.$result['COUNT(*)'].'</b><br>';
        echo '<hr>'; //-----------------------------------------------------------------------------------------------------------------

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Посчитать сколько товаров в штуках купили активные пользователи себе сами и на какую сумму скупился каждый юзер:<br>";
//ТОВАРЫ в ШТУКАХ,кот.купил каждый Активный Юзер(значит,что в табл.(users) поля(flag) у него стоит 'active') сам себе + СУММА на которую скупился каждый Активный Юзер: вида: id пользователя, login пользователя, сумма
//__задействованы 3 табл.
$sql2="SELECT users.user_id, users.login, users.registration_date, COUNT(orders.i_id) AS quantity, SUM(items.price) AS summa
       FROM users
       INNER JOIN orders ON users.user_id = orders.u_id
       INNER JOIN items  ON orders.i_id = items.item_id
                         WHERE users.flag='active'
                         AND orders.p_id= 0
                         GROUP BY users.user_id
                         ";

$obj_res2= mysqli_query($link,$sql2) or die(my_sqli_error($link));
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res2)) {
    $i++;
    echo "<b>$i) User_ID:</b> {$myrow['user_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Логин:</b> {$myrow['login']} <br>
          <b>&nbsp;&nbsp;&nbsp; Дата регистрации:</b> {$myrow['registration_date']} <br>
          <b>&nbsp;&nbsp;&nbsp; Кол-во купленных товаров (шт.):</b> {$myrow['quantity']} <br>
          <b>&nbsp;&nbsp;&nbsp; Cумма купленных товаров:</b> {$myrow['summa']} руб.<br><hr>";
}
echo "<hr><br>";
//---------------------------------------------------------------------------------------------------------------------------------------

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>2) Посчитать скольким пользователям купил товары каждый из партнеров. При этом - если партнер покупает товар одному и тому же пользователю дважды - это 1-на покупка.</i><br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>+ Какую СУММУ потратил партнер на всех пользователей:</i><br>";
//  Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров(если партнер покупает товар одному и тому же пользователю дважды-это 1покупка) + Какую СУММУ потратил партнер на всех пользователей
$sql3="SELECT partners.partner_id, partners.partner_name, COUNT(DISTINCT orders.u_id ) AS cnt_user, SUM(items.price) AS summ_partner
       FROM partners
       INNER JOIN orders ON orders.p_id = partners.partner_id
       INNER JOIN items  ON orders.i_id = items.item_id
       GROUP BY partners.partner_name
       ";

$obj_res3= mysqli_query($link,$sql3) or die(my_sqli_error($link));
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res3)) {
    $i++;
    echo "<b>$i) Partner_ID:</b> {$myrow['partner_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Имя партнера:</b> {$myrow['partner_name']} <br>
          <b>&nbsp;&nbsp;&nbsp; Купил товары для:</b> {$myrow['cnt_user']} пользователей <br>
          <b>&nbsp;&nbsp;&nbsp; Потраченная им сумма</b> <i>(на всех пользователей) ИТОГО </i><b>:</b> {$myrow['summ_partner']} <br><hr>";
}
echo "<hr><br><br>";
//---------------------------------------------------------------------------------------------------------------------------------------

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>3) Посчитать какую сумму потратил партнер на каждого пользователя:</i>  <br>";

// Посчитать скольким пользователям купил товары каждый из партнеров. При этом,если партнер покупает товар одному и тому же пользователю дважды-это 1покупка(!)//__задействованы 3 табл.
   // какую сумму потратил партнер на каждого пользователя
$sql3="SELECT partners.partner_id, partners.partner_name, users.user_id, users.login, COUNT( orders.u_id ) AS cnt_user, SUM( items.price ) AS summ_partner
      FROM partners
      JOIN orders ON orders.p_id = partners.partner_id
      JOIN items ON orders.i_id = items.item_id
      JOIN users ON orders.u_id = users.user_id
      GROUP BY users.login, partners.partner_name
      ORDER BY partners.partner_id
       ";  // INNER JOIN users  ON users.user_id = orders.u_id

$obj_res3= mysqli_query($link,$sql3) or die(my_sqli_error($link));

$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res3)) {
    $i++;
    echo "<b>$i) Partner_ID:</b> {$myrow['partner_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Имя партнера:</b> {$myrow['partner_name']} <br>
          <b>&nbsp;&nbsp;&nbsp; Потраченная им сумма</b> <i>(на юзера: {$myrow['login']}) = {$myrow['summ_partner']}руб.<br><br>";
}
echo "<hr><br><br>"; // <b>&nbsp;&nbsp;&nbsp; Купил товары для:</b> {$myrow['cnt_user']} пользователей <br>

// <b>&nbsp;&nbsp;&nbsp; Потраченная им сумма</b> <i>(на всех пользователей) ИТОГО </i><b>:</b> {$myrow['summ_partner']} <br><hr>"; <b>: {$myrow['users.user_id']}</b>

// INNER JOIN users  ON orders.u_id = users.user_id
// users.user_id, users.login


?>
