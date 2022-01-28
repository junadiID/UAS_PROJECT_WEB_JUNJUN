<?php
function tanggal_indo($tanggal)
{
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function filter($data){

$filter = stripslashes(strip_tags(htmlspecialchars(htmlentities($data,ENT_QUOTES))));

return $filter;

}

function acak($length) {
	$str = "";
	$karakter = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function acak_nomor($length) {
	$str = "";
	$karakter = array_merge(range('0','9'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'w' => 'Minggu',
        'd' => 'Hari',
        'h' => 'Jam',
        'i' => 'Menit',
        's' => 'Detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' Yang Lalu' : 'Baru Saja';
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } elseif (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function validate_date($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

function infojson($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);
                return $data;
}

function Show($tabel, $limit) {
        global $conn;
        $CallData = mysqli_query($conn, "SELECT * FROM ".$tabel." WHERE ".$limit);
        $ThisData = mysqli_fetch_assoc($CallData);
        return $ThisData;
}

function followers_count($data){
    $id = file_get_contents("https://instagram.com/web/search/topsearch/?query=".$data);
    $id = json_decode($id, true);
    $count = $id['users'][0]['user']['follower_count'];
    return $count;
}

function likes_count($data){
    $id = file_get_contents("".$data."?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['edge_media_preview_like']['count'];
    return $count;
}

function views_count($data){
    $id = file_get_contents("".$data."?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['video_view_count'];
    return $count;
}

function daftar($data) {
    global $conn;

    $nama = $conn->real_escape_string(filter(trim($data['nama'])));
    $email = $conn->real_escape_string(filter(trim($data['email'])));
    $username = filter($data['username']);
    $password = $conn->real_escape_string(trim($data['password']));
    $password2 = $conn->real_escape_string(trim($data['password2']));

    $cek_nama = $conn->query("SELECT * FROM users WHERE nama = '$nama'");
    $cek_username = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $cek_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if (!$nama || !$email || !$username || !$password) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Email <br /> - Username <br /> - Password <br /> - Konfirmasi Password.');
    return false;
    } else if ($cek_username->num_rows > 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username <strong>'.$username.' </strong> Sudah Terdaftar'); 
    return false;
    } else if ($cek_email->num_rows > 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Email <strong> '.$email.' </strong> Sudah Terdaftar'); 
    return false;
    } else if ($cek_nama->num_rows > 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Nama <strong> '.$nama.' </strong> Sudah Terdaftar');         
    return false;   
    } elseif (strlen($username) < 4) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username Minimal 4 Karakter');
    return false;
    } elseif (strlen($password) < 4) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Minimal 4 Karakter');
    return false;
    } else if ($password <> $password2){
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Konfirmasi Password Baru Tidak Sesuai');
        return false;
    } 

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $api_key =  acak(32);
    $terdaftar = "$date $time";

    $conn->query("INSERT INTO users VALUES ('', '$nama', '$email', '$username', '$hash_pass', '0', '0', 'Member', 'Aktif', '$api_key', 'Pendaftaran Gratis', '$terdaftar', '0','')");
    return mysqli_affected_rows($conn);
}
function lupa_password($data) {
    global $conn;

    $username = $conn->real_escape_string(filter(trim($data['username'])));

    $cek_username = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $user = $cek_username->fetch_assoc();
    if (!$username) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Username');
    return false;
    } else if ($cek_username->num_rows == 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username <strong>'.$username.' </strong> Tidak Di Temukan'); 
    return false;
    } 

    $acakin_password = acak(10).acak_nomor(10);
    $hash_pass = password_hash($acakin_password, PASSWORD_DEFAULT);
    $tujuan = $user['email'];
    $pesannya = "
                 <center><p>Hai ".$user['username']."</p></center>
                 <p>Anda telah melakukan permohonan reset password untuk akun ".$user['email']."</p>     
                 <p>Untuk melakukan reset ulang password anda,
                 <br />silahkan salin KODE Unik dibawah ini,
                 <br /><br /><b>$acakin_password</b><br /> 
                 <br />untuk password sementara dan anda bisa mengubah password di website.
                 <br /> ".'<a href="https://grace-panel.com/auth/login" class="btn-loading">'." https://grace-panel.com/auth/login </a>
                 </p>
                 <br />
                 <br />                                 
                ";
    $subjek = "Reset Password";
    $header = "From:Grace-Panel cs@grace-panel.com \r\n";
    $header .= "Cc:cs@grace-panel.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $send = mail ($tujuan, $subjek, $pesannya, $header);
    $conn->query("UPDATE users SET password = '$hash_pass', random_kode = '$acakin_password' WHERE username = '$username'");
    return mysqli_affected_rows($conn);
}