<?php ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ua" lang="ua" dir="">
<!-- Head -->
<head>
    <link href="src/Roda/Template/css/template.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
   
</head>

<body>

<header class="header">
    <?php echo 'head'; ?>
    <?php echo  \Roda\Controllers\MainController::UserInfo(); ?>
</header>

<!-- Body -->
<div class="body">
    <div>
        <ul class="nav menunav menu nav-pills">
            <li><a href="/app/?route=user">Пользователи</a></li>
            <li><a href="/app/?route=adv">Объявления</a></li>
            <li><a href="/app/?route=comment">Комментарии</a></li>
        </ul>
    </div>
    <div class="clr"></div>
    <div class="container">
    <hr />
    {::menu}
    <hr />
    {::body}
    </div>
</div>

<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <hr />

        <p class="pull-right">
            <a href="#top" id="back-top">
                <?php echo 'footer'; ?>
            </a>
        </p>
        <p>
             <?php echo date('Y'); ?> <?php echo ' roda'; ?>
        </p>
    </div>
</footer>
</body>
</html>
