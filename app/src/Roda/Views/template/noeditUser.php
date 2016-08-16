<?=
'<div class="user" o>
<ul>
<li><a href="/app/?route=setuser&id='.$user->getId().'">id : '.$user->getId().' </a></li>
<li><a href="/app/?route=setuser&id='.$user->getId().'">Ник : '.$user->getNic().'</a></li> 
<li><a href="/app/?route=setuser&id='.$user->getId().'">Имя : '.$user->getName().'</a></li> 
<li><a href="/app/?route=setuser&id='.$user->getId().'">Отчество : '.$user->getMiddlename().'</a></li> 
<li><a href="/app/?route=setuser&id='.$user->getId().'">Фамилия : '.$user->getSurname().'</a></li> 
<li><a href="/app/?route=setuser&id='.$user->getId().'">e-mail : '.$user->getEmail().'</a></li>
</ul>
</div>'
 ?>