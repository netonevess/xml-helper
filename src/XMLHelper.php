<?php
class XMLHelper{

    private $RETURNELEMENT;
    private $AUTOINSERT;
    private $dom; // DOM ELEMENT
    private $xml; // XML SORCE

    public $config;
    public $lastCreatedElement;

    public function __construct($config = []){
        $this->config = $config;
        $version = !array_key_exists('version', $this->config)?"1.0":$this->config['version'];
        $charset = !array_key_exists('charset', $this->config)?"UTF-8":$this->config['charset'];
        $this->RETURNELEMENT = array_key_exists("returnElement",$config)?$config["returnElement"]:FALSE;
        $this->AUTOINSERT = array_key_exists("autoInsertTag",$config)?$config["autoInsertTag"]:TRUE;

        $this->dom = new DOMDocument($version,$charset);

        $beautify = !array_key_exists('beautify', $this->config)?false:$this->config['beautify'];
        if($beautify){
            $this->dom->preserveWhiteSpace = false;
            $this->dom->formatOutput = true;
        }
    }

    /*
    *   Tools to create
    *
    */
    public function tag($element,$value,$cdata=FALSE,$attr=array()){
        $dom = $this->dom;
        if(!$cdata){
            if(!is_array($value)){
                $element=$dom->createElement($element,$value);
            }else{
                $element=$dom->createElement($element);
                foreach ($value as $v)
                    $element->appendChild($v);
            }
        }else{
            $element=$dom->createElement($element);
            $element->appendChild($dom->createCDATASection($value));
        }
        if(!empty($attr))
            foreach ($attr as $key => $value)
                $element->setAttribute($key,$value);

        $this->lastCreatedElement = $element;
        if($this->AUTOINSERT)
            $this->insert($this->lastCreatedElement);
        return $this->RETURNELEMENT?$element:$this;
    }
    public function insert($tag = NULL){
        $tag = is_null($tag)?$this->lastCreatedElement:$tag;
        $this->dom->appendChild($tag);
        return $this->RETURNELEMENT?$tag:$this;
    }

    public function saveDOM($filename){
        return $this->dom->save($filename);
    }
    public function printDOM(){
        @header("Content-Type: text/xml");
        print $this->dom->saveXML();
    }
    public function getDOM(){
        return $this->dom;
    }
    public function setReturnElement($var){
        $this->RETURNELEMENT = (bool) $var;
        return $this;
    }
    /*
    *   Only for download a xml
    */
    public function downloadxml($src){
        $timeout = array_key_exists('timeout', $this->config)?60:$this->config['timeout'];
        $ctx = stream_context_create(array('http'=>array('timeout' => $timeout)));
        $file = file_get_contents($src,FALSE,$ctx);
        $this->xml = new SimpleXMLElement($file);
        return $this;
    }
}