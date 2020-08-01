<?php require("header.php"); ?>
<?php

$queryforurunler = $connection->prepare('SELECT * FROM urunler');
$queryforurunler->execute();
$urunler = $queryforurunler->fetchAll(PDO::FETCH_OBJ);

?>
<br>
<div class="columns">
    <div class="column is-narrow">
        <div class="box" style="width: 255px;">
            <font size=5px><b>Ürünler</b></font><br>
            Toplam Ürün : <?php echo $queryforurunler->rowCount(); ?>
            <hr>
            <font size=5px><b>Kategoriler</b></font><br><br>
            <form method="get" action="">
                <label class="checkbox">
                    <input type="checkbox">
                    Çaydanlık
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Nevresim Takımı
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Bornoz Takımı
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Havlu Takımı
                </label><br>
                <label class="checkbox">
                    <input type="checkbox">
                    Tencereler
                </label>
                <hr>
                <font size=5px><b>Markalar</b></font><br><br>
                <label class="checkbox">
                    <input type="checkbox">
                    Taç
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Soley
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Arçelik
                </label><br>

                <label class="checkbox">
                    <input type="checkbox">
                    Arzum
                </label><br>
                <label class="checkbox">
                    <input type="checkbox">
                    Fakir
                </label>
                <hr>
                <font size=5px><b>Fiyat Aralığı</b></font><br><br>
                <input class="input" type="text" placeholder="En Az">
                <input class="input" type="text" placeholder="En Fazla">
                <hr>
                <button type="submit" class="button">Ara</button>
            </form>
        </div>
    </div>
    <div class="column is-narrow">
        <div class="box" style="width: 1345px;">
            <div class="columns is-multiline is-mobile">
                <?php foreach($urunler as $urun): ?>
                <div class="column is-one-quarter">
                    <a href="urun.php?uid=<?php echo $urun->id; ?>">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img style="  width: auto !important; height: auto !important; max-width: 100%;"
                                        src="<?php echo $urun->urun_resim; ?>">
                                </figure>
                            </div><br>
                            <div style="outline: 1px solid #ededed;" class="urunismi">
                                <center><?php echo $urun->urun_isim; ?><br>
                                    <small><?php echo $urun->urun_marka; ?></small>
                                </center>
                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item">
                                    Fiyat:
                                    <?php echo $urun->urun_fiyat; ?>TL&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;
                                    Stok: <b>
                                        <?php if($urun->urun_stok == 0){ ?>
                                        <font color=red> Yok</font>
                                        <?php }else{ ?>
                                        <font color=green> Var</font>
                                        <?php } ?>
                                    </b>
                                </p>
                            </footer>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>