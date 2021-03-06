<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Settings;

class Url extends Eloquent
{
    
    protected $table = 'urls';
    protected $collection = 'urls';
    protected $connection = 'mongodb';
    public $timestamps = false;
    
    public function getContacts()
    {
        return json_decode($this->contacts) ?: [];
    } // end getContacts
    
    public function getValidParserInfo($parser)
    {
        $info = array_get($this->parsers, $parser, false);
        if (!$info || ((isset($info['updated_at']) ? $info['updated_at'] : 0) < (time() - Settings::get('parser_invalidation_interval')))) {
            return false;
        }
        
        unset($info['updated_at']);
        
        return $info;
    } // end getValidParserInfo
    
}

