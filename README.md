# XML Helper Class

![](https://img.shields.io/badge/php-v5.6+-474A8A)

It was created to help with development of xml files. Usualy, create a simple xml demands a longs php codes, but, no more!
You can adapt this class to get it into a PHP Framework as I did with codeigniter in some projects.

## Requirements
- PHP 5.6+

## Preparation
It doesn't needs dependencies besides php minimun required version to run installed on device, so, clone this repository.
```terminal
git clone git@github.com:netonevess/xml-helper.git
```
Then insert it class into your code, using a code like this:
```php
require_once ("../src/XMLHelper.php");
```
## Usage
It's easy to start coding:
```php
$xh = new XMLHelper();
$xh->printDOM(); ```
```xml
<?xml version="1.0" encoding="UTF-8"?>
```
### Create tags
```php
$config = [
	"version"		=> "1.0", // xml version
	"charset"		=> "UTF-8",// xml charset
	"autoInsertTag"	=> true, // method "tag" inset the created element to dom. Take a look of usage
	"returnElement"	=> false, // choice return element or class to continue working
	"beautify"		=> false
];
$xh = new XMLHelper($config);
$xh->tag("foo","bar")->printDOM();
```
```xml
<?xml version="1.0" encoding="UTF-8"?>
<foo>bar</foo>
```


### Create tags with character data (CDATA)
Create tag with character data (CDATA, read more in [https://en.wikipedia.org/wiki/CDATA][CDATA sections in XML] for more information).
```php
$html_string = "<bar>testing...</bar>";
$xh = new XMLHelper();
$xh->tag("foo",$html_string,true)->printDOM();
```
```xml
<?xml version="1.0" encoding="UTF-8"?>
<foo><![CDATA[<bar>testing...</bar>]]></foo>
```


### Create tags with attributes
```php
$xh = new XMLHelper();
$xh->tag("foo","bar",false,["id"=>"123"])->printDOM();
```
```xml
<?xml version="1.0" encoding="UTF-8"?>
<foo id="123">bar</foo>
```
### Exemples
Take a look of these ideas for usage of this class.
```php
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
````
```xml
<?xml version="1.0" encoding="UTF-8"?>
<books>
  <book>
    <title>The Art of War</title>
    <author>Sun Tzu</author>
    <description><![CDATA[The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period (roughly 5th century BC).]]></description>
  </book>
  <book>
    <title>The Power Of Your Subconscious</title>
    <author>Joseph Murphy</author>
    <description><![CDATA[God is life, and that is your life now [...] because your life is God's life" "God is a loving father that watches over them" "[...] find happiness by dwelling on the eternal truths of God]]></description>
  </book>
</books>
```
[CDATA sections in XML]: https://en.wikipedia.org/wiki/CDATA "https://en.wikipedia.org/wiki/CDATA"