<?php

session_start();
require("connDB.php");

$date = date("Y-m-d");

$date1 = date("Y-m-d");
$itemname = '';
$txtSpecies = '';


global $detail_total_price;
global $detailID;
$sql = "select * FROM shopdetail where userId=5";
$result = mysqli_query($link, $sql);

//如果有抓取到日期
if (isset($_POST['get_date']) && isset($_POST['get_date1']) && isset($_POST['btnOK']) || isset($_POST['btnDay'])) {

    switch ($_POST['btnDay']) {
        case "日表":
            $date = date("Y-m-d");
            $date1 = date("Y-m-d");
            break;
        case "周表":
            $date = date("Y-m-d", strtotime("- 1 week"));
            $date1 = date("Y-m-d");
            break;
        case "月表":
            $date = date("Y-m-d", strtotime("last month"));
            $date1 = date("Y-m-d");
            break;
        case "年表":
            $date = date("Y-m-d", strtotime("last year"));
            $date1 = date("Y-m-d");
            break;

        default:
            $date = $_POST['get_date'];
            $date1 = $_POST['get_date1'];
    }

    $detail_total_price = 0;

    $itemname = $_POST["txtItemname"];
    $species = $_POST["txtSpecies"];

    //搜尋輸入的項目
    $sql = <<<multi
    SELECT *  FROM `shopdetail` 
    WHERE `itemname` LIKE '%$itemname%' and data BETWEEN '$date' AND '$date1' and species LIKE '%$species%'
    ORDER BY `userId` ASC
  multi;
    $result = mysqli_query($link, $sql);
} else {
    //顯示清單內容
    $sql = <<<multi
SELECT * FROM `shopdetail`  
WHERE data BETWEEN '$date' AND '$date1'
ORDER BY `shopdetail`.`detailID` ASC
multi;
    $result = mysqli_query($link, $sql);
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
            <tr>

                <td align="left" bgcolor="#CCCCCC">
                    <font color="#FFFFFF">商品報表</font>

                </td>
            </tr>
        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC">
            <tr>
                <td align="left" valign="baseline">

                    <a>Ｈello <?= $_SESSION["user"] ?> </a>

                </td>
            </tr>
            <form action="" method="POST" class="NoPrint">

                <tr>
                    <td width="200" align="left" valign="baseline">商品類別

                        <select width="200" class="col-4" id="txtSpecies" name="txtSpecies" class="custom-select">
                            <option value="">全部</option>
                            <option value="eat">eat</option>
                            <option value="bookduck">book</option>
                            <option value="toy">toy</option>
                            <option value="wear">wear</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="baseline">產品名稱<input type="text" name="txtItemname" id="txtItemname" />
                        <input type="submit" name="btnOK" id="btnOK" value="查詢" class="btn btn-success btn-sm" /></td>
                </tr>   

        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC">
            <tr>
                <td>
                    <!-- <form action="" method="get" class="NoPrint"> -->

                    起始日期:<input type="date" name="get_date" value="<?= $date ?>">
                    結束日期:<input type="date" name="get_date1" value="<?= $date1 ?>">
                    <input type="submit" name="btnDay" id="btnDay" value="日表" class="btn btn-success btn-sm" />
                    <input type="submit" name="btnDay" id="btnDay" value="周表" class="btn btn-success btn-sm" />
                    <input type="submit" name="btnDay" id="btnDay" value="月表" class="btn btn-success btn-sm" />
                    <input type="submit" name="btnDay" id="btnDay" value="年表" class="btn btn-success btn-sm" />
                    </form>
                </td>

            </tr>
        </table>

        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>

                <td>項目名稱</td>
                <td>價格</td>
                <td>種類</td>
                <td>數量</td>

                <td>日期</td>
                <td>總價</td>
                <!-- <td>小計</td> -->
            </tr>
            <tr>

                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $totalmoney;
                ?>

                    <?php

                    if ($detailID != $row["detailID"]) { ?>
            </tr>



            <tr>
            <?php   } ?>

            <td><?= $row["itemname"] ?></td>
            <td><?= $row["itemprice"] ?></td>
            <td><?= $row["species"] ?></td>
            <td><?= $row["quantity"] ?></td>
            <td><?= $row["data"] ?></td>
            <td><?= $row["totalprice"] ?></td>
            <?php $detail_total_price += $row["totalprice"];  ?>
            </tr>

        <?php  } ?>

        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr align="right">
                <td><?php echo "小計:" . $detail_total_price; ?></td>



            </tr>
        </table>

        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="left" bgcolor="#CCCCCC">
                    
                    <a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
                </td>

            </tr>
        </table>


</body>

</html>