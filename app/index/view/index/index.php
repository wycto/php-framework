<html>
<head>
    <title>WYCTOPHP</title>
</head>
<body>
<h3>首页</h3>
<?php
dump(count($all));
//dump($all->debugDumpParams());
foreach ($all as $item) {
    dump($item);
}
?>
</body>
</html>
