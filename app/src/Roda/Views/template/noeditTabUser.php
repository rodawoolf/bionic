

<div class="user">
 <table border="1">
  <caption>Пользователи</caption>
  <tr>
   <th>id</th>
   <th>Ник</th>
   <th>Имя</th>
   <th>e-mail</th>
  </tr>

  <tbody>
   <?php if (!empty($user)) : ?>

   <?php foreach ($user as $val) : ?>
     <tr>
     <td><?= $val->getId(); ?></td>
     <td><?= $val->getNic(); ?></td>
     <td><a href="/app/?route=setuser&id=<?= $val->getId(); ?>"><?= ($val->getSurname()).' '.($val->getName()).' '.($val->getMiddlename()); ?> </a></td>
     <td><?= $val->getEmail(); ?></td>
     </tr>
   <?php endforeach ?>

   <?php endif; ?>

  </tbody>
  </table>
 </div>