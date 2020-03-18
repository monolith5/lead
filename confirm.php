<?php
    // フォームのボタンが押されたら
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $name = $_POST["name"];
        $years = $_POST["years"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $yubin = $_POST["yubin"];
        $used = $_POST["used"];
        $using  = $_POST["using"];
    }

    // 送信ボタンが押されたら
    if (isset($_POST["submit"])) {
        // 送信ボタンが押された時に動作する処理をここに記述する

        // 日本語をメールで送る場合のおまじない
            mb_language("ja");
        mb_internal_encoding("UTF-8");

        //mb_send_mail("kanda.it.school.trial@gmail.com", "メール送信テスト", "メール本文");

            // 件名を変数subjectに格納
            $subject = "［自動送信］お申し込み内容の確認";

            // メール本文を変数bodyに格納
        $body = <<< EOM
{$name}　様

お申し込み頂きありがとうございます。
お申し込み内容を確認させて頂き、専任アドバイザーより２４時間以内にご連絡をさせて頂きます。
今しばらくお待ちいただけますようお願い致します。

===================================================
【 お名前 】{$name}
【 年齢 】{$years}
【 メールアドレス 】{$email}
【 電話番号 】{$tel}
【 郵便番号 】{$yubin}
【 補聴器の装用経験がありますか 】{$used}
【 ご使用されるお客様はどなたでしょうか 】{$using}
===================================================

────────────────────────
◇運営会社：株式会社リードインテリジェンス (Lead Intelligence K.K)
◇ URL ：http://lead-web.net/
◇ E-Mail：info@lead-web.net
◇ 本社所在地：東京都港区六本木2-4-9アソルティ六本木1丁目ビル4F
◇ フリーダイヤル：0120-479-074
────────────────────────
EOM;

        // 送信元のメールアドレスを変数fromEmailに格納
        $fromEmail = "ka.mickey15@gmail.com";

        // 送信元の名前を変数fromNameに格納
        $fromName = "お問い合わせテスト";

        // ヘッダ情報を変数headerに格納する
        $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";

        // メール送信を行う
        mb_send_mail($email, $subject, $body, $header);

        // サンクスページに画面遷移させる
        header("Location: http://testapp.hippy.jp/contact/thanks.php");
        exit;
    }
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お申し込みフォーム</title>
<link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div>
    <form action="confirm.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="years" value="<?php echo $years; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
            <input type="hidden" name="yubin" value="<?php echo $yubin; ?>">
            <input type="hidden" name="used" value="<?php echo $used; ?>">
            <input type="hidden" name="using" value="<?php echo $using; ?>">
            <h1 class="contact-title">お申し込み内容確認</h1>
            <p>お申し込み内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $name; ?></p>
                </div>
                <div>
                    <label>年齢</label>
                    <p><?php echo $years; ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $email; ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $tel; ?></p>
                </div>
                <div>
                    <label>郵便番号</label>
                    <p><?php echo $yubin; ?></p>
                </div>
                <div>
                    <label>補聴器の装用経験がありますか</label>
                    <p><?php echo $used; ?></p>
                </div>
                <div>
                    <label>ご使用されるお客様はどなたでしょうか</label>
                    <p><?php echo $using; ?></p>
                </div>
            </div>
        <input type="button" value="内容を修正する" onclick="history.back(-1)">
        <button type="submit" name="submit">送信する</button>
    </form>
</div>
</body>
</html>
