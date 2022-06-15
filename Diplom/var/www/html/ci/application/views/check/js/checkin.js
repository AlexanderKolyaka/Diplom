function runcheckin(idobj, gotohrf)
{
  var v= document.getElementById(idobj).value;
  if (v !== "")
  {
    location.href = gotohrf + "?" + v;
  }
}
