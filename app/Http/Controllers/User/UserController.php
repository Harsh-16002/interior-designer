<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use App\Models\CounterModel;
use App\Models\HeaderModel;
use App\Models\HeroModel;
use App\Models\ProjectModel;
use App\Models\ServicesModel;
use App\Models\TeamModel;
use App\Models\TestimonialModel;
use App\Models\WhyUsModel;
use App\Models\ContactModel;


class UserController extends Controller
{
    public function index()
    {
        $values = HeaderModel::first();
        $hero = HeroModel::all();
        $about = AboutModel::first();
        $whyUs = WhyUsModel::first();
        $projects = ProjectModel::all();
        $services = ServicesModel::all();
        $counter = CounterModel::first();
        $team = TeamModel::all();
        $testimonials = TestimonialModel::all();
        $footer = HeroModel::first();
        $contact = ContactModel::first();
        return view('user.index', compact(
            'values',
            'hero',
            'about',
            'whyUs',
            'projects',
            'services',
            'counter',
            'team',
            'testimonials',
            'footer',
            'contact',
        ));
      
    }

    public function project(){
         $values = HeaderModel::first();
         $footer = HeroModel::first();
         $projects = ProjectModel::paginate(6);
         $contact = ContactModel::first();
         return view('user.pages.project',compact('values','footer','projects','contact'));

    }

    public function about(){
         $values = HeaderModel::first();
         $footer = HeroModel::first();
         $contact = ContactModel::first();
         return view('user.pages.about',compact('values','footer','contact'));
    }
    public function contact(){
         $values = HeaderModel::first();
         $footer = HeroModel::first();
         $contact = ContactModel::first();
         return view('user.pages.contact',compact('values','footer','contact'));
    }
    
}
