<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     protected $fillable =[
    	'name','cost','type','scope','category'
    ];

      public static function typeList(){
        return [
            'university'=>'UNIV',
            'faculty1'=>'FE',
            'faculty2'=>'FK',
            'faculty3'=>'FTI',
            'faculty4'=>'FPSB',
            'faculty5'=>'FH',
            'faculty6'=>'FIAI',
            'faculty7'=>'FTSP',
            'faculty8'=>'FMIPA',
        ];
    }

    public static function scopeList(){
        return [
            'uii'=>'UII',
            'prov'=>'Provinsi',
            'national'=>'Nasional',
            'international'=>'Internasional',
           
        ];
    }

     public static function categoryList(){
        return [
            'activity1'=>'KL',
            'activity2'=>'PI',
            'activity3'=>'KLM',
            'activity4'=>'KPMD',
            'activity5'=>'KBW',
            'activity6'=>'KBOK',
            'activity7'=>'KBSB',
            'activity8'=>'dll',
            
        ];
    }

    public static function forChartTypeAttribute($cType){
        return static::typeList()[$cType];
    }

    public static function forChartScopeAttribute($cScope){
        return static::scopeList()[$cScope];
    }

    public static function forChartCategoryAttribute($cCategory){
        return static::categoryList()[$cCategory];
    }

    public function getHumanTypeAttribute(){
        return static::typeList()[$this->type];
    }

    public function getHumanScopeAttribute(){
        return static::scopeList()[$this->scope];
    }

    public function getHumanCategoryAttribute(){
        return static::categoryList()[$this->category];
    }

}
