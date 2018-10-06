<h2><?php echo $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('pages/create') ?>

<label for="title">Заголовок</label>
<input type="input" name="title" /><br />

<label for="text">Текст</label>
<textarea name="text"></textarea><br />

<input type="submit" name="submit" value="Создать новую страницу" />

</form>