<div>Select the type of input:</div>
<form action="<?php echo url_for("@logins") ?>" id="logins" method="post">
    <select name="type_login" id="type_login">
        <option value="google">Google</option>
        <option value="twitter">Twitter</option>
        <option value="facebook">Facebook</option>
    </select>
    <input type="submit" value="Login" />
</form>
