{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Moneybookers settings
 *  
 * @author    Creative Development LLC <info@cdev.ru> 
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}

<p class="mb-register-note">{t(#To have access to the International payment network of Moneybookers please register here for a free account if you dont't have one yet.#,_ARRAY_(#url#^getRegisterURL())):h}</p>

<form action="admin.php" method="post" class="mb-activation">
  <input type="hidden" name="target" value="{target}" />
  <input type="hidden" name="action" value="activate" />

  <ul>

    <li class="mb-email">
      <label for="mb_email">{t(#Email address of your Moneybookers account#)}:</label>
      <input type="text" id="mb_email" name="email" value="{config.CDev.Moneybookers.email}"/>
      <button type="submit">{t(#Validate Email#)}</button>
    </li>

    <li class="mb-id">
      <label for="mb_id">{t(#Moneybookers Customer ID#)}:</label>
      <input type="text" id="mb_id" name="id" value="{config.CDev.Moneybookers.id}" />
    </li>

  </ul>

  <div class="buttons">
    <button type="submit">{t(#Activate Moneybookers Quick Checkout#)}</button>
  </div>

  <p class="mb-activation-note">{t(#Moneybookers Quick Checkout enables you to take direct payment from credit cards, debit cards and over 60 other local payment options in over 200 countries as well as the Moneybookers eWallet.#):h}</p>

</form>

{if:config.CDev.Moneybookers.email}
<hr />

<form action="admin.php" method="post" class="mb-secret-word">
  <input type="hidden" name="target" value="{target}" />
  <input type="hidden" name="action" value="validateSecretWord" />

  <p class="mb-secret-word-note">{t(#After activation Moneybookers will give you access to a new section in your Moneybookers account called "Merchant tools". Please choose a secret word (do not use your password for this) and enter it into the merchant tools section and below.#)}</p>

  <ul>

    <li>
      <label for="mb_word">{t(#Secret Word#)}:</label>
      <input type="password" id="mb_word" name="secret_word" value="{config.CDev.Moneybookers.secret_word}" />
      <button type="submit">{t(#Validate Secret Word#)}</button>
    </li>

  </ul>

</form>
{end:}

<hr />

<p class="mb-support-note">
  <div>{t(#Support#)}:</div>
  <div>{t(#Do you have questions?#)}</div>
  <div>{t(#Contact Moneybookers on ecommerce@moneybookers.com or by phone +44 (0) 870 383 0762#):h}</div>
</p>