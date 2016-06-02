function selectAll()
{
  var e = document.getElementsByTagName('BODY')[0];
  var r = document.createRange();
  r.selectNodeContents(e);
  var st = window.getSelection();
  st.removeAllRanges();
  st.addRange(r);
}

document.oncontextmenu=function (e)
{
  var menu=document.getElementById("menu"), mst=menu.style,d=document,w=window;
  mst.top=e.clientY+(d.all ? d.scrollTop : w.pageYOffset)+"px";
  mst.left=e.clientX+(d.all ? d.scrollLeft : w.pageXOffset)+"px";
  mst.display="";
  if(e.shiftKey)
  {
    return true;
  }
  else
  {
    return false;
  }
};
document.onclick=function (e)
{
  if(!e.button)
  {
    //if(e.target.id!="mbutt")
    //{
    document.getElementById("menu").style.display="none";
    //}
  }
};
