<?
//ТОВАРЫ в ШТУКАХ,кот.купил каждый Активный Юзер(значит,что в табл.(users) поля(flag) у него стоит 'active') сам себе: вида: id пользователя, login пользователя, к-во покупок(шт)
  //__задействованы 2 табл.
$sql2="SELECT users.user_id, users.login, users.registration_date, COUNT(orders.i_id) AS quantity
       FROM users
       INNER JOIN orders ON users.user_id = orders.u_id
                         AND users.flag='active'
                         AND orders.p_id= 0
                         GROUP BY users.user_id
                         "; // AND users.flag='active'
                         
/*_________________________или по-другому:
WHERE my_users1.user_id = orders.u_id";
$sql2="SELECT users.user_id, users.login, users.registration_date, COUNT(orders.i_id) AS quantity
       FROM users, orders
       WHERE users.user_id = orders.u_id
                         AND users.flag='active'
                         AND orders.p_id= 0
                         GROUP BY users.user_id
                         ";
_________________________________________*/

$obj_res2= mysqli_query($link,$sql2) or die(my_sqli_error($link));
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res2)) {
    $i++;
    echo "<b>$i) User_ID:</b> {$myrow['user_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Логин:</b> {$myrow['login']} <br>
          <b>&nbsp;&nbsp;&nbsp; Дата регистрации:</b> {$myrow['registration_date']} <br>
          <b>&nbsp;&nbsp;&nbsp; Кол-во купленных товаров (шт.):</b> {$myrow['quantity']} <br><hr>";
}

ЗДЕСЬ ОТВЕТ ВИДА:
1) User_ID: 2 
    Логин: Сергей Петров 
    Дата регистрации: 07-29-2013_15:03 
    Кол-во купленных товаров (шт.): 1 
==============================================================================================================================================================================
//СУММА на которую скупился каждый Активный Юзер(значит,что в табл.(users) поля(flag) у него стоит 'active'): вида: id пользователя, login пользователя, сумма
  //__задействованы 3 табл.
$sql2="SELECT users.user_id, users.login, users.registration_date, SUM(items.price) AS summa
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
          <b>&nbsp;&nbsp;&nbsp; Cумма купленных товаров:</b> {$myrow['summa']} <br><hr>";
}

ЗДЕСЬ ОТВЕТ ВИДА:
1) User_ID: 2 
    Логин: Сергей Петров 
    Дата регистрации: 07-29-2013_15:03 
    Cумма купленных товаров: 250 руб.
==============================================================================================================================================================================

//ТОВАРЫ в ШТУКАХ,кот.купил каждый Активный Юзер(значит,что в табл.(users) поля(flag) у него стоит 'active') сам себе + СУММА на которую скупился каждый Активный Юзер: вида: id пользователя, login пользователя, сумма
$sql2="SELECT users.user_id, users.login, users.registration_date, COUNT(orders.i_id) AS quantity, SUM(items.price) AS summa
       FROM users
       INNER JOIN orders ON users.user_id = orders.u_id
       INNER JOIN items  ON orders.i_id = items.item_id
                         WHERE users.flag='active'
                         AND orders.p_id= 0
                         GROUP BY users.user_id
                         ";
/*_________________________или по-другому
$sql2="SELECT users.user_id, users.login, users.registration_date, COUNT(orders.i_id) AS quantity, SUM(items.price) AS summa
       FROM users, orders, items
       WHERE users.user_id = orders.u_id AND orders.i_id = items.item_id
                         AND users.flag='active'
                         AND orders.p_id= 0
                         GROUP BY users.user_id
                         ";
_________________________________________*/

$obj_res2= mysqli_query($link,$sql2) or die(my_sqli_error($link)); 
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res2)) {
    $i++;
    echo "<b>$i) User_ID:</b> {$myrow['user_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Логин:</b> {$myrow['login']} <br>
          <b>&nbsp;&nbsp;&nbsp; Дата регистрации:</b> {$myrow['registration_date']} <br>
          <b>&nbsp;&nbsp;&nbsp; Кол-во купленных товаров (шт.):</b> {$myrow['quantity']} <br>
          <b>&nbsp;&nbsp;&nbsp; Cумма купленных товаров:</b> {$myrow['summa']} <br><hr>";
}

1) User_ID: 2 
    Логин: Сергей Петров 
    Дата регистрации: 07-29-2013_15:03 
    Кол-во купленных товаров (шт.): 1 
    Cумма купленных товаров: 250 руб.
==============================================================================================================================================================================

// Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров.
$sql3="SELECT partners.partner_id, partners.partner_name, COUNT(orders.u_id) AS cnt_user
       FROM partners
       INNER JOIN orders ON orders.p_id = partners.partner_id
       GROUP BY partners.partner_name
       ";

$obj_res3= mysqli_query($link,$sql3) or die(my_sqli_error($link));
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res3)) {
    $i++;
    echo "<b>$i) Partner_ID:</b> {$myrow['partner_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Имя партнера:</b> {$myrow['partner_name']} <br>
          <b>&nbsp;&nbsp;&nbsp; Купил товары для: </b> {$myrow['cnt_user']} пользователей <br><hr>";
}

//а если надо тоже самое НО:
  // Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров. НО при этом,если партнер покупает товар одному и тому же пользователю дважды-это 1покупка(!):
$sql3="SELECT partners.partner_id, partners.partner_name, COUNT(DISTINCT orders.u_id ) AS cnt_user
       FROM partners
       INNER JOIN orders ON orders.p_id = partners.partner_id
       GROUP BY partners.partner_name
       ";

$obj_res3= mysqli_query($link,$sql3) or die(my_sqli_error($link));
$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res3)) {
    $i++;
    echo "<b>$i) Partner_ID:</b> {$myrow['partner_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Имя партнера:</b> {$myrow['partner_name']} <br>
          <b>&nbsp;&nbsp;&nbsp; Купил товары для:</b> {$myrow['cnt_user']} пользователей <br>";
}

ЗДЕСЬ ОТВЕТ ВИДА:
2) Partner_ID: 9 
    Имя партнера: Гена 
    Купил товары для: 1 пользователей 
==============================================================================================================================================================================

// Какую СУММУ потратил партнер на всех пользователей:
$sql3="SELECT partners.partner_id, partners.partner_name, COUNT(orders.u_id) AS cnt_user, SUM(items.price) AS summ_partner
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
          <b>&nbsp;&nbsp;&nbsp; Потраченная им сумма</b> <i>(на всех пользователей) ИТОГО </i><b>:</b> {$myrow['summ_partner']} <br><hr>";
}

ЗДЕСЬ ОТВЕТ ВИДА:
2) Partner_ID: 9 
    Имя партнера: Гена 
    Потраченная им сумма (на всех пользователей) ИТОГО : 100 
==============================================================================================================================================================================

//  Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров + Какую СУММУ потратил партнер на всех пользователей
$sql3="SELECT partners.partner_id, partners.partner_name, COUNT(orders.u_id) AS cnt_user, SUM(items.price) AS summ_partner
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

//а если надо тоже самое НО:
  // Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров. НО при этом,если партнер покупает товар одному и тому же пользователю дважды-это 1покупка(!) +
  // Какую СУММУ потратил партнер на всех пользователей:
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

ЗДЕСЬ ОТВЕТ ВИДА:
2) Partner_ID: 9 
    Имя партнера: Гена 
    Купил товары для: 1 пользователей 
    Потраченная им сумма (на всех пользователей) ИТОГО : 100 
==============================================================================================================================================================================

// Посчитать СКОЛЬКИМ ПОЛЬЗОВАТЕЛЯМ купил товары каждый из партнеров. НО при этом,если партнер покупает товар одному и тому же пользователю дважды-это 1покупка(!) +
  // Посчитать какую сумму потратил партнер на каждого пользователя.

$sql3="SELECT partners.partner_id, partners.partner_name, users.user_id, users.login, COUNT( orders.u_id ) AS cnt_user, SUM( items.price ) AS summ_partner
      FROM partners
      JOIN orders ON orders.p_id = partners.partner_id
      JOIN items ON orders.i_id = items.item_id
      JOIN users ON orders.u_id = users.user_id
      GROUP BY users.login, partners.partner_name
      ORDER BY partners.partner_id
       ";

$obj_res3= mysqli_query($link,$sql3) or die(my_sqli_error($link));

$i=''; //counter
while($myrow= mysqli_fetch_assoc($obj_res3)) {
    $i++;
    echo "<b>$i) Partner_ID:</b> {$myrow['partner_id']} <br>
          <b>&nbsp;&nbsp;&nbsp; Имя партнера:</b> {$myrow['partner_name']} <br>
          <b>&nbsp;&nbsp;&nbsp; Потраченная им сумма</b> <i>(на юзера: {$myrow['login']}) = {$myrow['summ_partner']}руб.<br><br>";
}

ЗДЕСЬ ОТВЕТ ВИДА:
1) Partner_ID: 3 
    Имя партнера: Илья 
    Потраченная им сумма (на юзера: Рональд Рейган) = 600руб.

2) Partner_ID: 3 
    Имя партнера: Илья 
    Потраченная им сумма (на юзера: 0.75019500 -Name) = 250руб.

3) Partner_ID: 3 
    Имя партнера: Илья 
    Потраченная им сумма (на юзера: Бонч-Бруевич Иван) = 250руб.

4) Partner_ID: 3 
    Имя партнера: Илья 
    Потраченная им сумма (на юзера: 0.90709300 -Name) = 500руб.

5) Partner_ID: 5 
    Имя партнера: Белый 
    Потраченная им сумма (на юзера: 0.85014900 -Name) = 500руб.

6) Partner_ID: 5 
    Имя партнера: Белый 
    Потраченная им сумма (на юзера: Балин Викентий) = 250руб.

7) Partner_ID: 9 
    Имя партнера: Гена 
    Потраченная им сумма (на юзера: Бонч-Бруевич Иван) = 100руб.

8) Partner_ID: 10 
    Имя партнера: Чебурашка 
    Потраченная им сумма (на юзера: Gomer Simpson) = 500руб.

9) Partner_ID: 10 
    Имя партнера: Чебурашка 
    Потраченная им сумма (на юзера: 0.00006600 -Name) = 100руб.

?>    
