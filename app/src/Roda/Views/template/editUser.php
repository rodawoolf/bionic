
<?php
    use Roda\Models\Repository;
    $users = Repository\User::getAll();
?>

<form method="post" title="Редактирование/Добавление пользователя" id="editForm" >
    <p>ID: "<?= $user->getId() ?>" </p>
    <p><select name="userId" onchange="$('#editForm').submit();">
<?php
foreach ($users as $val){
?>
    <option value=<?= $val->getId() ?>
    <?php if (!empty($_POST['userId'])) : ?>
        <?= $val->getId()==$_POST['userId']?'selected':''?>
        <?php endif; ?>
    >
        <?= $val->getNic()?>
        (<?= $val->getSurname()?> <?= $val->getName()?> <?= $val->getMiddlename()?>)
    </option>
<?php
}
?>
   </select></p>
    <p>Ваш ник: <input type="text" name="nic" value="<?= $user->getNic() ?>"/></p>
    <p>Имя: <input type="text" name="name" value="<?= $user->getName() ?>"/></p>
    <p>Фамилия: <input type="text" name="surname" value="<?= $user->getSurname() ?>"/></p>
    <p>Отчество: <input type="text" name="middlename" value="<?= $user->getMiddlename() ?>"/></p>
    <p>e-mail: <input type="text" name="email" value="<?= $user->getEmail() ?>"/></p>
    <p>password: <input type="text" name="passwd" /></p>
    <p>Добавить <input id="confirm" type="checkbox" name="confirm"/></p>
    <p>Редактировать <input  id="edit" type="checkbox" name="edit"/></p>
    <p><input type="submit" /></p>
</form>

