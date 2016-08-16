
<?php
    use Roda\Models\Repository;
    $comments = Repository\Comment::getAll();
?>

<form method="post" title="Редактирование/Добавление комментария" id="editForm" >
    <p>ID: "<?= $comment->getId() ?>" </p>
    <p><select name="$commentId" onchange="$('#editForm').submit();">
<?php
foreach ($comments as $val){
?>
    <option value=<?= $val->getId() ?> <?= $val->getId()==$_POST['$commentId']?'selected':''?>><?= $val->getId()?>(<?= $val->getText()?>)</option>
<?php
}
?>
   </select></p>
    <p>Комментарий: <input type="text" name="text" value="<?= $comment->getText() ?>"/></p>
    <p>Пользователь: <input type="text" name="name" value="<?= $comment->getUserId() ?>"/></p>
    <p>Объявление: <input type="text" name="surname" value="<?= $comment->getAdvId() ?>"/></p>
    <p>Добавить <input id="confirm" type="checkbox" name="confirm"/></p>
    <p>Редактировать <input  id="edit" type="checkbox" name="edit"/></p>
    <p><input type="submit" /></p>
</form>

