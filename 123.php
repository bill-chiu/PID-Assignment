<tr>
 <td>
      <?php if ($_SESSION["id"] == "1") { ?>
        
        <a href="report.php" class="btn btn-success btn-sm">報表</a>
        <a href="adminindex.php" class="btn btn-success btn-sm">商品清單</a>
        <a href="add_item.php" class="btn btn-success btn-sm">新增商品</a>
      <?php }  ?>
      <a href="edit.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">修改帳戶資料</a>

    </td>
  </tr>