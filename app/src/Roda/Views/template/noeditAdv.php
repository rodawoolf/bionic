<?=
'<div class="myadvs">
<ul>
<li><a href="/app/?route=setadv&id='.$adv->getId().'">id : '.$adv->getId().' </a></li>
<li><a href="/app/?route=setadv&id='.$adv->getId().'">id пользователя : '.$adv->getUserId().'</a></li> 
<li><a href="/app/?route=setadv&id='.$adv->getId().'">Заголовок : '.$adv->getTitle().'</a></li> 
<li><a href="/app/?route=setadv&id='.$adv->getId().'">Содержание : '.$adv->getContent().'</a></li> 
<li><a href="/app/?route=setadv&id='.$adv->getId().'">Цена : '.$adv->getPrice().'</a></li> 
<li><a href="/app/?route=getimg&id='.$adv->getImgId().'">ssssssss</a></li> 
</ul>
</div>'
 ?>