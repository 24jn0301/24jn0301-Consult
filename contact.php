<?php
// 文字コード設定
mb_internal_encoding("UTF-8");

// POSTチェック
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("不正なアクセスです");
}

// 入力値取得 & 簡易サニタイズ
$name    = trim($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

// 必須チェック
if ($name === "" || $email === "" || $message === "") {
    exit("入力内容に不備があります");
}

// CSVファイル名
$filename = "contact.csv";

// CSVに保存するデータ
$data = [
    date("Y-m-d H:i:s"),
    $name,
    $email,
    str_replace(["\r", "\n"], " ", $message)
];

// ファイルオープン（なければ作成）
$file = fopen($filename, "a");

// CSV書き込み
fputcsv($file, $data);

// ファイルクローズ
fclose($file);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>送信完了</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
  <h1 class="mb-4">送信完了</h1>
  <p>お問い合わせありがとうございました。<br>内容を確認次第、ご連絡いたします。</p>
  <a href="index.html" class="btn btn-dark mt-3">トップへ戻る</a>
</div>

</body>
</html>
