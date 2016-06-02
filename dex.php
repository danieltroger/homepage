<?php
require "base.php";
if(isset($_REQUEST["p"]))
{
  pagel($_REQUEST["p"]);
}
else
{
  pagel($stdpage);
}
?>
<!DOCTYPE html>
<html>
<?php
page();
?>
</html>
