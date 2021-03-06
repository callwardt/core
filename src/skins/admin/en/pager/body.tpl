{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pager
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}

<ul class="pager grid-list" IF="isPagesListVisible()">
  <li FOREACH="getPages(),page" class="{page.classes}">
    <a IF="page.href" href="{page.href}" class="{page.page}" title="{t(page.title)}">{t(page.text):h}</a>
    <span IF="!page.href" class="{page.page}" title="{t(page.title)}">{t(page.text):h}</span>
  </li>
</ul>

<list name="itemsTotal" type="inherited" />
