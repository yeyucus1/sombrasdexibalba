<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index () {
        $team = [
            (object)[
                'name' => 'Ethan Morgue',
                'description' => 'Un tipo que por azares del destino terminó una carrera y ahora quiere apoyar el arte.',
                'position' => 'Cofundador, desarrollador y administrador de sombras de Xibalba',
                'image' => asset('img/team/ethan_profile.jpeg'),
                'links' => (object) [
                    'facebook' => 'https://www.facebook.com/profile.php?id=100068727503183',
                    'instagram' => null,
                    'tiktok' => null,
                    'twitter' => null,
                ],
                'buy_me_a_coffee' => "<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#29abe0', 'Q5Q8ACXIN');kofiwidget2.draw();</script>"
            ],
            (object)[
                'name' => 'Ethan Morgue',
                'description' => 'Un tipo que por azares del destino terminó una carrera en ing. en sistemas y ahora quiere apoyar el arte.',
                'position' => 'Cofundador, desarrollador y administrador de sombras de Xibalba',
                'image' => asset('img/team/ethan_profile.jpeg'),
                'links' => (object) [
                    'facebook' => 'https://www.facebook.com/profile.php?id=100068727503183',
                    'instagram' => null,
                    'tiktok' => null,
                    'twitter' => null,
                ],
                'buy_me_a_coffee' => true,
                'coffee' => 'Hola'
            ],
        ];
        return view('layouts.guest.base',compact('team'));
    }

    public function terms() {
        return view('layouts.notices.pages.terms');
    }

    public function privacy() {
        return view('layouts.notices.pages.privacy');
    }

}
