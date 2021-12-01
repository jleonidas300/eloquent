<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Post;

Route::get('eloquent', function () {
    
    $posts = Post::where('id', '>', '20')
        ->orderby('id', 'asc')
        ->take(5)
        ->get();

    foreach($posts as $post){
        echo "$post->id $post->title <br>";
    }
});
//vista posts y usuarios
Route::get('posts', function () {
    
    $posts = Post::get();

    foreach($posts as $post)
    {
        echo "
            $post->id 
            <strong>{$post->user->get_name}</strong>
            $post->title 
            <br>";
    }
});

    //trayendo cuantos posts pertenecen a usuarios
    use App\User;

    Route::get('users', function () 
    {
    
        $users = User::get();
    
        foreach($users as $user)
        {
            echo "
                $user->id 
                <strong>$user->get_name</strong> 
                {$user->posts->count()}
                <br>";
        }
});

//colecciones sirve para manipular los datos usando direntes metodos
Route::get('collections', function () 
    {
    
        $users = User::all();
    
        //dd($users);
        //dd($users->contains(4));
        //dd($users->except([2,3,4]));
        //dd($users->only([4]));
        //dd($users->find(2));
        dd($users->load('posts'));
});

Route::get('serializations', function () 
    {
    
        $users = User::get();
        
        $user = $users->find(1);
        //dd($user);
        dd($user->toJson());
});