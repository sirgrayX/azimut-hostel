<?php

    include 'handlers/admin_actions.php';

    $_SESSION['room_price'] = $room['price'];
    $_SESSION['room_id'] = $room['id_room'];
    $_SESSION['room_photo'] = $room['photo'];
    $_SESSION['room_name'] = $room['name'];
    $_SESSION['room_description'] = $room['description'];
    $_SESSION['room_count'] = $room['room_count'];
    $_SESSION['category_id'] = $room['category_id'];

    $category = '';
    if ($_SESSION['category_id'] == 1){
        $category = 'Стандарт';
    }elseif($_SESSION['category_id'] == 2){
        $category = 'Эконом';
    }elseif($_SESSION['category_id'] == 3){
        $category = 'Люкс';
    }else{
        $category = 'Категория не указана';
    }
?>


<div id="singleRoom-img">
    <img src="<?php echo $_SESSION['room_photo']; ?>" />
</div>

<div id="singleRoom-content">
    <h1 id="singleRoom-name"> <?php echo $_SESSION['room_name']?> </h1>
    <div id="singleRoom-price">Цена: <?php echo $_SESSION['room_price'] . ' ₽/сутки';?></div>
    <div id="singleRoom-desc"><?php echo $_SESSION['room_description']?></div>
    <div class="field-items">
        <div class="field-item even"><i class="fa-solid fa-mug-saucer"></i>Завтрак</div>
        <div class="field-item even"><i class="fa-solid fa-bed"></i>Одна большая кровать</div>
        <div class="field-item odd"><i class="fa-solid fa-bath"></i>Ванна</div>
        <div class="field-item even"><i class="fa-solid fa-shower"></i>Душ</div>
        <div class="field-item odd"><i class="fa-solid fa-tv"></i></i>Телевизор</div>
        <div class="field-item odd"><i class="fa-solid fa-wifi"></i>Беспроводной доступ в интернет</div>
        <div class="field-item even"><i class="fa-solid fa-soap"></i>Принадлежности для ухода/душа</div>
        <div class="field-item odd"><i class="fa-solid fa-phone"></i>Телефон</div>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRoom">Редактировать</button>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteRoom">Удалить</button>



    <div class="modal fade" id="deleteRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удалить номер из базы данных</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?page=single" method="post" id="modal">
                    <div class="modal-body">
                        <fieldset>
                            <div class="confirm">
                                <strong><label>Вы действительно хотите удалить этот номер из базы данных отеля? Восстановить его после удаления будет невозможно!</label></strong>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary" name="button-delete">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Внесите изменения</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?page=single" method="post" id="modal">
                    <div class="modal-body">
                        <fieldset>
                            <div class="red-form-name">
                                <label>Название</label>
                                <input type="text" name="red-form-name" value="<?=$_SESSION['room_name']?>"> 
                            </div>

                            <div class="red-form-price">
                                <label>Цена</label>
                                <input type="number" name="red-form-price" value="<?=$_SESSION['room_price']?>">
                            </div>

                            <div class="red-form-room-count">
                                <label>Комнаты</label>
                                <input type="number" name="red-form-room_count" value="<?=$_SESSION['room_count']?>" min="1" max="2">
                            </div>

                             <div class="red-form-category">
                                <label>Категория</label>
                                <input type="text" name="red-form-category" value="<?=$category?>">
                            </div>

                            <div class="red-form-img">
                                <label>Фотография</label>
                                <input class="form-control" type="file" id="formFile" name="red-form-img">
                            </div>

                            <div class="red-form-desc">
                                <label>Описание</label>
                                 <textarea rows="7" cols="40" name="red-form-desc"></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary" name="button-redact">Внести изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>