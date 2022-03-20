<?php
    session_start();
    require 'functions.php';
    if(!$_SESSION['id_user']) {
        header('location: ../../index.php?page=login');
    }else{
        $id_user = $_SESSION['id_user'];
        $user_name = $_SESSION['user_name'];
        $user_surname = $_SESSION['user_surname'];
        $created = dateFormat($_SESSION['created']);
        $user_email = $_SESSION['user_email'];
    }
    
?>

<!--- Страница со списком зарезервированных пользователем номеров ------ ----------->
    <h2><?php echo "Добро пожаловать, $user_name!";?></h2>
    <div class="profile-content row">
        <!--------------- Боковая панель --------------------------------->
        <div class="sidenavbar col-md-3 col-12">
            <div class="section aboutuser">
                <h4>Обо мне</h4>
                <div id="user-fio"><?php echo "$user_name $user_surname";?></div>
                <div id="user-email"><?php echo "$user_email";?></div>
                <div id="created"><?php echo " Впервые вошли $created";?></div>
            </div>

            <div class="section history">
                <h4>История</h4>
                <ul>
                    <?php
                        $sql_history = $link->query("SELECT * FROM `transactions`, `rooms` WHERE `transactions`.user_id = '$id_user' AND `transactions`.room_id = `rooms`.id_room");
                        foreach ($sql_history as $record):
                    ?>
                    <li><a href="index.php?page=transact&id_transaction=<?php echo $record['id_transaction'];?>"><?php echo $record['checkin']; ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>

        
        <!------- Main Content ----------->
        <div class="room-info col-md-9 col-12">
            <div id="singleRoom-img">
                <img src="<?php echo $record['photo']; ?>" />
            </div>

            <div id="singleRoom-content">
                <h1 id="singleRoom-name"> <?php echo $record['name'];?> </h1>
                <div id="singleRoom-price">Чек: <?php echo $record['cost'] . ' ₽';?></div>
                <div id="singleRoom-desc"><?php echo $record['description']?></div>
                <div id="singleRoom-price">Дата заезда: <?php echo dateFormat($record['checkin']);?></div>
                <div id="singleRoom-price">Дата отъезда: <?php echo dateFormat($record['checkout']);?></div>
            </div>
        </div>
    </div>