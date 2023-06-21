<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    
    // Retrieve all teachers
    $router->get('teachers', 'TeacherRegistrationController@index');

    // Retrieve a specific teacher
    $router->get('teachers/{id}', 'TeacherRegistrationController@show');

    // Register a new teacher
    $router->post('teachers', 'TeacherRegistrationController@register');

    // Update a teacher
    $router->put('teachers/{id}', 'TeacherRegistrationController@update');

});
