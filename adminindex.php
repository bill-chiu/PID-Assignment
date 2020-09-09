<?php

session_start();
require("connDB.php");


$id = $_SESSION['id'];
if (isset($_POST["btnSearch"])) {
    $itemname = $_POST["txtItemname"];
    $species = $_POST["txtSpecies"];
    $sql = <<<multi
  select * from itemlists 
  WHERE `itemname` LIKE '%$itemname%' and species LIKE '%$species%'
  multi;
    $result = mysqli_query($link, $sql);
} else {
    if (isset($_POST["btnOK"])) {
        $discount = $_POST["txtdiscount"];
        $remaining = $_POST["txtremaining"];
        $itemprice = $_POST["txtprice"];
        if($discount>100 || $discount<1){   
            echo "<script>alert('請輸入1-100之間的數字')</script>";
            $sql ="select * from itemlists";
            $result = mysqli_query($link, $sql);}
        else if($itemprice<1){
            echo "<script>alert('請輸入大於0的數字')</script>";
            $sql ="select * from itemlists";
            $result = mysqli_query($link, $sql);
        
        }else{

        $currentprice = ceil($itemprice * $discount * 0.01);
        //抓到物品編號
        $itemid = $_POST["btn444"];
        //修改物品價格
        $sql = <<<multi
  UPDATE `itemlists`  SET
  `itemprice` = '$itemprice' ,
  `remaining` = '$remaining' ,
  `discount`= '$discount',
  `currentprice`='$currentprice'
  WHERE `itemlists`.`itemID` = $itemid
multi;
        $result = mysqli_query($link, $sql);
        $sql = "select * from itemlists";
        $result = mysqli_query($link, $sql);}
    } else {
        //顯示物品清單

        $sql = <<<multi
  select * from itemlists 
  multi;
        $result = mysqli_query($link, $sql);
    }
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Lag - Member Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="mycss.css">
</head>

<body>
    <header>
        <div class="navbar navbar-dark bg-danger shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <strong>細菌的商城</strong>
                </a>
                <div>
                    <?php if ($_SESSION["login_session"] == false) { ?>
                        <a href="add.php" class="btn btn-warning  btn-sm">註冊帳號</a>
                        <a href="login.php" class="btn btn-info   btn-sm">登入帳號</a>

                    <?php } else { ?>

                        <a><?= $_SESSION["user"] ?>您好</a>
                        <a><img src="account_image/<?= $_SESSION['account'] ?>.png" width="40" height="40"></a>

                        <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
                        <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>

                    <?php } ?>



                </div>
    </header>
    <div class="py-5 ">
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <form id="form1" name="form1" method="post">

                <tr>
                    <td align="center">
                        <h4>快速查詢商品</h4>
                    </td>
                    <td align="center">商品類別 </td>
                    <td align="center">
                        <select id="txtSpecies" name="txtSpecies" class="custom-select">
                            <option value="">全部</option>
                            <option value="eat">eat</option>
                            <option value="book">book</option>
                            <option value="toy">toy</option>
                            <option value="wear">wear</option>
                        </select>
                    </td>

                    <td align="right"><input type="text" name="txtItemname" id="txtItemname" placeholder="請輸入產品名稱" /></td>
                    <td align="left"> <input type="submit" name="btnSearch" id="btnSearch" value="查詢" class="btn btn-danger btn-sm" /></td>
                </tr>
            </form>
            <tr>
                <td align="left" bgcolor="#CCCCCC" colspan="6">
                    <font color="#FFFFFF">商品清單</font>
                </td>

            </tr>
        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2" id="shopcar">
            <tr bgcolor="#ddd">

                <td align="center"><b>商品名稱</b></td>
                <td align="center"><b>商品預覽</b></td>
                <td align="center"><b>種類</b></td>
                <td align="center"><b>價格</b></td>
                <td align="center"><b>折扣</b></td>
                <td align="center"><b>庫存</b></td>
                <td align="center"><b>操作</b></td>


            </tr>


            <tr>


            <tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>


                    <form id="form1" name="form1" method="post">
                        <td align="center" id="shopcar3"><?= $row["itemname"] ?></td>
                        <td align="center"> <a><img src="item_image/<?= $row["itemname"] ?>.png" width="100" height="100"></a></td>
                        <td align="center" id="shopcar1"><?= $row["species"] ?></td>
                        <td align="center" id="shopcar1"> <input type="number" name="txtprice" id="txtprice" onkeyup="value=value.replace(/[^\d]/g,'') " value="<?= $row["itemprice"] ?>" required /></td>
                        <td align="center" id="shopcar1"> <input type="number" name="txtdiscount" id="txtdiscount" placeholder="1-100" onkeyup="value=value.replace(/[^\d]/g,'') " value="<?= $row["discount"] ?>" required /></td>
                        <td align="center" id="shopcar1"> <input type="number" name="txtremaining" id="txtremaining" onkeyup="value=value.replace(/[^\d]/g,'') " value="<?= $row["remaining"] ?>" required /></td>

                        <td align="center" id="shopcar1">
                            <input type="submit" name="btnOK" id="btnOK" value="修改" class="btn btn-danger btn-sm" />
                            <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["itemID"] ?>" />
                            <a href="delete_item.php?id=<?= $row["itemID"] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </form>
            </tr>

        <?php  } ?>

        </table>

        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="left" bgcolor="#CCCCCC">

                    <a href="index.php" class="btn btn-danger  btn-sm">回首頁</a>

                </td>

            </tr>
        </table>

        </form>
</body>
<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>

    </div>
</footer>

</html>