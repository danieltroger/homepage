<?php
ob_start();
$stdpage = "Startpage";
$ua = $_SERVER["HTTP_USER_AGENT"];
$dr = $_SERVER["DOCUMENT_ROOT"] . "/";
include $dr  . "fb/fb.php";
$gl = $_GET['lang'];
$lang = !isset($gl) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : $gl;
switch ($lang){
  case "de":
  loi("de");
  break;
  case "sv":
  loi("sv");
  break;
  default:
  loi("en");
  break;
}
function jsinclude($url)
{
  FB::log("included js includes/$url");
  return "<script src=\"includes/$url\"></script>";
}
function cssinclude($url)
{
  FB::log("included css includes/$url");
  return "<link rel=\"stylesheet\" href=\"includes/$url\" />";
}
function mime($file)
{
    FB::log("file: {$file}");
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime =  finfo_file($finfo, $file);
  finfo_close($finfo);
  FB::log("mime: {$mime}");
  return $mime;
}
function dataurl($file)
{
  if(!is_dir("cache"))
  {
    mkdir("cache");
  }
  $md5 = md5($file);
  if(file_exists("cache/$md5"))
  {
    FB::log("got $md5 ($file) from cache");
    $b64 = bzdecompress(file_get_contents("cache/$md5"));
  }
  else
  {
    $b64 = "data:" . mime($file) . ";base64," . base64_encode(file_get_contents($file));
    file_put_contents("cache/$md5",bzcompress($b64));
    FB::log("encoded $md5 ($file) and cached");
  }
  return $b64;
}
function pagel($f)
{
  include "pages/". $f . ".page";
  FB::info("Loaded page from pages/$f.page");
}
function bsheets()
{
  foreach(glob("sheets/*.body") as $sheet)
  {
    FB::log("Loading: ".$sheet);
    include $sheet;
  }
}
function hsheets()
{
  foreach(glob("sheets/*.head") as $sheet)
  {
    FB::log("Loading: ".$sheet);
    include $sheet;
  }
}
function loi($lang)
{
  include "localizations/$lang";
  FB::log("Loaded translations for $lang");
}
?>
