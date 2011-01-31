{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version   GIT: $Id$
 * @link      http://www.litecommerce.com/
 * @since     3.0.0
 *}
<html>
<head><title>Partner Sign up notification</title></head>
<body>
<p>Dear {profile.login}!

<p>Your request for partner signup has been sent to the shop administrator.

<p align="left">Your profile:

<p align="left">
<table border="0" cellspacing="0" cellpadding="2">

<!-- ********************** BILLING ADDRESS *************************** -->

<tr>
    <td colspan="2"><b>Billing information</b><br><hr size="1" noshade></td>
</tr>
<tr>
    <td align="right">Title:</td>
    <td>{profile.billing_address.title}</td>
</tr>
<tr>
    <td align="right">First Name:</td>
    <td>{profile.billing_address.firstname}</td>
</tr>
<tr>
    <td align="right">Last Name:</td>
    <td>{profile.billing_address.lastname}</td>
</tr>
<tr>
    <td align="right">Phone:</td>
    <td>{profile.billing_address.phone}</td>    
</tr>
<tr>
    <td align="right">Fax:</td>
    <td>{profile.billing_address.fax}</td>
</tr>
<tr>
    <td align="right">Address:</td>
    <td>{profile.billing_address.street}</td>
</tr>
<tr>
    <td align="right">City:</td>
    <td>{profile.billing_address.city}</td>
</tr>
<tr>
    <td align="right">State:</td>
    <td>{profile.billing_address.state.state}</td>
</tr>
<tr>
    <td align="right">Country:</td>
    <td>{profile.billing_address.country.country}</td>
</tr>
<tr>
    <td align="right">Zip code:</td>
    <td>{profile.billing_address.zipcode}</td>
</tr>

<tr>
    <td colspan="2">&nbsp;</td>
</tr>

</table>

<p>{signature:h}
</body>
</html>
