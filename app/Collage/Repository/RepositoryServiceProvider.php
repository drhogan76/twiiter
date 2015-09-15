<?php

namespace Collage\Repository;

use Illuminate\Support\ServiceProvider;
use Collage\Repository\CollageGenerate\EloquentCollage;

class RepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind("Collage\Repository\CollageGenerate\CollageInterface", function($app) {
            return new EloquentCollage();
        });
    }

}
