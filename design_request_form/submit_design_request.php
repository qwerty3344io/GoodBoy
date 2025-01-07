<?php
// LINE Notify Token
$lineToken = 'YOUR_LINE_NOTIFY_TOKEN_HERE';

// รับข้อมูลจากฟอร์ม
$workType = $_POST['work_type'];
$colorTone = $_POST['color_tone'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$details = $_POST['details'];

// สร้างข้อความที่จะส่ง
$message = "มีคำขอออกแบบกราฟิกใหม่:\n";
$message .= "รูปแบบงาน: $workType\n";
$message .= "โทนสี: $colorTone\n";
$message .= "วันที่เริ่มต้น: $startDate\n";
$message .= "วันที่สิ้นสุด: $endDate\n";
$message .= "รายละเอียด: $details";

// ส่งข้อความไปยัง LINE Notify
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . urlencode($message));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $lineToken",
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

// ส่งข้อความเสร็จแล้ว Redirect กลับไปยังหน้าแรก
header("Location: thank_you.html");
?>
