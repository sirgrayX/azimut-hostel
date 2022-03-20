<?php
    session_start();
    require 'functions.php';
    if(!$_SESSION['id_admin']) {
        header('location: index.php?page=admin_auth');
    }else{
        $adminname = $_SESSION['adminname'];
    }
    
?>

<!--- Страница со списком зарезервированных пользователем номеров ------ ----------->
    <h2><?php echo "Добро пожаловать, $adminname!";?></h2>
    <div class="profile-content row">
        <!--------------- Боковая панель --------------------------------->
        <div class="sidenavbar col-md-3 col-12">
            <div class="section aboutuser">
                <h4>Обо мне</h4>
                <div id="user-fio"><?php echo "$adminname";?></div>
            </div>

            <div class="section actions">
                <h4>Действия</h4>
                <ul>
                    <?php 
                        $sql_text = "SELECT * FROM `users`";
                        $sql = $link->query($sql_text);
                    ?> 
                    <li><a href="index.php?page=show_guests">Все пользователи</a></li>
                </ul>
            </div>
        </div>

        
        <!------- Main Content ----------->
        <div class="room-info col-md-9 col-12">
            <h3>Постояльцы</h3>
            <table>
                <tr>
                    <th>Адрес почты</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Дата регистрации</th>
                </tr>
                <?php
                    foreach($sql as $record): 
                ?>
                <tr>
                    <td><?=$record['user_email']?></td>
                    <td><?=$record['user_name']?></td>
                    <td><?=$record['user_surname']?></td>
                    <td><?=$record['created']?></td>
                </tr>
                <?php endforeach; ?>
            </table>         
        </div>
    </div>