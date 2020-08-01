<?php require("header.php"); ?>
<?php $uid = htmlspecialchars($_GET['uid']);
if(!is_numeric($uid)){
header("Location: 404.php");
}else{
    $uidcontrol = $connection->prepare("SELECT * FROM urunler WHERE id=?");
    $uidcontrol->execute(array(htmlspecialchars($uid)));
if($uidcontrol->rowCount() == 0){
    header("Location: 404.php");
}
} ?>
<?php

$find = $connection->prepare("SELECT * FROM urunler WHERE id=?");
$find->execute(array(htmlspecialchars($uid)));
$urun = $find->fetch();

?>
<div class="container">
    <div class="notification">
        <div class="columns">
            <div class="column is-three-fifths"><img width=800px height=800px src="<?php echo $urun["urun_resim"]; ?>"></img></div>
            <div class="column">
                <font size=6px><b><?php echo $urun["urun_isim"]; ?></b></font><br>
                <font color=black><?php echo $urun["urun_marka"]; ?></font><br><br>
                <font size=5px><b><?php echo $urun["urun_fiyat"]; ?></font>
                <font size=4px> TL</font></b><br>
                <?php if($urun["urun_stok"] == 0){ ?>
                    <font size=3px> Stokta Yok !</font></b><br><br>
                <?php }else{ ?>
                    <font size=3px> Son <b><?php echo $urun["urun_stok"]; ?></b> ürün !</font></b><br><br>
                <?php } ?>
                <a href="iletisim.php" class="button is-yellow">
                    Dükkandan Satın Al
                </a>
                <a href="<?php echo $urun["urun_n11"]; ?>" class="button is-yellow">
                    N11'den Satın Al
                </a>
                <hr style="border-top: 1px solid grey;">
                <?php echo $urun["urun_aciklama"]; ?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>