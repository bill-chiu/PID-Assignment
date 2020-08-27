
<html>


<head>
    <meta charset="utf-8">
    <title>PHP如何取得HTML 日曆選擇器的值</title>
</head>
<?php
$date = '';
$date1 = '';
if (isset($_GET['get_date']) && isset($_GET['get_date1'])) {
    $date = $_GET['get_date'];
    $date1 = $_GET['get_date1'];
    echo '起始日期' . $date . '結束日期' . $date1;
}

?>
<body>
<form action="" method="get" class="NoPrint">輸入日期:
    <input type="date" name="get_date"
           value="<?= $date ?>">
    輸入日期:
    <input type="date" name="get_date1"
           value="<?= $date1 ?>">
    <input type="submit" value="送出">


</form>
</body>
</html>