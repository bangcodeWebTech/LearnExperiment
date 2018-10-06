<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivityTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
        	'Kegiatan ','Acara ','Sumbangan ',
        	'Makrab ','Wisuda '
        ];

        $types = ['university','faculty1','faculty2','faculty3','faculty4','faculty5','faculty6','faculty7','faculty8'];

        $scopes = ['uii','prov','national','international'];

        $categories= ['activity1','activity2','activity3','activity4','activity5','activity6','activity7','activity8'];

        for ($i=0; $i < 20; $i++) { 
        	$activity = Activity::create([
        		'name'=>$names[rand(0,4)].($i+1),
        		'cost'=>rand(100,999).'0000',
        		'type'=>$types[rand(0,8)],
        		'scope'=>$scopes[rand(0,3)],
        		'category'=>$categories[rand(0,7)]
        	]);
        }
    }
}
