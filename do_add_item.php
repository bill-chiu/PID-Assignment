<?php

//如果按下確認
if (isset($_POST["btnOK"])) {
  
  //如果都有輸入 把輸入的值post給變數
    if($_POST["txtItemName"]!=""&&$_POST["txtItemPrice"]!=""&&$_POST["txtSpecies"]!=""){
    $itemname=$_POST["txtItemName"];
    $itemprice=$_POST["txtItemPrice"];
    $species=$_POST["txtSpecies"];

    $sql = "SELECT * FROM itemlists WHERE `itemname`='$itemname'";

    // 執行SQL查詢
    require("connDB.php");
    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);

    // 是否有查詢到有相同帳號
    if ($total_records > 0) {
      echo "<script>alert('此產品已被上架')</script>";
      //把值新增到產品名單
    } else {
// 上傳檔案並存入資料庫




    // 檔案上傳並顯示基本資料
    echo "檔案名稱: " . $_FILES['myfile']['name'] . "<br>";
    echo "檔案大小: " . $_FILES['myfile']['size'] . "<br>";
    echo "檔案格式: " . $_FILES['myfile']['type'] . "<br>";
    echo "暫存名稱: " . $_FILES['myfile']['tmp_name'] . "<br>";
    echo "錯誤代碼: " . $_FILES['myfile']['error'] . "<br>";
    
    // 檔案上傳後的偵錯
    if($_FILES['myfile']['error'] >0 ) {
      switch ($_FILES['myfile']['error'] ) {
        case 1:die("檔案大小超出 php.ini:upload_max_filesize 限制 ");
        case 2:die("檔案大小超出 MAX_FILE_SIZE 限制");
        case 3:die("檔案大小僅被部份上傳");
        case 4:die("檔案未被上傳");
      }
    
    }
    
    //複製檔案
    if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
      $DestDIR = "item_image";
      if(!is_dir($DestDIR) || !is_writeable ($DestDIR))
        die("目錄不存在或無法寫入 ");
        
      $File_Extension = explode(".",$_FILES['myfile']['name']);     //取得檔案副檔名，以陣列形式來表示
      $File_Extension = $File_Extension[count($File_Extension)-1];  //確保副檔名一定會在最後的位置，確保副檔名正確  
      $ServerFilename = date("YmdHis") . "." . $File_Extension;     //避免檔案名稱重複而使伺服器上的檔案被覆蓋，以上傳的  年月日時分秒.副檔名  作為檔名
      
      $ServerFilename = $_POST['txtItemName'] .  ".png";  // 自訂檔名  學年度_學號.pdf  ex. 10602_ADT105001.pdf
      
      move_uploaded_file($_FILES['myfile']['tmp_name'], iconv("UTF-8", "UTF-8", $DestDIR . "/" . $ServerFilename)); //將上傳的暫存檔移動到指定目錄
    }
    //把值新增到物品清單
    $sql = <<<multi
    INSERT INTO itemlists (itemname, itemprice,species,remaining) VALUES
    ('$itemname', '$itemprice','$species','0')
    multi;
    echo $sql;
    require("connDB.php");
    mysqli_query($link, $sql);


    header("location:index.php");
    //如果有未輸入
}
}else{
    echo "<script>alert('有欄位未輸入')</script>";
}
}
// //如果按下回首頁
// if (isset($_POST["btnHome"])) {

//     header("Location: index.php");
//     exit();
//   }
?>