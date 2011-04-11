{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version   GIT: $Id$
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}

{* :TODO: divide into parts *}
{* :TODO: remove any modes *}

<div class="top-controls">

  <div class="form-panel addons-search-panel">

    {* :TODO: make the form as a widget *}
    <form action="admin.php" method="post" name="search_form" >
      <input type="hidden" name="target" value="addons_list" />
      <input type="hidden" name="action" value="search" />
        <input class="{if:mode=#featured#|!getCondition(#substring#)}default-value{end:}" id="search_substring" type="text" name="substring" value="{if:mode=#search#&getCondition(#substring#)}{getCondition(#substring#)}{else:}{t(#Enter keywords#)}{end:}" />
        <widget class="\XLite\View\Button\Submit" label="{t(#Search#)}" />
        {* :TODO: move to CSS of course *}
        <div class="tags" style="float: right; border: 1px solid #000;">{t(#Tags#)}</div>
    </form>

{* :TODO: move it into a JS file *}
<script type="text/javascript">
var default_substring = '{t(#Enter keywords#)}';
var sObj = jQuery('#search_substring');
var sForm = jQuery('form[name=search_form]');
sObj.blur(function(e){
<!--
  if (jQuery(this).val() == '') {
    jQuery(this).addClass('default-value').val(default_substring);
  }
});
sObj.focus(function(e){
  if (jQuery(this).val() == default_substring) {
    jQuery(this).val('').removeClass('default-value');  
  }
});
sForm.submit(function(e){
  if (sObj.val() == default_substring)
    sObj.val('');
})
-->
</script>

  </div>

  <div class="action-buttons">
    <widget class="\XLite\View\Button\UploadAddons" />
    <widget class="\XLite\View\Button\EnterLicenseKey" />
  </div>

</div>

<div class="clear"></div>

{* Display add-ons list *}
<widget class="\XLite\View\ItemsList\Module\Install" />

<div class="compatibility-note">
  <p>These modules are suitable for the current LiteCommerce version only!</p>
  <p>To see the list of all available modules, go to <a href="{getMarketPlaceURL()}">LC Marketplace</a></p>
</div>
