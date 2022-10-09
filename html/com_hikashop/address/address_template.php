<?php
 defined('_JEXEC') or die('Restricted access');
?>
{address_company}
{address_title} {address_firstname} {address_lastname}
{address_country} - {address_state} - {address_city} - {address_street}
<?php echo JText::_('POST_CODE').' '.'{address_post_code}';?>

<?php if(!empty($this->address->address_telephone)) echo JText::sprintf('TELEPHONE_IN_ADDRESS','{address_telephone}');?>
<?php if(!empty($this->address->address_telephone2)) echo '<br/>'.JText::_('MOBILE_IN_ADDRESS').' '.'{address_telephone2}';?>

<?php if(!empty($this->address->address_vat)) echo JText::sprintf('VAT_IN_ADDRESS','{address_vat}'); ?>