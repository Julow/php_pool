<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   members_only.php                                   :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jaguillo <jaguillo@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2016/04/07 19:38:07 by jaguillo          #+#    #+#             //
//   Updated: 2016/04/07 19:55:56 by jaguillo         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

if ($_SERVER["PHP_AUTH_USER"] == "zaz" && $_SERVER["PHP_AUTH_PW"] == "jaimelespetitsponeys")
{

?>
<html><body>
Bonjour Zaz<br />
<img src='data:image/png;base64,<?php echo base64_encode(file_get_contents("../img/42.png")); ?>'>
</body></html>
<?php

}
else
{

header("HTTP/1.0 401 Unauthorized");
header("WWW-Authenticate: Basic realm=''Espace membres''");

?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php

}

?>
