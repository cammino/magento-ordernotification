<?php
class Cammino_Ordernotification_Model_Observer extends Varien_Object
{
	public function sendNotification(Varien_Event_Observer $observer) {
		try {
			$active = Mage::getStoreConfig("sales_email/ordernotification/active");

			if (intval($active) == 1) {
				$to = Mage::getStoreConfig('sales_email/ordernotification/to');
				$subject = Mage::getStoreConfig('sales_email/ordernotification/subject');
				$body = Mage::getStoreConfig('sales_email/ordernotification/body');
				$fromName = Mage::getStoreConfig('general/store_information/name');
				$fromEmail = Mage::getStoreConfig('trans_email/ident_general/email');
				$toCollection = explode(";", $to);

				$mail = Mage::getModel('core/email');
				$mail->setBody($body); 
				$mail->setSubject($subject);
				$mail->setFromEmail($fromEmail);
				$mail->setFromName($fromName);

				foreach ($toCollection as $to) {
					$mail->setToEmail($to);
					$mail->send();
				}
			}
		} catch(Exception $ex) {}
	}
}
