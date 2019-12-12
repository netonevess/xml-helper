<?php
require_once ("../src/XMLHelper.php");

echo "\n##Exemples\n";

$config = ["returnElement" => true,"beautify"=>true];
$xh = new XMLHelper($config);
$to_read = $xh->tag("books", [
	$xh->tag("book",[
		$xh->tag("title","The Art of War"),
		$xh->tag("author","Sun Tzu"),
		$xh->tag("description","The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period (roughly 5th century BC).", true),
	]),
	$xh->tag("book",[
		$xh->tag("title","The Power Of Your Subconscious"),
		$xh->tag("author","Joseph Murphy"),
		$xh->tag("description","God is life, and that is your life now [...] because your life is God's life\" \"God is a loving father that watches over them\" \"[...] find happiness by dwelling on the eternal truths of God", true),
	]),
]);
$xh->printDOM();