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
		</div>
	</div>