<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
| 
| Define routes for handling question management functionality.
|
*/

// General Routes
$router->get('/', 'Auth');
$router->get('/home', 'Home');

// Authentication routes
$router->group('/auth', function() use ($router){
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
});

// User management and exam routes
$router->get('/user-management', 'UserController');
$router->get('/exam-management', 'ExamController');
$router->get('/view-result', 'ResultController');
$router->get('/admin/students', 'UserController::showLoggedInStudents');

// Question management routes
$router->get('/question-management', 'QuestionController::renderQuestionManagement');

// API routes for question CRUD operations
$router->get('/question/getQuestions', 'QuestionController@getQuestions');
$router->post('/question/saveQuestion', 'QuestionController@saveQuestion');
$router->post('/question/updateQuestion', 'QuestionController@updateQuestion');
$router->post('/question/deleteQuestion', 'QuestionController@deleteQuestion');

// Additional routes for saving questions
$router->post('/saveQuestion', 'QuestionController@store');    
$router->post('/question/saveQuestion', 'QuestionController@saveQuestion');
