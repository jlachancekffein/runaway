<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Question
{
    // CETTE CLASSE N'EST PAS UTILISÉE
    
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function getFields()
    {
        # code...
    }
    
    private function getQuestion1Fields() {
        $styles = Profile::getStyles();
        
        return compact('styles');
    }
    
    private function getQuestion2Fields() {
        $hairColors = Profile::getHairColors();
        $eyeColors = Profile::getEyeColors();
        $skinColors = Profile::getSkinColors();
        
        return compact('hairColors', 'eyeColors', 'skinColors');
    }
}
