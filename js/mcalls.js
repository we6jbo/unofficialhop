// NOTICE: This project including the code below is being hosted at                                  
// https://github.com/we6jbo/unofficialhop

function isInstalled(p)
{
  if (p == '0')
   location.reload();
  $.get("/components/infusions/unofficialhop/functions.php?jscript=yes&get="+p);
  return false;
}
function refreshScreen()
{
  location.reload();
  return false;
}
