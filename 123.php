<tr>

<td align="left" bgcolor="#CCCCCC">
  <font color="#FFFFFF">會員系統 － 管理員專用</font>
<td bgcolor="#CCCCCC"></td>
<td bgcolor="#CCCCCC"></td>
<td bgcolor="#CCCCCC"></td>
<td bgcolor="#CCCCCC"></td>
</td>

</tr>
<tr>

<td align="left" valign="baseline">
  <a>hello <?= $_SESSION["user"] ?> </a>
</td>

</tr>

<tr>
<td>用戶名稱</td>
<td>用戶手機</td>
<td>用戶帳號</td>

</tr>


<tr>
<?php if ($_SESSION["id"] == "1") { ?>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <td><?= $row["username"] ?></td>
    <td><?= $row["userphone"] ?></td>
    <td><?= $row["account"] ?></td>



    <td>

      <a href="see_checkout.php?id=<?= $row["userId"] ?>" class="btn btn-info btn-sm">查看購買清單</a>
      <?php if ($row["black"] == 0) { ?>
        <a href="change_black.php?id=<?= $row["userId"] ?>" class="btn btn-danger btn-sm">加入黑名單</a>
      <?php } else { ?>
        <a href="change_black.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">取消黑名單</a>
      <?php } ?>

    </td>
</tr>
<?php  } ?>
<?php }  ?>


<tr bgcolor="#CCCCCC">
<?php if ($num > 5) { ?>
<td><input type="submit" name="btnDown" id="btnDown" value="上一頁" /></td>
<?php } else { ?>
<td></td>
<?php } ?>
<?php if ($maxpreson - 5 > $num) { ?>
<td><input type="submit" name="btnUP" id="btnUP" value="下一頁" /></td>
<?php } else { ?>
<td></td>
<?php } ?>
<td align="left" bgcolor="#CCCCCC"><a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
</td>
<td bgcolor="#CCCCCC"></td>