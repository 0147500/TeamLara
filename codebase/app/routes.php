<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::model('challenge', 'Challenge');
Route::model('solution', 'Solution');

/*
| Page Routes
*/
Route::get('/', [
    "as"    => "home",
    "uses"  => "PageController@showHome"
]);

Route::get('/about', [
    "as"    => "about",
    "uses"  => "PageController@showAbout"
]);

/*
| Auth Routes
*/
Route::post('/signup', [
    "as"    => "handleSignup",
    "uses"  => "AuthController@handleSignup"
]);

Route::get('/login', [
    "as"    => "showLogin",
    "uses"  => "AuthController@showLogin"
]);

Route::post('/login', [
    "as"    => "handleLogin",
    "uses"  => "AuthController@handleLogin"
]);

Route::get('/logout', [
    "as"    => "handleLogout",
    "uses"  => "AuthController@handleLogout"
]);
Route::post('/update', [
   "as" => "handleUpdate",
   "uses" => "AuthController@handleUpdate"
]);

/*
| Profile Routes
*/
//todo.
Route::get('/user/{username}',[
    "as" => "showUserProfile",
    "uses" => "UserController@showUserProfile"
]);

Route::post('/user/{username}',[
    "as" => "handleUpdate",
    "uses" => "UserController@handleUpdate"
    
]);
/*
| Protected Routes
*/
Route::group(array('before' => 'auth'), function()
{
    Route::get('/challenges/', [
        "as" => 'challenges',
        "uses" => "ChallengeController@showChallenges"
    ]);
    
    Route::get('/challenges/my', [
        "as" => 'my-challenges',
        "uses" => "ChallengeController@showMyChallenges"
    ]);
    
    Route::get('/challenges/{challenge}', [
        "as" => 'challenge',
        "uses" => "ChallengeController@showChallenge"
    ]);
    
    Route::post('/solution/create/{challenge}', [
        "as" => 'solution',
        "uses" => "SolutionController@handleCreateSolution"
    ]);
    
    
    Route::get('/solution/delete/{solution}', [
        "as" => 'delete-solution',
        "uses" => "SolutionController@handleDeleteSolution"
    ]);    
    
    Route::get('/solution/mark/{solution}',[
        "as" => 'mark-solution',
        "uses" => "SolutionController@handleMarksolution"
    ]);
    
    Route::get('/challenge/create', [
        "as" => 'create-challenge',
        "uses" => "ChallengeController@showCreateChallenge"
    ]);
    
    Route::post('/challenge/create', [
        "as" => 'create-challenge',
        "uses" => "ChallengeController@handleCreateChallenge"
    ]);
    
    Route::post('/comment/create/challenge/{challenge}', [
        "as" => 'create-challenge-comment',
        "uses" => "ChallengeController@handleCreateComment"
    ]);

    Route::post('/comment/create/solution/{solution}', [
        "as" => 'create-solution-comment',
        "uses" => "SolutionController@handleCreateComment"
    ]);    

    Route::get('/vote/up/challenge/{challenge}', [
        "as" => 'vote-up-challenge',
        "uses" => "VoteController@voteUpChallenge"
    ]);    

    Route::get('/vote/down/challenge/{challenge}', [
        "as" => 'vote-down-challenge',
        "uses" => "VoteController@voteDownChallenge"
    ]);  

});