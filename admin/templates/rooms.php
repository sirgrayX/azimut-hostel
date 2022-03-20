<?php
	include 'handlers/admin_actions.php';
?>

<!------------------ Страница со списком номеров ----------->
	<div class="rooms-content row">
		<h2>Номерной фонд</h2>
		<!------- Main Content ----------->
		<div class="catalogList col-md-9 col-12">
			<?php foreach ($sql as $room): ?>
				<div class="shopUnit">
					<img src = "<?php echo $room['photo']; ?>" />
					<div class="shopUnitName">
						<?php echo $room['name']; ?>
					</div>
					<div class="shopUnitPrice">
						Цена: <?php echo $room['price'] . ' ₽/сутки'; ?>
					</div>
                    <a href="index.php?page=single&id_room=<?php echo $room['id_room']; ?>" class="shopUnitMore">Подробнее</a>
                </div>
            <?php endforeach; ?>
        </div>

<!--------------- Боковая панель --------------------------------->
		<div class="sidebar col-md-3 col-12">
			<div class="section sort">
				<h4>Найти номера</h4>
				<select onchange="location=value">
					<option value="" selected="true" disabled="disabled">По количеству комнат</option>
					<option value="index.php?page=room_sort&sort_id=1">Однокомнатные</option>
					<option value="index.php?page=room_sort&sort_id=2">Двукомнатные</option>
				</select>

				<select onchange="location=value">
					<option value="" selected="true" disabled="disabled">По цене</option>
					<option value="index.php?page=room_sort&sort_id=3">По возрастанию</option>
					<option value="index.php?page=room_sort&sort_id=4">По убыванию</option>
				</select>
			</div>

			<div class="section category">
				<h4>Категории</h4>
				<ul>
					<li><a href="index.php?page=room_cat&id_cat=0">Все</a></li>
					<?php
						$sql_cat = $link->query("SELECT * FROM `category`");
						foreach($sql_cat as $category):
					?>
					<li><a href="index.php?page=room_cat&id_cat=<?php echo $category['id_category'];?>"><?php echo $category['category'] ?></a></li>
				<?php endforeach?>
				</ul>
			</div>

			<div class="section admin_functions">
				<h4>Действия</h4>
				<ul>
					<li><a><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">Добавить номер</button></a></li>
				</ul>
			</div>
		</div>
		<div class="modal fade" id="addRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить номер в базу данных</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?page=rooms" method="post" id="modal">
                    <div class="modal-body">
                        <fieldset>
                            <div class="red-form-name">
                                <label>Название</label>
                                <input type="text" name="red-form-name"> 
                            </div>

                            <div class="red-form-price">
                                <label>Цена</label>
                                <input type="number" name="red-form-price">
                            </div>

                            <div class="red-form-room-count">
                                <label>Комнаты</label>
                                <input type="number" name="red-form-room_count" min="1" max="2">
                            </div>

                             <div class="red-form-category">
                                <label>Категория</label>
                                <input type="text" name="red-form-category">
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
                        <button type="submit" class="btn btn-primary" name="button-add">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	</div>