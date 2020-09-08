
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


            <td align="left" bgcolor="#CCCCCC">
                <font color="#FFFFFF">商品目錄</font>
            </td>


            <td align="right" bgcolor="#CCCCCC">
                <?php if ($_SESSION["login_session"] == false) { ?>



                    <a href="add.php" class="btn btn-warning  btn-sm">註冊帳號</a>
                    <a href="login.php" class="btn btn-info   btn-sm">登入帳號</a>

                <?php } else { ?>
                    <a>hello <?= $_SESSION["user"] ?> </a>



                    <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>


                <?php } ?>
            </td>
            </tr>

        </table>
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

            <tr>
                <td colspan="" align="center" bgcolor="#F2F2F2">

                </td>
            </tr>


            <tr>
                <td>項目名稱</td>
                <td></td>
                <td>價格</td>
                <td>種類</td>
                <td>庫存數量</td>

            </tr>


            <tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>


                    <form id="form1" name="form1" method="post">
                        <td><?= $row["itemname"] ?></td>
                        <td> <a><img src="item_image/<?= $row["itemname"] ?>.png" width="100" height="100"></a></td>
                        <td> <input type="text" name="txtprice" id="txtprice" onkeyup="value=value.replace(/[^\d]/g,'') " value="<?= $row["itemprice"] ?>" required /></td>
                        <td><?= $row["species"] ?></td>
                        <td> <input type="text" name="txtremaining" id="txtremaining" onkeyup="value=value.replace(/[^\d]/g,'') " value="<?= $row["remaining"] ?>" required /></td>

                        <td>
                            <input type="submit" name="btnOK" id="btnOK" value="修改" class="btn btn-success btn-sm" />
                            <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["itemID"] ?>" />
                            <a href="delete_item.php?id=<?= $row["itemID"] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </form>
            </tr>

        <?php  } ?>


        </table>



        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <td align="left" bgcolor="#CCCCCC">
                <font color="#CCCCCC"> <a href="admin.php" class="btn btn-primary   btn-sm">回管理資料目錄</a></font>
            </td>
        </table>
</body>

</html>