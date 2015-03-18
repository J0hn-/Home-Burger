<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link href="homeburger.css" rel="stylesheet" />
    <title>Home Burger - Home</title>
</head>
<body>
    <header>
        <h1>Home Burger</h1>
    </header>
    <?php foreach ($burgers as $burger): ?>
    <burger>
        <h2><?php echo $burger->getName() ?></h2>
        <p><?php echo $burger->getResume() ?></p>
		<img src = '<?php echo $burger->getIMGpath(); ?>'/>
    </burger>
    <?php endforeach ?>
    <footer class="footer">
        <a href="https://www.google.fr/#q=homeburger">HomeBurger</a> is a fucking great idea !
    </footer>
</body>