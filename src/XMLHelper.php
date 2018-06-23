<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XMLHelper{

    private $dom; // DOM ELEMENT
    private $xml; // XML SORCE

    private $config;

    public function __construct($data = []){
        $data = $this->data;
        $this->setDOM();
    }

    /*
    *   TOOLS TO READ
    *   Require a sorce './mydata.xml'
    *
    */
    public function setXML($src){
        $timeout = array_key_exists('timeout', $this->data)?60:$this->data['timeout'];
        $ctx = stream_context_create(array('http'=>array('timeout' => $timeout)));
        $file = file_get_contents($src,FALSE,$ctx);

        $this->xml = new SimpleXMLElement($file);

        return $this;
    }

    /*
    *   TOOLS TO CREATE
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

        return $element;
    }

    public function saveDOM($filename){
        return $this->dom->save($filename);
    }
    public function printDOM(){
        header("Content-Type: text/xml");
        print $this->dom->saveXML();
    }
    public function getDOM(){
        return $this->dom;
    }
    private function setDOM(){ // "ISO-8859-1" charset for brasilian
        $version = array_key_exists('version', $this->data)?"1.0":$this->data['version'];
        $charset = array_key_exists('charset', $this->data)?"UTF-8":$this->data['charset'];
        $this->dom = new DOMDocument($version,$charset);
    }
}