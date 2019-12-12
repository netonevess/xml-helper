<?php
require_once ("../src/XMLHelper.php");


echo "##Start a new XML DOM\n";
$config = [
	"version"		=> "1.0", // xml version
	"charset"		=> "UTF-8",// xml charset
	"autoInsertTag"	=> true, // method "tag" inset the created element to dom
	"returnElement"	=> false, // choice return element or class to work with separeted elements
	"beautify"		=> false
];
$xh = new XMLHelper($config);
$xh->printDOM();

echo "\n##Creating tags\n";
$xh = new XMLHelper();
$xh->tag("foo","bar")->printDOM();

echo "\n##Create tag with character data (CDATA, read https://en.wikipedia.org/wiki/CDATA for more information)\n";
$html_string = "<bar>testing...</bar>";
$xh = new XMLHelper();
$xh->tag("foo",$html_string,true)->printDOM();

echo "\n##Tags with attributes\n";
$xh = new XMLHelper();
$xh->tag("foo","bar",false,["id"=>"123"])->printDOM();


