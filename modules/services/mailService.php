<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/dbService.php";

class MailService
{
   private $dbService;
   private $passwordResetEmailSubject;
   private $passwordResetEmailBody;

   function __construct() {
      $this->dbService = new DbService();
   }

   function sendPasswordResetEmail($userId, $email) 
   {
      $this->passwordResetEmailSubject = text("passwordResetEmailSubject");
      $this->passwordResetEmailBody = text("passwordResetEmailBody");
   
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return false;
      }

      // Generate token and link.
      $resetToken = $this->generateToken();

      // Save reset token.
      $this->dbService->saveResetToken($userId, $resetToken);

      // Create password reset link.
      $host = "http://bluesorcerer.epizy.com";
      $passwordResetLink = "{$host}/admin/passwordreset?token=" . $resetToken;

       // update mail text with link and add separator at the end.
      $this->passwordResetEmailBody = str_replace("{{link}}", "<a href=\"".$passwordResetLink."\" />Link</a>", $this->passwordResetEmailBody);
      $this->passwordResetEmailBody = $this->passwordResetEmailBody."<br><br><hr/>";

      $headers  = "Content-type: text/html\r\n";
      $headers .= "From: BlueSorcerer <system@bluesorcerer.com>\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();

      mail($email, $this->passwordResetEmailSubject, $this->passwordResetEmailBody, $headers);

      return true;
   }

   function generateToken()
   {
      if (function_exists('com_create_guid') === true)
      {
         return trim(com_create_guid(), '{}');
      }

      return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
   }
}