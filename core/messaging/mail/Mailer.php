<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\messaging\mail;

use mateable\core\Platform;

class Mailer {
    private string $from;
    private string $to;
    private string $subject;
    private string $message;
    private array|string $attachments = [];
    private string $pile;
    private string $company_name;
    private string $company_url;

    public function __construct($from, $to, $subject, $message) {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->company_name = $_ENV['NAME'];
        $this->company_url = $_ENV['WEBSITE'];
        $this->pile = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{subject}}</title>
    <style>
        /* Reset CSS */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        /* Container styles */
        .container {
            width: 100%;
            max-width: 600px; /* Adjust as needed */
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        /* Header styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        /* Footer styles */
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .footer p {
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://{{site_url}}/assets/img/mateable_logo.png" alt="{{app_name}} Logo">
            <h2>{{Company_Name}}</h2>
        </div>
        <p>{{message}}</p>
        <div class="footer">
           <p>© 2023-'. date('Y') .' Copyright <a href="{{site_url}}">{{app_name}} LLC</a></p>
        </div>
    </div>
</body>
</html>
';
        $this->pile = str_replace('{{subject}}', $subject, $this->pile);
        $this->pile = str_replace('{{message}}', $message, $this->pile);
        $this->pile = str_replace('{{app_name}}', $this->company_name, $this->pile);
        $this->pile = str_replace('{{site_url}}', $this->company_url, $this->pile);
        $this->message = $this->pile;
    }

    public function addAttachment($filePath, $fileName = null): void
    {
        if ($fileName === null) {
            $fileName = basename($filePath);
        }
        $this->attachments[] = [
            'path' => $filePath,
            'name' => $fileName
        ];
    }

    public function sendEmail(): bool
    {
        $boundary = md5(uniqid(rand(), true));

        $headers = "From: {$this->from}" . "\r\n";
        $headers .= "Reply-To: {$this->from}" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"" . "\r\n";

        $message = "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= $this->message . "\r\n\r\n";

        foreach ($this->attachments as $attachment) {
            $fileContent = file_get_contents($attachment['path']);
            $fileContent = chunk_split(base64_encode($fileContent));

            $message .= "--{$boundary}\r\n";
            $message .= "Content-Type: application/octet-stream; name=\"{$attachment['name']}\"\r\n";
            $message .= "Content-Disposition: attachment; filename=\"{$attachment['name']}\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $message .= $fileContent . "\r\n\r\n";
        }

        $message .= "--{$boundary}--";

        return mail($this->to, $this->subject, $message, $headers);
    }
}
