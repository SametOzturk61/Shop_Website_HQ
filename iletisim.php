<?php require("header.php"); ?>
<br>
<?php
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    function validate_phone_number($phone)
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }
    }
?>
<script>
function countChar(val) {
    var len = val.value.length;
    if (len >= 500) {
        val.value = val.value.substring(0, 500);
    } else {
        $('#charNum').text(500 - len + "/500");
    }
};
</script>
<script>
function resetFields(x){
    document.getElementById('adsoyad').value = '';
    document.getElementById('telefon').value = '';
    document.getElementById('email').value = '';
    document.getElementById('konu').value = '';
    document.getElementById('mesaj').value = '';
};
</script>
<div class="container">
    <div style="background-color:#EBEBEB;" class="notification">
        <center>
            <font size=4px><b>İletişim</b></font>
        </center>
    </div>
</div>
<div class="container">
    <div class="notification has-text-centered">
        <div class="level">
            <div class="level-item has-text-centered">
                <div>
                    <b>ADRES</b> : Atikali Mahallesi, Nişanca Caddesi<br> No:17 Posta Kodu:34087<br> İlçe:Fatih
                    İl:İstanbul<br><br>
                    <b>TELEFON</b> : (0532) 470 36 86<br><br>
                    <b>EMAIL</b> : ozcanceyiz@hotmail.com
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3010.04707513389!2d28.943271315719095!3d41.02422602639164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caba18e0250733%3A0xa7dd3b9c23ae94b2!2zw5Z6dMO8cmsgw4dleWl6!5e0!3m2!1str!2str!4v1592941756209!5m2!1str!2str"
                        width="800" height="350" frameborder="0" style="border:0;" allowfullscreen=""
                        aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div style="background-color:#EBEBEB;" class="notification">
        <center>
            <font size=4px><b>Mesaj</b></font>
        </center>
    </div>
</div>
<div class="container">
    <div class="notification">
        <form method="post" action="">
            <div class="field">
                <label class="label">Ad Soyad</label>
                <div class="control">
                    <input class="input" name="adsoyad" type="text" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" name="email" type="email" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Telefon Numarası</label>
                <div class="control">
                    <input class="input" name="telefon" type="tel" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Konu</label>
                <div class="control">
                    <div class="select">
                        <select name="konu" required>
                            <option value="Genel">Genel</option>
                            <option value="Hata Bildirimi">Hata Bildirimi</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Mesaj</label>
                <div class="control">
                    <textarea class="textarea" name="mesaj" maxlength="500" onkeyup="countChar(this)"
                        required></textarea>
                    <div id="charNum">500/500</div>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">Gönder</button>
                </div>
                </form>
                <div class="control">
                    <button class="button is-yellow" onclick="resetFields(this)">İptal</button>
                </div>
            </div>
    </div>
</div>
<?php
if($_POST){
    $adsoyad = htmlspecialchars($_POST['adsoyad']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $konu = htmlspecialchars($_POST['konu']);
    $mesaj = htmlspecialchars($_POST['mesaj']);
    
    if(strlen($adsoyad) == 0 || strlen($email) == 0 || strlen($telefon) == 0 || strlen($konu) == 0 || strlen($mesaj) == 0){
        echo "<script type='text/javascript'>
        Swal.fire({
        icon: 'error',
        title: 'Gönderme Başarısız',
        confirmButtonColor: '#d33',
        text: 'Lütfen boş alan bırakmayın !'
        })
        </script>";
    }else{
        if($konu != "Genel" && $konu != "Hata Bildirimi"){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Gönderme Başarısız',
            confirmButtonColor: '#d33',
            text: 'Konu seçimi hatalı !'
            })
            </script>";
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<script type='text/javascript'>
                Swal.fire({
                icon: 'error',
                title: 'Gönderme Başarısız',
                confirmButtonColor: '#d33',
                text: 'Girdiğiniz email geçerli değil !'
                })
                </script>";
            }else{
                if(!validate_phone_number($telefon)){
                    echo "<script type='text/javascript'>
                    Swal.fire({
                    icon: 'error',
                    title: 'Gönderme Başarısız',
                    confirmButtonColor: '#d33',
                    text: 'Girdiğiniz telefon geçerli değil !'
                    })
                    </script>";
                }else{
                    if(strlen($mesaj) > 500){
                        echo "<script type='text/javascript'>
                        Swal.fire({
                        icon: 'error',
                        title: 'Gönderme Başarısız',
                        confirmButtonColor: '#d33',
                        text: 'Mesajınız 500 karakterden fazla olamaz !'
                        })
                        </script>";
                    }else{
                        $prepare = $connection->prepare("INSERT INTO iletisim SET adsoyad = ?, email = ?, telefon = ?, mesaj = ?, konu = ?, ip = ?");
                        $insert = $prepare->execute(array($adsoyad,$email,$telefon,$mesaj,$konu,getUserIpAddr()));
                        if($insert){
                            echo "<script type='text/javascript'>
                            Swal.fire({
                            icon: 'success',
                            title: 'Gönderme Başarılı',
                            confirmButtonColor: '#32a852',
                            text: 'Mesajınız başarıyla gönderildi !',
                            })
                            </script>";
                        }else{
                            echo "<script type='text/javascript'>
                            Swal.fire({
                            icon: 'error',
                            title: 'Gönderme Başarısız',
                            confirmButtonColor: '#d33',
                            text: 'Lütfen daha sonra tekrar deneyin !'
                            })
                            </script>";
                        }
                    }
                }
            }
        }
    }
}
?>
<br>
<div class="container">
    <div class="notification">
        <center>
            Güvenlik için IP adresi kayıt edilmektedir. (<?php echo getUserIpAddr(); ?>)
        </center>
    </div>
</div>
<?php require("footer.php"); ?>