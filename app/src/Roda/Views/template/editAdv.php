
<?php
    use Roda\Models\Repository;
    $advs = Repository\Adv::getAll();
?>

<form enctype="multipart/form-data" method="post" title="Редактирование/Добавление объявлений" id="editForm" >
    <p>ID: "<?= $adv->getId() ?>" </p>
    <p><select name="advId" onchange="$('#editForm').submit();">
<?php
foreach ($advs as $val){
?>
    <option value=<?= $val->getId() ?> <?= $val->getId()==$_POST['advId']?'selected':''?>><?= $val->getTitle()?>(<?= $val->getUserId()?>)</option>
<?php
}
?>
   </select></p>
    <p>id пользователя: <input type="text" name="user_id" value="<?= $adv->getUserId() ?>"/></p>
    <p>Заголовок: <input type="text" name="title" value="<?= $adv->getTitle() ?>"/></p>
    <p>Содержание: <input type="text" name="content" value="<?= $adv->getContent() ?>"/></p>
    <p>Цена: <input type="text" name="price" value="<?= $adv->getPrice() ?>"/></p>
    <p>Добавить <input id="confirm" type="checkbox" name="confirm"/></p>
    <p>Редактировать <input  id="edit" type="checkbox" name="edit"/></p>
    <p>Отправить этот файл: <input name="userfile[]" type="file" /></p>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <p><input type="submit" /></p>
</form>

