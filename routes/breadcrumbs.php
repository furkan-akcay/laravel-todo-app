<?php
/*
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});
*/

// Home > Projects
Breadcrumbs::for('projects', function ($trail) {
    //$trail->parent('home');
    $trail->push('Home', route('projects.index'));
});

// Home > Create
Breadcrumbs::for('create', function ($trail) {
    $trail->parent('projects');
    $trail->push('Create Project', route('projects.create'));
});

// Home > Projects > [Project]
Breadcrumbs::for('project', function ($trail, $project) {
    $trail->parent('projects');
    $trail->push($project->title, route('projects.show', $project->id));
});

// Home > Projects > [Project] > Edit
Breadcrumbs::for('edit', function ($trail, $project) {
    $trail->parent('project', $project);
    $trail->push('Update Project', route('projects.edit', $project->id));
});
