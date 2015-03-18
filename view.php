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
    <article>
        <h2><?php echo $burger['brg_name'] ?></h2>
        <p><?php echo $burger['brg_resume'] ?></p>
    </article>
    <?php endforeach ?>
    <footer class="footer">
        <a href="https://github.com/bpesquet/OC-MicroCMS">HomeBurger</a> is a minimalistic CMS built as a showcase for modern PHP development.
    </footer>
</body>