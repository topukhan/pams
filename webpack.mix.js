const mix = require('laravel-mix');

// mix.js('resources/js/app.js', 'public/ui/frontend/js')
mix.postCss('resources/css/app.css', 'public/ui/frontend/css',[   
   require('tailwindCss')

   ]);