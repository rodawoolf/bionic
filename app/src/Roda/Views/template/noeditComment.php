<?=
'<div class="myadvs">
<ul>
<li><a href="/app/?route=setcomment&id='.$comment->getId().'">id : '.$comment->getId().' </a></li>
<li><a href="/app/?route=setcomment&id='.$comment->getId().'">id пользователя : '.$comment->getUserId().'</a></li> 
<li><a href="/app/?route=setcomment&id='.$comment->getId().'">id объявления : '.$comment->getAdvId().'</a></li> 
<li><a href="/app/?route=setcomment&id='.$comment->getId().'">Комментарий : '.$comment->getText().'</a></li> 
</ul>
</div>'
 ?>