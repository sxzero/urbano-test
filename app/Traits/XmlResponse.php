<?php

namespace App\Traits;

use DOMDocument;

trait XmlResponse
{
    public function xmlSuccessResponse($title, $content)
    {
        $content = $content->toArray();
        if (!array_key_exists(0, $content)) {
            $content = [$content];
        }

        $data = [
            'title' => $title,
            'content' => $content,
        ];

        $file = $this->create($data);
        header("Location: /{$file}");
        exit();
    }

    protected function create($data) {
        $title = $data['title'];
        $rowCount = count($data['content']);
        
        $xmlDoc = new DOMDocument();
        
        $root = $xmlDoc->appendChild($xmlDoc->createElement("content"));
        $root->appendChild($xmlDoc->createElement("title",$title));
        $root->appendChild($xmlDoc->createElement("total",$rowCount));
        $tabItem = $root->appendChild($xmlDoc->createElement('rows'));
        
        foreach($data['content'] as $element){
            if(!empty($element)){
                $tabItem = $tabItem->appendChild($xmlDoc->createElement('item'));
                foreach($element as $key=>$val){
                    $tabItem->appendChild($xmlDoc->createElement($key, $val));
                }
            }
        }
        
        header("Content-Type: text/plain");
        
        $xmlDoc->formatOutput = true;
        
        $file_name = strtolower(str_replace(' ', '_',$title).'_'.time().'.xml');
        $folder = env('XML_FOLDER','');
        $xmlDoc->save(public_path($folder) . "/{$file_name}");
        
        return "{$folder}/{$file_name}";
    }
}
