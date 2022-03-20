<?php
    # подключаю файл с обработчиком 
    #для формы бронирования номера;
    include 'controllers/make_reservation.php';
    $_SESSION['room_price'] = $room['price'];
    $_SESSION['room_id'] = $room['id_room'];
    $_SESSION['room_photo'] = $room['photo'];
    $_SESSION['room_name'] = $room['name'];
    $_SESSION['room_description'] = $room['description'];
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


<!----------------------------- МОДАЛЬНОЕ ОКНО --------------------------->
      <!-- Кнопка для активации всплывающей формы бронирования -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Забронировать номер</button>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Забронировать этот номер</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?page=single" method="post" onInput="dayscountval.value=dayscount.value" id="modal">
                    <div class="modal-body">
                        <fieldset>
                            <div class="one-third-width">
                                <label>Число</label> 
                                <input type="number" min="1" max="31" name="day" value="<?php echo date('d');?>">
                            </div>
                            <div class="two-third-width">
                                <label>Месяц</label>
                                <input type="month" name="month" value="<?php echo date('Y-m');?>">
                            </div>
                            <div class="half-width">
                                <label>Количество дней</label>
                                <div id="flexbox">
                                    <div class="num">1</div> <input type="range" min="1" max="14" step="1" name="dayscount" value="<?php $dayscount=1;?>" id="range-input" onInput = "costCalc()"><div class="num">14</div>
                                </div>
                            </div>
                            <div class="half-width output-area">
                                <output name="dayscountval">14</output>
                            </div>

                            <div class="output-area">
                                Итого: <span id="span"><?php $room['price']; ?></span> ₽
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary" name="button-reserv">Забронировать</button>
                    </div>
                </form>
            </div>
        </div>
<!----------------------------- МОДАЛЬНОЕ ОКНО --------------------------->
    </div>
</div>
<!-------------- скрипт для расчета стоимости номера ---------------------->
<script>
    function costCalc() {
        const daysCount = document.getElementById('range-input');
        const span = document.getElementById('span');
        const roomPrice = Number('<?php echo $room['price'];?>');
        span.innerHTML = daysCount.value * roomPrice;
}
</script>
<!-------------- скрипт для расчета стоимости номера ---------------------->


